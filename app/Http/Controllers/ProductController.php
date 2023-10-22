<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list()
    {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(3);

        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    //direct pizza create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        // dd($categories->toArray());
        return view('admin.product.create', compact('categories'));
    }

    //pizza create
    public function create(Request $request)
    {
        // dd($request->all());
        $this->productValidationCheck($request, "create");
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess' => 'Product Created Successfully...']);
    }

    //direct pizza delete page
    public function delete($id)
    {
        // dd($id);
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Product Deleted Successfully...']);
    }

    //direct pizza edit page
    public function edit($id)
    {
        // dd($id);
        $pizza = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)->first();
        return view('admin.product.edit', compact('pizza'));
    }

    //direct update pizza
    public function updatePage($id)
    {
        // dd($id);
        $pizza = Product::where('id', $id)->first();
        $category = Category::get();
        return view('admin.product.update', compact('pizza', 'category'));
    }

    //update pizza
    public function update(Request $request)
    {
        $this->productValidationCheck($request, "update");
        $data = $this->requestProductInfo($request);
        // dd($id, $request->all());

        if ($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            // dd($oldImageName);

            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }

            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess' => 'Product Updated Successfully...']);
    }

    //product validation check
    private function productValidationCheck($request, $action)
    {
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,' . $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:5',
            'pizzaImage' => 'required|mimes:png,jpg,jpeg,webp,avif|file',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required',
        ];

        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,webp,avif|file' : 'mimes:png,jpg,jpeg,webp,avif|file';
        // dd($validationRules);

        Validator::make($request->all(), $validationRules)->validate();
    }

    //request product info
    private function requestProductInfo($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->pizzaWaitingTime,
            'price' => $request->pizzaPrice,
        ];
    }
}
