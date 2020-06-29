@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-md-9">
                <h1 class="mb-4">Add Customer From Previous Order</h1>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-div">
                            <form action="/customers/previous" method="POST">
                                @csrf

                                @error('previous_order')
                                    <div class="alert alert-danger my-1">The previous order ID is required</div>
                                @enderror
                                <div class="form-group">
                                    <label for="previous_order" class="font-weight-light">Previous Order ID</label>
                                    <input type="number" class="form-control" id="previous_order" name="previous_order">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-info text-white">Add Customer</button>
                                    <a class="btn btn-secondary" href="/customers">Back to Customers</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h3 class="mb-3 text-muted">Orders</h3>
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{$order->id}}</th>
                                        <td>{{$order->status}}</td>
                                        <td>{{date("F jS, Y", strtotime($order->created_at))}}</td>
                                        <td>{{$order->product_name}}</td>
                                        <td>{{$order->customer_name}}</td>
                                        <td>{{$order->email}}</td>
                                        <td class="text-center">
                                            <a href="/orders/{{$order->id}}" class="btn-sm btn-primary remove-link-styling">View</a>
                                        </td>
                                    </tr>    
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection