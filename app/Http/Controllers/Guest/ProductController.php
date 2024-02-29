<?php

namespace App\Http\Controllers\Guest;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        $filter['search'] = request()->keyword;

        $products = Product::query()
            ->filter($filter)
            ->latest()
            ->paginate(10);

        return view('pages.guest.product.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('pages.guest.product.show', compact('product'));
    }
}
