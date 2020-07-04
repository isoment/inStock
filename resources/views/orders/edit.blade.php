@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">Edit Order</h1>
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="manage-items">
                            @include('inc.messages')
                            @error('quantity')
                                <div class="alert alert-danger my-1">{{$message}}</div>
                            @enderror
                            <h3 class="text-muted mt-3 mb-3">Products to Add</h3>
                            <div>
                                <form action="/orders/{{$order->id}}/edit" method="GET">
                                    <div class="row mb-4">
                                        <div class="col-8 col-lg-10">
                                            <input type="text" name="searchProducts" class="form-control" placeholder="Search Products">
                                        </div>
                                        <div class="col-4 col-lg-2">
                                            <button class="btn btn-success float-right">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                        <tr>
                                            <th scope="row">{{$product->id}}</th>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->type}}</td>
                                            <td>{{$product->brand}}</td>
                                            <td>{{$product->inventory}}</td>
                                            <td>${{$product->price}}</td>
                                            <td class="text-center d-flex flex-column flex-lg-row">
                                                <div>
                                                    <form action="/orders/{{$order->id}}/items" method="POST">
                                                        @csrf
                                                        <div class="d-flex flex-column flex-lg-row">
                                                            <input type="number" name="quantity" class="form-control" placeholder="QTY">
                                                            <input type="hidden" name="product" value="{{$product->id}}">
                                                            <button type="submit" class="btn btn-primary remove-link-styling mx-lg-2">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div>
                                                    <form action="/orders/{{$order->id}}/items" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="product" value="{{$product->id}}">
                                                        <button type="submit" class="btn btn-danger remove-link-styling">Remove</button>
                                                    </form>
                                                </div>
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

                        <h3 class="mt-4 mb-3 text-muted">Items in order</h3>
                        <div class="flex-column">
                            <div class="bg-light rounded">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderDetails as $details)
                                        <tr>
                                            <td>{{$details->products->name}}</td>
                                            <td>{{$details->unit_cost}}</td>
                                            <td>{{$details->quantity}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                  </table>
                            </div>
                            <div class="card text-center border border-info mt-2">
                                <h1 class="my-auto text-info py-3">${{number_format($orderSubTotal, 2)}}</h1>
                            </div>
                        </div>


                        <div class="form-div mt-5">
                            <form action="/orders/{{$order->id}}" method="POST">
                                @csrf
                                @method('PUT')

                                @error('status')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="status" class="font-weight-light">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" selected disabled hidden>--- Select ---</option>
                                        <option value="Open">Open</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Refund">Refund</option>
                                        <option value="Void">Void</option>
                                    </select>
                                </div>

                                @error('tracking')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="tracking" class="font-weight-light">Tracking</label>
                                    <input type="text" class="form-control" id="tracking" name="tracking" value="{{$order->tracking}}">
                                </div>

                                @error('shipper')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="shipper" class="font-weight-light">Shipper</label>
                                    <input type="shipper" class="form-control" id="shipper" name="shipper" value="{{$order->shipper}}">
                                </div>

                                @error('ship_to')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="ship_to" class="font-weight-light">Ship To</label>
                                    <input type="text" class="form-control" id="ship_to" name="ship_to" value="{{$order->ship_to}}">
                                </div>

                                @error('ship_address')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="ship_address" class="font-weight-light">Ship Address</label>
                                    <input type="text" class="form-control" id="ship_address" name="ship_address" value="{{$order->ship_address}}">
                                </div>

                                @error('tax')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="tax" class="font-weight-light">Tax</label>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-light">$</div>
                                        <input type="text" class="form-control ml-2" id="tax" name="tax" value="{{$order->tax}}">
                                    </div>
                                </div>

                                @error('shipping')
                                    <div class="alert alert-danger my-1">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="shipping" class="font-weight-light">Shipping</label>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-light">$</div>
                                        <input type="text" class="form-control ml-2" id="shipping" name="shipping" value="{{$order->shipping}}">
                                    </div>
                                </div>
                                
                                <input type="hidden" name="order_subtotal" value="{{$orderSubTotal}}">

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Update Order</button>
                                    <a class="btn btn-secondary" href="/orders">Back to Orders</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection