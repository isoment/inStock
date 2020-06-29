@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4 justify-content-center">
            <div class="col-5 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h1 id="product-numbers-h1" class="font-weight-bold text-info">{{$orderCount}}</h1>
                        Total Orders
                    </div>
                </div>
            </div>
            <div class="col-5 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h1 id="product-worth-h1" class="font-weight-bold text-info">${{$revenue}}</h1>
                        Revenue
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-body">

                        @include('inc.messages')
                        <br>

                        <a href="/orders/create" 
                           class="btn btn-success mb-3 float-right">Manual Order</a>
                        
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
                                            <a href="/orders/{{$order->id}}/edit" class="btn-sm btn-secondary remove-link-styling">Edit</a>
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