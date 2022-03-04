<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(){
 
        return view('admin.front.Registration.index'); 
    }

    public function store(Request $request){

        //validate the user
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'address' => 'required'
        ]);

        //save the data
        $user = User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
            'address' =>$request->address,
        ]);

        //sign in user
        auth()->login($user);

        //Redirect to
        return redirect('/user/profile');
          
    }
}
