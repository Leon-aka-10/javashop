<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    public function index(){

        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();
 
        return view('admin.front.profile.index', compact('user')); 
    }
}
