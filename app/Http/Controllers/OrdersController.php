<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
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
    public function index(Request $request)
    {
        $orderCount = Order::count();

        $revenue = DB::select("SELECT SUM(order_subtotal) AS totalsum FROM orders");
        $revenue = number_format($revenue[0]->totalsum, 2);

        $search = $request['searchOrders'];

        if ($request->has('searchOrders')) {
            $orders = Order::search($search)->orderBy('created_at', 'desc')->
                             paginate(10)->onEachSide(1);
        } else {
            $orders = Order::orderBy('created_at', 'desc')->paginate(10)->onEachSide(1);
        }

        return view('orders.orders', [
            'orders' => $orders,
            'orderCount' => $orderCount,
            'revenue' => $revenue,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $search = $request['searchCustomers'];

        if ($request->has('searchCustomers')) {
            $customers = Customer::search($search)->orderBy('created_at', 'desc')->
                                   paginate(10)->onEachSide(1);
        } else {
            $customers = Customer::orderBy('created_at', 'desc')->
                                   paginate(10)->onEachSide(1);
        }

        return view('orders.create', [
            'customers' => $customers,
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
            'customer_id' => 'required|numeric',
            'ship_to' => 'required',
            'ship_address' => 'required',
        ]);

        $order = new Order;
        $order->customer_id = $request['customer_id'];
        $order->ship_to = $request['ship_to'];
        $order->ship_address = $request['ship_address'];
        $order->save();

        return redirect('/orders/' . $order->id . '/edit')->with('success', 'Order Added');
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

        $subTotal = $order->order_subtotal;

        $total = $subTotal + $order->tax + $order->shipping;

        return view('orders.show', [
            'order' => $order,
            'subTotal' => number_format($subTotal, 2),
            'total' => number_format($total, 2),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $search = $request['searchProducts'];

        if ($request->has('searchProducts')) {
            $products = Product::search($search)->orderBy('created_at', 'desc')->
                                 paginate(10)->onEachSide(1);
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(10)->onEachSide(1);
        }

        $order = Order::findOrFail($id);

        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        // Getting item subtotal
        $calculations = OrderDetail::where('order_id', $order->id)->
                                     get(['quantity', 'unit_cost'])->toArray();

        $itemsTotal = array();

        foreach ($calculations as $calculation) {
            $itemsTotal[] = $calculation['quantity'] * $calculation['unit_cost'];
        }

        if ($itemsTotal) {
            $orderSubTotal = array_sum($itemsTotal);
        } else {
            $orderSubTotal = "0";
        }
          
        return view('orders.edit', [
            'order' => $order,
            'products' => $products,
            'orderDetails' => $orderDetails,
            'orderSubTotal' => $orderSubTotal,
        ]);
    }

    public function addItems(Request $request, $id) 
    {
        $this->validate($request, [
            'quantity' => 'required',
            'product' => 'required',
        ]);

        $order = Order::findOrFail($id);

        $product = Product::findOrFail($request['product']);
        $productID = $product->id;

        if (OrderDetail::where('product_id', $request['product'])->
                         where('order_id', $order->id)->first()) {
            return redirect('/orders/' . $order->id . '/edit')->
                   with('danger', 'Product already added');
        } else {
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $productID;
            $orderDetail->quantity = $request['quantity'];
            $orderDetail->unit_cost = $product->price;
            $orderDetail->save();

            return redirect('/orders/' . $order->id . '/edit')->
                   with('success', 'Product added');
        }
    }

    public function removeItems(Request $request, $id) 
    {

        $this->validate($request, [
            'product' => 'required',
        ]);

        $order = Order::findOrFail($id);

        $orderDetail = OrderDetail::where('product_id', $request['product'])->
                                    where('order_id', $order->id)->first();

        if ($orderDetail) {
            $orderDetail->delete();
            return redirect('/orders/' . $id . '/edit')->with('success', 'Items removed');
        }
        return redirect('/orders/' . $id . '/edit')->with('danger', 'No items to remove');
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
            'status' => 'required',
            'tracking' => 'required',
            'shipper' => 'required',
            'ship_to' => 'required',
            'ship_address' => 'required',
            'tax' => 'numeric|nullable',
            'shipping' => 'numeric|nullable',
            'order_subtotal' => 'numeric',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request['status'];
        $order->tracking = $request['tracking'];
        $order->shipper = $request['shipper'];
        $order->ship_to = $request['ship_to'];
        $order->ship_address = $request['ship_address'];
        $order->tax = $request['tax'];
        $order->shipping = $request['shipping'];
        $order->order_subtotal = $request['order_subtotal'];
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
