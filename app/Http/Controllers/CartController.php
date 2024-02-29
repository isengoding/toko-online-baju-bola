<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Models\Stock;
use Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = \Cart::session(100)->getContent()->sortBy('id');

        return view('pages.guest.cart.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {

        $stock = Stock::find($request->stock_id);

        $rowId = $stock->product_id . '-' . $stock->id; // generate a unique() row ID
        // $userID = 2; // the user ID to bind the cart contents

        // add the product to cart
        Cart::session(100)->add(
            array(
                'id' => $rowId,
                'name' => $stock->product->name,
                'price' => $stock->product->price,
                'quantity' => 1,
                'attributes' => array(
                    [
                        'stock_id' => $stock->id,
                        'size' => $stock->size,
                        'type' => $stock->product->type,
                        'brand' => $stock->product->brand->name,
                        'img_url' => 'assets/img/product/' . $stock->product->image,
                    ]
                ),
                'associatedModel' => $stock->product
            )
        );

        session()->flash('success', 'Product added to cart');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        \Cart::session(100)->update($id, [
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
        ]);

        session()->flash('success', 'Product quantity updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::session(100)->remove($id);

        session()->flash('success', 'Product removed from cart');

        return redirect()->back();
    }
}
