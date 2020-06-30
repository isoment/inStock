@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4 justify-content-center">
            <div class="col-5 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h1 id="product-numbers-h1" class="font-weight-bold text-info">{{$totalCustomers}}</h1>
                        Total Customers
                    </div>
                </div>
            </div>
            <div class="col-5 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h1 id="product-worth-h1" class="font-weight-bold text-info">0</h1>
                        TEXT
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

                        <h3 class="text-muted mb-4">Customers</h3>

                        <div class="d-flex flex-column flex-md-row justify-content-md-between">
                            <a href="/customers/previous" 
                            class="mb-3 btn btn-primary">Create From Previous Order</a>
                            <a href="/customers/create" 
                            class="btn btn-success mb-3">Create Customer</a>
                        </div>

                        <div>
                            <form action="/customers" method="GET">
                                <div class="row mb-4">
                                    <div class="col-8 col-lg-10">
                                        <input type="text" name="searchCustomers" class="form-control" placeholder="Search Customers">
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <button class="btn btn-secondary float-right">Search</button>
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Contact Pref</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <th scope="row">{{$customer->id}}</th>
                                        <td>{{$customer->customer_name}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{$customer->phone_number}}</td>
                                        <td>{{$customer->contact_method}}</td>
                                        <td class="text-center">
                                            <a href="/customers/{{$customer->id}}" class="btn-sm btn-primary remove-link-styling">View</a>
                                            <a href="/customers/{{$customer->id}}/edit" class="btn-sm btn-secondary remove-link-styling">Edit</a>
                                        </td>
                                    </tr>    
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $customers->links() }}
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection