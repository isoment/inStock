@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">Add A New Product</h1>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-div">
                            <form action="/products" method="POST">
                                @csrf

                                @error('name')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="name" class="font-weight-light">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                                </div>

                                @error('type')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="type" class="font-weight-light">Type</label>
                                    <input type="text" class="form-control" id="type" name="type" value="{{old('type')}}">
                                </div>

                                @error('brand')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="brand" class="font-weight-light">Brand</label>
                                    <input type="text" class="form-control" id="brand" name="brand" value="{{old('brand')}}">
                                </div>

                                @error('inventory')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="inventory" class="font-weight-light">Inventory</label>
                                    <input type="number" class="form-control" id="inventory" name="inventory" value="{{old('inventory')}}">
                                </div>

                                @error('price')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="price" class="font-weight-light">Price</label>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-light">$</div>
                                        <input type="text" class="form-control ml-2" id="price" name="price" value="{{old('price')}}">
                                    </div>
                                </div>

                                @error('description')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="description" class="font-weight-light">Description</label>
                                    <textarea name="description" id="description" 
                                              cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                    <a class="btn btn-secondary" href="/products">Back to Products</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection