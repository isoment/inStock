@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4 justify-content-center">
            <div class="col-5 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h1 id="product-numbers-h1" class="font-weight-bold text-info">{{$totalProducts}}</h1>
                        Unique Product
                    </div>
                </div>
            </div>
            <div class="col-5 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h1 id="product-worth-h1" class="font-weight-bold text-info">{{$inventory}}</h1>
                        Total Inventory
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

                        <div class="d-flex justify-content-between">
                            <h3 class="text-muted">Products</h3>

                            <a href="{{ route('products.create') }}" 
                               class="btn btn-success mb-3 float-right">New Product</a>
                        </div>

                        <div>
                            <form action="/products" method="GET">
                                <div class="row mb-4">
                                    <div class="col-8 col-lg-10">
                                        <input type="text" name="searchProducts" class="form-control" placeholder="Search by Name, Type or Brand">
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <button class="btn btn-secondary float-right">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive-lg">
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
                                    <tr>
                                        <th scope="row">{{$product->id}}</th>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->type}}</td>
                                        <td>{{$product->brand}}</td>
                                        <td>{{$product->inventory}}</td>
                                        <td>${{$product->price}}</td>
                                        <td class="text-center">
                                            <a href="/products/{{$product->id}}" class="btn-sm btn-primary remove-link-styling">View</a>
                                            <a href="/products/{{$product->id}}/edit" class="btn-sm btn-secondary remove-link-styling">Edit</a>
                                        </td>
                                    </tr>    
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $products->links() }}
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection