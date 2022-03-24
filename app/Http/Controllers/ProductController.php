<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {

        $products = Product::all();

        return view('admin.products.index', compact('products'));
    
    }

    public function create() {

        $product = new Product();

        return view('admin.products.create', compact('product'));
    }

    public function store(Request $request) {
       
        //validate the form
        $request->validate([
           'name'=>'required',
           'price'=>'required',
           'description'=>'required',
           'image'=>'image|required'
        ]);

        //upload the image
        if($request->hasfile('image')) {
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
        }

        //save the data into the database
        Product::create([
            'name' => $request->name,
            'price' =>$request->price,
            'description' =>$request->description,
            'image' =>$request->image->getClientOriginalName()
            

        ]);

        //sessions message
        $request->session()->flash('msg','Your product has been added');

        //redirect
        return redirect('admin/products/create');

    }

    public function edit($id) {
       $product = Product::find($id);
       return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id) {
        //find the product
        $product = Product::find($id);

        //validate the form
        $request->validate([
           'name'=>'required',
           'price'=>'required',
           'description'=>'required',
        ]);

        //check if there is any image
        if ($request->hasfile('image')) {
            //check if the old image exists inside folder
            if (file_exists(public_path('uploads/') . $product->image)) {
                unlink(public_path('uploads/') . $product->image);
            }

            //upload new image
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());

            $product->image = $request->image->getClientOriginalName();
        }

        //updating the product
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image
        ]);

       //store a message
       $request->session()->flash('msg', 'Product has been updated');

       //Redirect back
       return redirect('admin/products');

    }

    public function show($id) {
        $product = Product::find($id);

        return view('admin.products.details', compact('product'));
    }

    public function destroy($id) {

       //Delete the product
       Product::destroy($id);
       
       //store a message
       session()->flash('msg', 'Product has been deleted');

       //Redirect back
       return redirect('admin/products');
    }
}
