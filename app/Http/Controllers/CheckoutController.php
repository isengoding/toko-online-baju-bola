<?php

namespace App\Http\Controllers;

use Xendit\Xendit;
use App\Models\Address;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = \Cart::session(100)->getContent()->sortBy('id');

        $address = Address::where('user_id', auth()->user()->id)->where('is_default', '1')->first();

        return view('pages.user.checkout.index', compact('carts', 'address'));
    }


}
