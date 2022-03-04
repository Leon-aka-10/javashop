<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index() {
        return view('admin.Login');
    }

    public function store(Request $request) {

        //validate the user
        $request->validate([
            'email' => 'required|email' ,
            'password' => 'required'
        ]);

        //log the user in
        $credentials = $request->only('email','password');
        
        if(! Auth::guard('admin')->attempt($credentials)) {
            return back()->withErrors([
                'message' => 'Wrong credentials please try again'
            ]);
        }


        //session message
        session()->flash('msg','You have been logged in');


        //redirect
        return redirect('/admin');
    }

    public function logout() {
        auth()->guard('admin')->logout();

        session()->flash('msg', 'you have been logged out');

        return redirect('/admin/Login');
    }
}

