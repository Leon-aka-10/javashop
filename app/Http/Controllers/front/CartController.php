<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class CartController extends Controller
{
    public function index(){
 
        return view('admin.front.cart.index'); 
    }

    public function store(Request $request) {
       
        $cartitem = Cart::add($request->id, $request->name, $request->price, 1);

        return redirect()->back()->with('msg', 'Item had been added to cart');
    }
}
 