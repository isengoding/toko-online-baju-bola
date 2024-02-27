<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter['search'] = request()->keyword;

        $brands = Brand::query()
            ->filter($filter)
            ->latest()
            ->paginate(10);

        return view('pages.admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if (!empty($request->image)) {
            $image = $request->file('image');
            $image->move(public_path('/assets/img/brand'), $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = 'default.png';
        }

        // $image = $request->file('image');

        Brand::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);



        $request->session()->flash('success', 'Brand created successfully');

        return redirect()->route('brands.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('pages.admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if (!empty($request->image)) {
            $image = $request->file('image');
            $image->move(public_path('/assets/img/brand'), $image->getClientOriginalName());

            if ($brand->image != 'default.png' && File::exists(public_path('/assets/img/brand/' . $brand->image))) {
                File::delete(public_path('/assets/img/brand/' . $brand->image));
            }

            $brand->update([
                'image' => $image->getClientOriginalName(),
            ]);
        }

        $brand->update([
            'name' => $request->name,
        ]);

        $request->session()->flash('success', 'Brand updated successfully');

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->image != 'default.png' && File::exists(public_path('/assets/img/brand/' . $brand->image))) {
            File::delete(public_path('/assets/img/brand/' . $brand->image));
        }
        $brand->delete();
        return redirect(route('brands.index'))->withSuccess('Brand deleted successfully');
    }
}
