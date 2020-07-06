<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
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

        // Graphing this months revenue by day...
        // We first get the created_at dates starting at the first of this month
        // DAY returns day of month from specified date, sum the order_subtotal
        $revenueByDay = Order::where('created_at', '>=', Carbon::now()->subDays(7))->
                       selectRaw('DAY(created_at) as day, SUM(order_subtotal) as revenue')->
                       groupBy('day')->
                       pluck('revenue', 'day');

        // Getting the days and adding numeric month
        $day = $revenueByDay->keys();
        $withMonthName = array();
        foreach ($day as $key => $value) {
            $withMonthName[] = date('n') . '/' . $value;
        }
        $monthNameCollection = collect($withMonthName);

        // Values and adding currency and formatting
        $dollars = $revenueByDay->values();

        return view('home', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'revenue' => $revenue,
            'monthName' => $monthNameCollection,
            'dollars' => $dollars,
        ]);
    }
}
