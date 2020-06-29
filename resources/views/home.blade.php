@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <a href="/products">Products</a><br>
                    <a href="/orders">Orders</a><br>
                    <a href="/customers">Customers</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
