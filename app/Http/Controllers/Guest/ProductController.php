<?php

namespace App\Http\Controllers\Guest;

use App\Models\Team;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        $filter['search'] = request()->keyword;
        $filter['type'] = request()->type;
        $filter['brand_id'] = request()->brand_id;
        $filter['team_id'] = request()->team_id;

        $products = Product::query()
            ->filter($filter)
            ->latest()
            ->paginate(10);

        $brands = Brand::all();
        $teams = Team::all();

        return view('pages.guest.product.index', compact('products', 'brands', 'teams'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('pages.guest.product.show', compact('product'));
    }
}
