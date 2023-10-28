<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request)
    {
        // logger($request->all());
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } else {
            $data = Product::orderBy('created_at', 'asc')->get();
        }
        // $data = Product::get();
        return $data;
    }

    //return pizza list
    public function addToCart(Request $request)
    {
        // logger($request->all());
        $data = $this->getOrderData($request);
        logger($data);
        Cart::create($data);

        $respone = [
            'message' => 'Add To Cart Complete',
            'status' => 'success',
        ];

        // return [
        //     'message' => 'Add To Cart Complete',
        //     'status' => 'success',
        // ];
        return response()->json($respone, 200);
    }

    //get order data
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
