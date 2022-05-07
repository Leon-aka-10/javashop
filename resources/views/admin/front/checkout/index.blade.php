@extends('admin.front.layouts.master')

@section('content')


    @if (session()->has('msg'))
       <div class="alert alert-success">
          {{  session()->get('msg') }}
       </div>
    @endif

    <div class="container">

        <h2 class="mt-5"><i class="fa  fa-credit-card-alt"></i> Checkout</h2>
        <hr>


        <div class="row"> 

              <div class="col-md-7">  
                <h4>Billing Details</h4>

                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-5">
                      <label for="city">City</label>
                      <input type="text" class="form-control" id="city" placeholder="City">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="provance">Provance</label>
                        <input type="text" class="form-control" id="provance" placeholder="Provance">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="postal">Postal</label>
                      <input type="text" class="form-control" id="postal" placeholder="Postal">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                  </div>
                  <input type="hidden" name="email" value="chuboy_10@yahoo.com"> {{-- required --}}
                  <input type="hidden" name="orderID" value="345">
                  <input type="hidden" name="amount" value="800"> {{-- required in kobo --}}
                  <input type="hidden" name="quantity" value="3">
                  <input type="hidden" name="currency" value="NGN">
                  <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                  <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                  {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                  <hr>
                  <button type="submit" class="btn btn-outline-info col-md-12"><i class="fa fa-plus-circle fa-lg"></i>
                    Complete Order
                  </button>
                </form>

              </div>

            <div class="col-md-5">
                
            <h4>Your Order</h4>
                
                <table class="table your-order-table">
                    <tr>
                        <th>Image</th>
                        <th>Details</th>
                        <th>Qty</th>
                    </tr>

                    @foreach (Cart::getContent() as $item)
                    <tr>
                        <td><img src="{{ url('/uploads') . '/'. $item->model->image }}" alt="" style="width: 4em"></td>
                        <td>
                            <strong>{{ $item->model->name }}</strong><br>
                            {{ $item->model->description }} <br> 
                            <span class="text-dark">${{ $item->model->price }}</span>
                        </td>
                        <td>
                            <span class="badge badge-light">{{ $item->quantity }}</span>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <hr>
                <table class="table your-order-table table-bordered">
                    <tr>
                        <th colspan="2">Price Details</th>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
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

    </div>

    <div class="mt-5"><hr></div>

@endsection