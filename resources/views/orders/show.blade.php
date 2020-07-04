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
                            <a href="/customers/{{$order->customers->id}}" class="btn btn-secondary">Customer Profile</a>
                        </div>
                        <h4 class="font-weight-bold mb-3 text-muted">Order Information</h4>
                        <div class="details">
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">ID:</span>{{$order->id}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Order Placed:</span>{{date("F jS, Y", strtotime($order->created_at))}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Status:</span>{{$order->status}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Tracking #:</span>{{$order->tracking}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Shipper:</span>{{$order->shipper}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Ship To:</span>{{$order->ship_to}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Address:</span>{{$order->ship_address}}</h5>
                        </div>
                        <hr class="mb-5">
                        <h4 class="font-weight-bold mb-3 text-muted">Payment Details</h4>
                        <div class="payment">
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Subtotal:</span>${{$subTotal}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Tax:</span>${{$order->tax}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Shipping:</span>${{$order->shipping}}</h5>
                            <h5 class="mb-3 text-danger"><span class="font-weight-bold mr-2">Total:</span>${{$total}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection