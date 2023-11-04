<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

    //order
    public function order(Request $request)
    {
        // logger($request->toArray());
        // foreach($request->all() as $item){
        //     OrderList::create($item);
        // }

        // $respone = [
        //     'message' => 'Add To Cart Complete',
        //     'status' => 'success',
        // ];

        // return response()->json($respone, 200);
        $total = 0;

        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $total += $data->total;
        };

        Cart::where('user_id', Auth::user()->id)->delete();
        // logger($data);

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order completed'
        ], 200);
    }

    //clear cart
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear current product for remove button
    public function clearCurrentProduct(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->where('id', $request->orderId)->delete();
    }

    //increase pizza viewCount
    public function increaseViewCount(Request $request)
    {
        //logger($request->all());
        $pizza = Product::where('id', $request->productId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];

        Product::where('id', $request->productId)->update($viewCount);
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
