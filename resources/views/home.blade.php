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
                        <h3 class="text-muted">Recent Orders</h3>
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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="revenue-by-day">
                        <h3 class="text-muted">Revenue By Day for {{date('F')}}</h3>
                        <p class="text-muted">Last 7 days, in dollars</p>
                        <div class="graph-revenue">
                            <revenue-graph :keys="{{ $monthName }}"
                                           :values="{{ $dollars }}">
                            </revenue-graph>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
