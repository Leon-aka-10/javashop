<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function index() {

        $orders = Order::all();
        return view('admin.orders.index', compact('orders')); 
    }

    public function confirm($id) {

        //find the order
        $order = Order::find($id);

        //update the order
        $order->update(['status' => 1]);

        //session message
        session()->flash('msg', 'Order has been confirmed');

        //redirect page
        return redirect('admin/orders');
    }

    public function pending($id) {

         //find the order
         $order = Order::find($id);

         //update the order
         $order->update(['status' => 0]);
 
         //session message
         session()->flash('msg', 'Order still pending');
 
         //redirect page
         return redirect('admin/orders');
    }
}
