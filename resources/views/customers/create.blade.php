@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">Add Customer</h1>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-div">
                            <form action="/customers" method="POST">
                                @csrf

                                @error('customer_name')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="customer_name" class="font-weight-light">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name">
                                </div>

                                @error('email')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="email" class="font-weight-light">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>

                                @error('address')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="address" class="font-weight-light">Address</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>

                                @error('phone_number')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="phone_number" class="font-weight-light">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                                </div>

                                @error('contact_method')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="contact_method" class="font-weight-light">Contact Method</label>
                                    <input type="text" class="form-control" id="contact_method" name="contact_method">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Add Customer</button>
                                    <a class="btn btn-secondary" href="/customers">Back to Orders</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection