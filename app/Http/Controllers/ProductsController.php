<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Number of products
        $totalProducts = count(Product::get());

        // Total Inventory
        $inventory = DB::select("SELECT SUM(inventory) AS totalsum FROM products");
        $inventory = number_format($inventory[0]->totalsum);

        // Products search
        $search = $request['searchProducts'];

        if ($request->has('searchProducts')) {
            $products = Product::search($search)->orderBy('created_at', 'desc')->
                                 paginate(10)->onEachSide(1);
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(10)->onEachSide(1);
        }

        return view('products.products', [
            'products' => $products,
            'totalProducts' => $totalProducts,
            'inventory' => $inventory,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name' => 'required',
            'type' => 'required',
            'brand' => 'required',
            'inventory' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->type = $request->input('type');
        $product->brand = $request->input('brand');
        $product->inventory = $request->input('inventory');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return redirect('/products')->with('success', 'Product Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Finding orders of this product
        // $ordersWithProduct = Order::orderBy('created_at', 'desc')->
        //                             where('product_id', $product->id)->paginate(10);

        return view('products.show', [
            'product' => $product,
            // 'ordersWithProduct' => $ordersWithProduct,
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
        $product = Product::findOrFail($id);

        return view('products.edit')->with('product', $product);
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
            'inventory' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        $product = Product::findOrFail($id);
        $product->inventory = $request->input('inventory');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return redirect('/products')->with('success', 'Product Updated');
    }

}