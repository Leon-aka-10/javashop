@extends('admin.front.layouts.master')

@section('content')


    <h2 class="mt-5"><i class="fa fa-shopping-cart"></i> Shopping Cart</h2>
    <hr>
  
    @if ( Cart::getContent()->count() > 0 )

    <h4 class="mt-5">4 items(s) in Shopping Cart</h4>

    <div class="cart-items">
        
        <div class="row">
            
            <div class="col-md-12">
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                       {{  session()->get('msg') }}
                    </div>
                @endif
                
                <table class="table">
                    
                    <tbody> 
                    
                    @foreach ( Cart::getContent() as $item )

                        <tr>
                            <td><img src="{{ url('/uploads'). '/'. $item->model->image }}" style="width: 5em"></td>
                            <td>
                                <strong>{{ $item->model->name }}</strong><br> {{ $item->model->description }}
                            </td>
                            
                            <td>
                                <form action="{{ route('cart.destroy', $item->id ) }}" method="post">
                                    @csrf
                                    @method('delete')
                                   <button type="submit" class = "btn btn-link-dark">Remove</button>
                                </form>

                              <!--<form action="{{ route('cart.saveLater', $item->id ) }}" method="post" >
                                    @csrf
                                    <button type="submit" class="btn btn-link-dark">Save for later</button>
                                </form> -->
                                

                            </td>
                            
                            <td>
                                <select name="" id="" class="form-control" style="width: 4.7em">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                            </td>
                            
                            <td>${{ $item->model->price }}</td>
                        </tr>
                    
                    @endforeach
                     
                    </tbody>

                </table>

            </div>   
                <!-- Price Details -->
                    <div class="col-md-6">
                        <div class="sub-total">
                             <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="2">Price Details</th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>Subtotal </td>
                                        <td>${{ Cart::getSubTotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>${{ 0 }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <th>${{ Cart::getTotal() }}</th>
                                    </tr>
                             </table>           
                         </div>
                    </div>
                <!-- Save for later  -->
                <div class="col-md-12">
                    <a href="/" class="btn btn-outline-dark">Continue Shopping</a>
                    <a href="/checkout" class="btn btn-outline-info">Proceed to checkout</a>
                    <hr>

                </div>
                @else
                  <h3>There is no item in your Cart</h3>
                  <a href="/" class="btn btn-outline-dark">Continue Shopping</a>
                  <hr>
                @endif

            <!--@if ( Cart::getContent('saveForLater')->count() > 0 )

            <div class="col-md-12">
                
                <h4>{{ Cart::getTotalQuantity('saveForLater') }} item(s) Save for Later</h4>
                <table class="table">
                    
                    <tbody>
                    @foreach ( Cart::getContent('saveForLater') as $item )

                        <tr>
                            <td><img src="{{ url('/uploads'). '/'. $item->model->image }}" style="width: 5em"></td>
                            <td>
                                <strong>{{ $item->model->name }}</strong><br> {{ $item->model->description }}
                            </td>
                            
                            <td>
                                <form action="{{ route('cart.destroy', $item->id ) }}" method="post">
                                    @csrf
                                    @method('delete')
                                   <button type="submit" class = "btn btn-link-dark">Remove</button>
                                </form>

                                <form action="{{ route('cart.saveLater', $item->id ) }}" method="post" >
                                    @csrf
                                    <button type="submit" class="btn btn-link-dark">Move to cart</button>
                                </form>
                                

                            </td>
                            
                            <td>
                                <select name="" id="" class="form-control" st yle="width: 4.7em">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                            </td>
                            
                            <td>${{ $item->model->price }}</td>
                        </tr>
                    
                    @endforeach
                    </tbody>

                </table>
                @endif
            </div>  -->
        </div>


    </div>


@endsection