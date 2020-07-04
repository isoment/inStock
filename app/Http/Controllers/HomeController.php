<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $revenue = DB::select("SELECT SUM(order_subtotal) AS totalsum FROM orders");
        $revenue = number_format($revenue[0]->totalsum, 2);
        $totalOrders = count(Order::get());
        $orders = Order::take(5)->orderBy('created_at', 'desc')->get();

        return view('home', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'revenue' => $revenue,
        ]);
    }
}
