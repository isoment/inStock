@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">{{$product->name}}</h1>
                <div class="card shadow-sm">
                    <div class="card-body m-3">
                        <div class="float-right">
                            <a href="/products/{{$product->id}}/edit" class="btn btn-primary mr-2">Edit</a>
                        </div>
                        <div class="details">
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Name:</span>{{$product->name}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">ID:</span>{{$product->id}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Type:</span>{{$product->type}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Brand:</span>{{$product->brand}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Current Inventory:</span>{{$product->inventory}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Price:</span>${{$product->price}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Description:</span><br>
                                <div class="mt-2">{{$product->description}}</div>
                            </h5>
                        </div>
                    <h3 class="mt-5 text-muted font-weight-bold">Recent orders of {{$product->name}}</h3>
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
                                    
                                    {{-- @foreach ($ordersWithProduct as $order)
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
                                    @endforeach --}}

                                </tbody>
                            </table>
                            {{-- <div>
                                {{ $ordersWithProduct->links() }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection