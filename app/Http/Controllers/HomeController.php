<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Product;
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
        // Last 5 orders
        $orders = Order::take(5)->orderBy('created_at', 'desc')->get();
        // Order Total
        $totalOrders = count(Order::get());
        // Revenue
        $revenue = DB::select("SELECT SUM(order_subtotal) AS totalsum FROM orders");
        $revenue = number_format($revenue[0]->totalsum, 2);
        // Products
        $products = Product::take(5)->orderBy('inventory')->get();


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


        // Getting the customer ID and order count in array for Customers Graph
        $idFromOrder = Order::orderBy('customer_id')->pluck('customer_id')->toArray();
        $occurences = array_count_values($idFromOrder);
        // New array with occurence values
        $values = array_values($occurences);
        // Get customer names and combine with occurences array
        $customers = Customer::orderBy('id')->pluck('customer_name')->toArray();
        // Make sure arrays are same size
        if (sizeof($customers) === sizeof($values)) {
            $combine = array_combine($customers, $values);
            // Sort array highest first
            arsort($combine);
            // Get only the top 5 customers
            $toCustomers = array_slice($combine, 0, 5);
            // Two seperate arrays for customer graph keys and values
            $customerName = collect(array_keys($toCustomers));
            $customerOrderCount = collect(array_values($toCustomers));
        } else {
            $customerName = NULL;
            $customerOrderCount = NULL;
        }

        // Get 5 newest customers
        $newestCustomers = Customer::take(5)->orderBy('created_at', 'desc')->get();

        return view('home', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'revenue' => $revenue,
            'days' => $monthNameCollection,
            'dollars' => $dollars,
            'products' => $products,
            'customerName' => $customerName,
            'customerOrderCount' => $customerOrderCount,
            'newestCustomers' => $newestCustomers,
        ]);
    }
}
