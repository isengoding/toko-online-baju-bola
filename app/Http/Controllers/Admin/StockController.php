<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter['search'] = request()->keyword;

        $stocks = Stock::query()
            ->filter($filter)
            ->latest()
            ->paginate(10);

        return view('pages.admin.stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.admin.stock.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required',
            'size_stock' => 'required|numeric|min:0',
        ]);

        Stock::create([
            'product_id' => $request->product_id,
            'size' => $request->size,
            'size_stock' => $request->size_stock,
        ]);

        $request->session()->flash('success', 'Stock created successfully');

        return redirect()->route('stocks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        $products = Product::all();
        return view('pages.admin.stock.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required',
            'size_stock' => 'required|numeric|min:0',
        ]);

        $stock->update([
            'product_id' => $request->product_id,
            'size' => $request->size,
            'size_stock' => $request->size_stock,
        ]);

        $request->session()->flash('success', 'Stock updated successfully');

        return redirect()->route('stocks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully');
    }
}
