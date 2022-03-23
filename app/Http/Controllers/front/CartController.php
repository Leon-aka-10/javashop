<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart;

class CartController extends Controller
{
    public function index(){
 
        return view('admin.front.cart.index'); 
    } 

    

    public function store(Request $request) {

         
            \Cart::add(array(
             'id' => $request->id, 
             'name' => $request->name, 
             'price' => $request->price, 
             'quantity' => 1,
             'associatedModel' => 'App\Models\Product'
            ));
       
      
  
          //sessions message
          $request->session()->flash('msg','Your product has been added');

    }
}
 