@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">Create New Order</h1>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-div">
                            <form action="/orders" method="POST">
                                @csrf

                                @error('product')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="product" class="font-weight-light">Product</label>
                                    <select class="form-control" id="product" name="product">
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('status')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="status" class="font-weight-light">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Open">Open</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Shipped">Shipped</option>
                                    </select>
                                </div>

                                @error('tracking')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="tracking" class="font-weight-light">Tracking</label>
                                    <input type="text" class="form-control" id="tracking" name="tracking" value="{{old('tracking')}}">
                                </div>

                                @error('customer_name')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="customer_name" class="font-weight-light">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{old('customer_name')}}">
                                </div>

                                @error('email')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="email" class="font-weight-light">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                                </div>

                                @error('address')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="address" class="font-weight-light">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                                </div>

                                @error('tax')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="tax" class="font-weight-light">Tax</label>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-light">$</div>
                                        <input type="text" class="form-control ml-2" id="tax" name="tax" value="{{old('tax')}}">
                                    </div>
                                </div>

                                @error('shipping')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="shipping" class="font-weight-light">Shipping</label>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-light">$</div>
                                        <input type="text" class="form-control ml-2" id="shipping" name="shipping" value="{{old('shipping')}}">
                                    </div>
                                </div>

                                @error('paid')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="paid" class="font-weight-light">Paid</label>
                                    <select name="paid" id="paid" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Add Order</button>
                                    <a class="btn btn-secondary" href="/orders">Back to Orders</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection