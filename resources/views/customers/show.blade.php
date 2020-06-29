@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h1 class="mb-4">Customer: {{$customer->customer_name}}</h1>
                <div class="card shadow-sm">
                    <div class="card-body m-3">
                        <div class="float-right d-flex">
                            <a href="/customers/{{$customer->id}}/edit" class="btn btn-primary mr-2">Edit</a>
                            <div>
                                <form action="/customers/{{$customer->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger" 
                                            onclick="return confirm('Delete Customer?')">Delete</button>
                                </form>
                            </div>
                        </div>
                        <h4 class="font-weight-bold mb-3 text-muted">Customer Information</h4>
                        <div class="details">
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Customer ID:</span>{{$customer->id}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Customer Name:</span>{{$customer->customer_name}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Address:</span>{{$customer->address}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Phone:</span>{{$customer->phone_number}}</h5>
                            <h5 class="mb-3"><span class="font-weight-bold mr-2">Contact Preference:</span>{{$customer->contact_method}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection