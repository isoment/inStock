@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4 justify-content-center">
        <div class="col-5 col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1 id="product-numbers-h1" class="font-weight-bold text-info">{{$totalOrders}}</h1>
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

    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="order-recent">
                        <div class="d-flex justify-content-between mb-2">
                            <h3 class="text-muted mb-0 mt-1">Recent Orders</h3>
                            <a class="btn btn-primary" href="/orders">View All</a>
                        </div>
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Ship To</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{$order->id}}</th>
                                        <td>{{$order->ship_to}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{date("F jS, Y", strtotime($order->created_at))}}</td>
                                        <td>${{$order->order_subtotal}}</td>
                                        <td class="text-center">
                                            <a href="/orders/{{$order->id}}" class="btn-sm btn-primary remove-link-styling">View</a>
                                        </td>
                                    </tr>    
                                    @endforeach
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="revenue-by-day">
                        <h3 class="text-muted">Revenue By Day for {{date('F')}}</h3>
                        <p class="text-muted">Last 7 days, in dollars</p>
                        <div class="graph-revenue">
                            <revenue-graph :keys="{{$days}}"
                                           :values="{{$dollars}}">
                            </revenue-graph>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="order-recent">
                        <h3 class="text-muted">Lowest Stock Products</h3>
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Inventory</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($products as $product)
                                    <tr class="{{$product->inventory < 5 ? "text-danger" : ""}}">
                                        <th scope="row">{{$product->id}}</th>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->type}}</td>
                                        <td>{{$product->brand}}</td>
                                        <td>{{$product->inventory}}</td>
                                        <td>${{$product->price}}</td>
                                        <td class="text-center">
                                            <a href="/orders/{{$product->id}}" class="btn-sm btn-primary remove-link-styling">View</a>
                                        </td>
                                    </tr>    
                                    @endforeach
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="revenue-by-day">
                        <h3 class="text-muted">Top Five Customers</h3>
                        <p class="text-muted">By order volume</p>
                        <div class="graph-revenue">
                            @if ($customerName && $customerOrderCount)
                                <customer-graph :keys="{{$customerName}}"
                                                :values="{{$customerOrderCount}}">
                                </customer-graph>
                            @else
                                <h4 class="text-center text-danger">Metric will update once all customers are assigned orders</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="order-recent">
                        <h3 class="text-muted">Newest Customers</h3>
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($newestCustomers as $cust)
                                    <tr>
                                        <th scope="row">{{$cust->id}}</th>
                                        <td>{{$cust->customer_name}}</td>
                                        <td>{{$cust->email}}</td>
                                        <td>{{$cust->address}}</td>
                                        <td>{{$cust->phone_number}}</td>
                                        <td class="text-center">
                                            <a href="/customers/{{$cust->id}}" class="btn-sm btn-primary remove-link-styling">View</a>
                                        </td>
                                    </tr>    
                                    @endforeach
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
