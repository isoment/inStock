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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection