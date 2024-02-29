<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = \Cart::session(100)->getContent()->sortBy('id');

        return view('pages.user.checkout.index', compact('carts'));
    }
}
