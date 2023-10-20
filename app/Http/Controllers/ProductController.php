<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list()
    {
        $pizzas = Product::orderBy('created_at', 'desc')->paginate(3);
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
        $this->productValidationCheck($request);
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess' => 'Product Created Successfully...']);
    }

    //product validation check
    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            'pizzaName' => 'required|min:5|unique:products,name',
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:5',
            'pizzaImage' => 'required|mimes:png,jpg,jpeg,webp,avif|file',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required',
        ])->validate();
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
