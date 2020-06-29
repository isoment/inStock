<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10)->onEachSide(1);

        $orderCount = count(Order::get());

        $revenue = DB::select("SELECT SUM(item_cost) AS totalsum FROM orders");
        $revenue = number_format($revenue[0]->totalsum, 2);

        return view('orders.orders', [
            'orders' => $orders,
            'orderCount' => $orderCount,
            'revenue' => $revenue,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();

        return view('orders.create', [
            'products' => $products,
        ]);
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
            'product' => 'required',
            'customer_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'tax' => 'required|numeric',
            'shipping' => 'required|numeric',
            'status' => 'required',
            'paid' => 'required'
        ]);

        // Finding product name and price...
        $product = Product::find($request['product']);
        $itemCost = $product->price;
        $productName = $product->name;

        $order = new Order;
        $order->product_id = $request['product'];
        $order->product_name = $productName;
        $order->status = $request['status'];
        $order->tracking = $request['tracking'];
        $order->customer_name = $request['customer_name'];
        $order->email = $request['email'];
        $order->address = $request['address'];
        $order->item_cost = $itemCost;
        $order->tax = $request['tax'];
        $order->shipping = $request['shipping'];
        $order->paid = $request['paid'];
        $order->total_price = $itemCost + $request['tax'] + $request['shipping'];
        $order->save();

        return redirect('/orders')->with('success', 'Order Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $payment = Order::findOrFail($id);
        $productCost = $order->item_cost;
        $totalCost = number_format($productCost + $payment->tax + $payment->shipping, 2);

        return view('orders.show', [
            'order' => $order,
            'productCost' => $productCost,
            'totalCost' => $totalCost,
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
        $order = Order::findOrFail($id);
        $products = Product::get();

        return view('orders.edit', [
            'order' => $order,
            'products' => $products,
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
            'product' => 'required',
            'status' => 'required',
            'customer_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'tax' => 'required|numeric',
            'shipping' => 'required|numeric',
            'paid' => 'required'
        ]);

            // Finding product name and price...
            $product = Product::find($request['product']);
            $itemCost = $product->price;
            $productName = $product->name;
    
            $order = Order::findOrFail($id);
            $order->product_id = $request['product'];
            $order->product_name = $productName;
            $order->status = $request['status'];
            $order->tracking = $request['tracking'];
            $order->customer_name = $request['customer_name'];
            $order->email = $request['email'];
            $order->address = $request['address'];
            $order->item_cost = $itemCost;
            $order->tax = $request['tax'];
            $order->shipping = $request['shipping'];
            $order->paid = $request['paid'];
            $order->total_price = $itemCost + $request['tax'] + $request['shipping'];
            $order->save();
    
            return redirect('/orders')->with('success', 'Order Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect('/orders')->with('success', 'Order Deleted');
    }

}
