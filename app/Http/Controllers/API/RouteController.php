<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RouteController extends Controller
{
    //get all product list
    public function productList()
    {
        $products = Product::get();
        $user = User::get();
        $category = Category::get();

        $data = [
            'product' => [
                'code lab' => $products
            ],
            'user' => $user,
            'category' => $category
        ];

        return response()->json($data, 200);
    }

    //get all category list
    public function categoryList()
    {
        $category = Category::get();
        return response()->json($category, 200);
    }

    //create category
    public function categoryCreate(Request $request)
    {
        // dd($request->all());
        // dd($request->header('headerData')); //from header
        // dd($request->name); //from body
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //create contact
    public function createContact(Request $request)
    {
        // dd($request->all());
        $data = $this->getContactData($request);
        Contact::create($data);
        $contact = Contact::orderBy('created_at', 'desc')->get();
        return response()->json($contact, 200);
    }

    //delete for post method
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();

        if (isset($data)) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no category...'], 200);
    }

    //delete for get method
    public function categoryDelete($id)
    {
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no category...'], 200);
    }

    //edit for post method
    public function categoryDetails(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();

        if (isset($data)) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no category...'], 200);
    }

    //edit for get method
    public function detailsCategory($id)
    {
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no category...'], 200);
    }

    //update category
    public function categoryUpdate(Request $request)
    {
        // return $request->all();
        $categoryId = $request->category_id;
        $dbSource = Category::where('id', $categoryId)->first();

        if (isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $categoryId)->update($data);
            $response = Category::where('id', $categoryId)->first();

            return response()->json(['status' => true, 'message' => 'category update success...', 'category' => $response], 200);
        }
        return response()->json(['status' => false, 'message' => 'there is no category...'], 500);
    }

    //get contact data
    private function getContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //get category data
    public function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
