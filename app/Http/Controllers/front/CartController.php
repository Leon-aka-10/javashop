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


        $request->validate([
            'name'=>'required',
            'price'=>'required',
            
        ]);

        
        $id = auth()->user()->id;
       
        \Cart::session($id)->add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(),
            'associatedModel' => $product
            
        ]);
  
          //sessions message
          $request->session()->flash('msg','Your product has been added');

          //redirect
          return redirect()->route('/cart');
    }
}
 