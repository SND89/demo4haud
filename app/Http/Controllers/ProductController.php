<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\fs;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::with('stock', 'image')->get();
        $categor = Category::with('product', 'product.stock', 'product.image')->get();

        $products = Product::with('stock', 'image')->withSum('stock as QTY', 'qty')->orderBy('category_id', 'ASC')->get();

        return view('product', compact('categor', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fs  $fs
     * @return \Illuminate\Http\Response
     */
    public function show(fs $fs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fs  $fs
     * @return \Illuminate\Http\Response
     */
    public function edit(fs $fs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fs  $fs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fs $fs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fs  $fs
     * @return \Illuminate\Http\Response
     */
    public function destroy(fs $fs)
    {
        //
    }
}
