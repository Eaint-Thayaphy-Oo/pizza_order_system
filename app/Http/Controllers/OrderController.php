<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function orderList()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        // dd($order->toArray());
        return view('admin.order.list', compact('order'));
    }

    //sort with ajax
    public function changeStatus(Request $request)
    {
        // logger($request->all());
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc');

        if ($request->orderStatus == null) {
            $order = $order->paginate(5);
        } else {
            $order = $order->where('orders.status', $request->orderStatus)->paginate(5);
        }

        return view('admin.order.list', compact('order'));
    }

    //ajax change status
    public function ajaxChangeStatus(Request $request)
    {
        // logger($request->all());
        Order::where('id', $request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($order->toArray());
        return response()->json($order, 200);
    }

    //order list
    public function listInfo($orderCode)
    {
        // dd($orderCode);
        $order = OrderList::where('order_code', $orderCode)->first();
        $orderList = OrderList::select('order_lists.*', 'users.name as user_name', 'products.image as product_image', 'products.name as product_name')
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')
            ->where('order_code', $orderCode)->get();
        // dd($orderList->toArray());
        return view('admin.order.productList', compact('orderList', 'order'));
    }
}
