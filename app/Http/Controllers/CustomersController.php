<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalCustomers = count(Customer::get());
        $totalOrders = count(Order::get());

        $search = $request['searchCustomers'];

        if ($request->has('searchCustomers')) {
            $customers = Customer::search($search)->orderBy('created_at', 'desc')->
                                   paginate(10)->onEachSide(1);
        } else {
            $customers = Customer::orderBy('created_at', 'desc')->
                                   paginate(10)->onEachSide(1);
        }

        if ($totalCustomers === 0) {
            $avgOrderPerCustomer = 0;
        } else {
            $avgOrderPerCustomer = $totalOrders / $totalCustomers;
        }
        
        // $orderCount = DB::select('SELECT customer_id, COUNT(*) AS magnitude 
        //                           FROM orders 
        //                           GROUP BY customer_id 
        //                           ORDER BY magnitude DESC');

        return view('customers.customers', [
            'customers' => $customers,
            'totalCustomers' => $totalCustomers,
            'avgOrdersPerCustomer' => $avgOrderPerCustomer,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'contact_method' => 'required',
        ]);

        $customer = new Customer;
        $customer->customer_name = $request['customer_name'];
        $customer->email = $request['email'];
        $customer->address = $request['address'];
        $customer->phone_number = $request['phone_number'];
        $customer->contact_method = $request['contact_method'];
        $customer->save();

        return redirect('/customers')->with('success', 'Customer Saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', [
            'customer' => $customer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'customer_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'contact_method' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->customer_name = $request['customer_name'];
        $customer->email = $request['email'];
        $customer->address = $request['address'];
        $customer->phone_number = $request['phone_number'];
        $customer->contact_method = $request['contact_method'];
        $customer->save();

        return redirect('/customers')->with('success', 'Customer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect('/customers')->with('success', 'Customer Removed');
    }
}
