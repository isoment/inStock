@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">Create New Order</h1>
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div>
                            <h3 class="text-muted mt-3">Search Customers</h3>
                            <form action="/orders/create" method="GET">
                                <div class="row mb-4">
                                    <div class="col-8 col-lg-10">
                                        <input type="text" name="searchCustomers" class="form-control" placeholder="Search Customers">
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <button class="btn btn-success float-right">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Contact Pref</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <th scope="row">{{$customer->id}}</th>
                                        <td>{{$customer->customer_name}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{$customer->phone_number}}</td>
                                        <td>{{$customer->contact_method}}</td>
                                        <td class="text-center">
                                            <a href="/customers/{{$customer->id}}" class="btn-sm btn-primary remove-link-styling">View</a>
                                        </td>
                                    </tr>    
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $customers->links() }}
                            </div>
                        </div>
                        
                        <div class="form-div mt-5">
                            <form action="/orders" method="POST">
                                @csrf

                                <h3 class="text-muted mt-3 mb-3">Customer Information</h3>
                                @error('customer_id')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="customer_id" class="font-weight-light">Customer ID</label>
                                    <input type="number" class="form-control" id="customer_id" name="customer_id" value="{{old('customer_id')}}">
                                </div>

                                <h3 class="text-muted mt-4 mb-3">Order Details</h3>

                                @error('ship_to')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="ship_to" class="font-weight-light">Ship To</label>
                                    <input type="text" class="form-control" id="ship_to" name="ship_to" value="{{old('ship_to')}}">
                                </div>

                                @error('ship_address')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="ship_address" class="font-weight-light">Ship Address</label>
                                    <input type="text" class="form-control" id="ship_address" name="ship_address" value="{{old('ship_address')}}">
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