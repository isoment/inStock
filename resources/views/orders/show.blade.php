@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">Order #{{$order->id}}</h1>
                <div class="card shadow-sm">
                    <div class="card-body m-3">
                        <div class="float-right d-flex">
                            <a href="/orders/{{$order->id}}/edit" class="btn btn-primary mr-2">Edit</a>
                            <div>
                                <form action="/orders/{{$order->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger" 
                                            onclick="return confirm('Delete Product?')">Delete</button>
                                </form>
                            </div>
                        </div>
                        <h4 class="font-weight-bold mb-3 text-muted">Order Information</h4>
                        <div class="details">
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">ID:</span>{{$order->id}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Order Placed:</span>{{date("F jS, Y", strtotime($order->created_at))}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Status:</span>{{$order->status}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Tracking #:</span>{{$order->tracking}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Customer Name:</span>{{$order->customer_name}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Email:</span>{{$order->email}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Address:</span>{{$order->address}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Product:</span>{{$order->product_name}}</h5>
                        </div>
                        <hr class="mb-5">
                        <h4 class="font-weight-bold mb-3 text-muted">Payment Details</h4>
                        <div class="payment">
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Paid:</span>{{$order->paid}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">{{$order->product_name}} Cost:</span>${{$order->item_cost}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Tax:</span>${{$order->tax}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Shipping:</span>${{$order->shipping}}</h5>
                            <h5 class="mb-3 text-danger"><span class="font-weight-bold mr-2">Total:</span>${{$order->total_price}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection