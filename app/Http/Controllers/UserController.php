<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;



class UserController extends Controller
{


    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id) {
        
        //find the user
        $orders = Order::where('user_id', $id)->get();

        //Return back to User details page
        return view('admin.users.details', compact('orders'));

    }
}

