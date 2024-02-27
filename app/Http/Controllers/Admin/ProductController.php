<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreProductRequest;
use App\Models\Team;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter['search'] = request()->keyword;

        $products = Product::query()
            ->filter($filter)
            ->latest()
            ->paginate(10);

        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $teams = Team::all();
        return view('pages.admin.product.create', compact(['brands', 'teams']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if (!empty($request->image)) {
            $image = $request->file('image');
            $image->move(public_path('/assets/img/product'), $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = 'default.png';
        }

        Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'type' => $request->type,
            'brand_id' => $request->brand_id,
            'team_id' => $request->team_id,
            'size_guide' => $request->size_guide,
            'description' => $request->description,
            'image' => $imageName,
        ]);



        $request->session()->flash('success', 'Brand created successfully');

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $teams = Team::all();
        return view('pages.admin.product.edit', compact('product', 'brands', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (!empty($request->image)) {
            $image = $request->file('image');
            $image->move(public_path('/assets/img/product'), $image->getClientOriginalName());

            if ($product->image != 'default.png' && File::exists(public_path('/assets/img/product/' . $product->image))) {
                File::delete(public_path('/assets/img/product/' . $product->image));
            }

            $product->update([
                'image' => $image->getClientOriginalName(),
            ]);
        }

        $product->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'type' => $request->type,
            'brand_id' => $request->brand_id,
            'team_id' => $request->team_id,
            'size_guide' => $request->size_guide,
            'description' => $request->description,
        ]);

        $request->session()->flash('success', 'Product updated successfully');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'default.png' && File::exists(public_path('/assets/img/product/' . $product->image))) {
            File::delete(public_path('/assets/img/product/' . $product->image));
        }
        $product->delete();
        return redirect(route('products.index'))->withSuccess('Product deleted successfully');
    }
}
