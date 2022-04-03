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

        $dubl = \Cart::getContent()->search(function ($cartitem, $rowId) use ($request) {
            return $cartitem->id === $request->id;
        });

        if (!empty($dubl)) {
            return redirect()->back()->with('msg','Product is already in your cart');
        }

         
        \Cart::add(array(
            'id' => $request->id, 
            'name' => $request->name, 
            'price' => $request->price, 
            'quantity' => 1,
            'associatedModel' => 'App\Models\Product'
        ));
       
      
        //redirect
        return redirect()->back()->with('msg','Your product has been added');
    }

    public function destroy($id) {
 
        \Cart::remove($id);

        return redirect()->back()->with('msg', 'Item has been removed from cart'); 
    }
    
    /**public function saveLater($id) {
        
        $item = \Cart::get($id);

        //\Cart::remove($id);


        \Cart::getContent('saveForLater')->add(array(
            'id' => $item->id, 
            'name' => $item->name, 
            'price' => $item->price, 
            'quantity' => 1,
            'associatedModel' => 'App\Models\Product'
        ));
      

        return redirect()->back()->with('msg', 'Item has been saved for later');

    }**/

}
 