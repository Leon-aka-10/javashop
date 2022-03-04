<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');  
    }


    public function index(){
 
        return view('admin.front.UserLogin.index'); 
    }

    public function store(Request $request){

        // validate the user

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $request->validate($rules);

        // check if user exists
        $data= request(['email','password']);
        if( ! auth()->attempt($data)) {
            return back()->withErrors([
                'message' => 'wrong credentials please try again'
            ]);
        }

        return redirect('/user/profile');

    }

    public function logout(){

        auth()->logout();

        session()->flash('msg', 'You have been logged out sucessfully');

        return redirect('/user/login');
    }
}
