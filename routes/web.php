<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\RegistrationController;
use App\Http\Controllers\front\UserLoginController;
use App\Http\Controllers\front\UserProfileController;
use App\Http\Controllers\front\CartController;
use Darryldecode\Cart\Cart;

//Admin Routes

Route::prefix('admin')->group(function() {

    Route::middleware('auth:admin')->group(function() {

      //Dashboard
      Route::get('/', [DashboardController::class,'index']);

      //Products
      Route::resource('/products', ProductController::class);

      //Orders
      Route::resource('/orders', OrderController::class);
      Route::get('/confirm/{id}', [OrderController::class,'confirm'])->name('order.confirm');
      Route::get('/pending/{id}', [OrderController::class,'pending'])->name('order.pending');

      //Users
      Route::resource('/users', UserController::class);

      //Logout
      Route::get('/logout', [AdminUserController::class,'logout']);

    });

   
   //Admin Login
   Route::get('/Login', [AdminUserController::class,'index']);
   Route::post('/Login', [AdminUserController::class,'store']);
});

//Front Routes
Route::get('/', [HomeController::class,'index']); 

//User Registration
Route::get('/user/register', [RegistrationController::class,'index']); 
Route::post('/user/register', [RegistrationController::class,'store']); 

//User Login
Route::get('/user/login', [UserLoginController::class,'index']); 
Route::post('/user/login', [UserLoginController::class,'store']); 

// User Logout
Route::get('/user/logout', [UserLoginController::class,'logout']); 

Route::get('/user/profile', [UserProfileController::class,'index']);

// Cart
Route::get('/cart', [CartController::class,'index']); 
Route::post('/cart', [CartController::class,'store'])->name('cart');
Route::delete('/cart/{id}', [CartController::class,'destroy'])->name('cart.destroy'); 
Route::post('/cart/saveLater/{product}',[CartController::class,'saveLater'])->name('cart.saveLater');


Route::get('empty', function() {   
  Cart::getContent()->destroy();
});