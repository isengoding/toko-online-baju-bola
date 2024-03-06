<?php

namespace App\Http\Controllers\User;

use Cart;
use Carbon\Carbon;
use App\Models\Order;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Xendit\Invoice\InvoiceApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GrahamCampbell\ResultType\Success;
use Xendit\Invoice\CreateInvoiceRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->paginate();
        return view('pages.user.order.index', compact('orders'));
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
    public function store(Request $request, OrderService $orderService)
    {

        $order = $orderService->store();

        return redirect(route('user.orders.show', $order->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('pages.user.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }


    public function webhook(Request $request)
    {
        if ($request->header('X-CALLBACK-TOKEN') == "M4VxYwLwp7Bon2NTvazmMWoD0uIW77iXUMln5aiBc8w31cwu") {
            // Get the invoice data from the request body
            $invoice = $request->json()->all();
            // return response()->json(['data' => 'Success']);
            // dd($invoice['external_id']);
            // Do something with the invoice data, such as updating your database
            $order = Order::where('no_order', $invoice['external_id'])->firstOrFail();
            // dd($invoice);
            if ($order->status_payment == 'PAID') {
                return response()->json(['data' => 'order has been already processed']);
            }

            if ($invoice['status'] == 'PAID') {
                $order->status_payment = $invoice['status'];
                $order->payment_method = $invoice['payment_channel'];
                $order->payment_date = $invoice['paid_at'];
            }

            if ($invoice['status'] == 'EXPIRED') {
                $order->status_payment = $invoice['status'];
            }

            // Update status order
            $order->save();

            // Return a success response
            return response()->json(['data' => 'Success']);
        } else {
            // Return an unauthorized response
            return response()->json(['error' => 'Invalid callback token'], 401);
        }
    }


    public function cancelOrder(Order $order)
    {
        // https://api.xendit.co/invoices/{invoice_id}/expire!
        // dd($order);
        $api_key = base64_encode(env('XENDIT_SECRET_KEY'));

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $api_key,
        ];

        $res = Http::withHeaders($headers)->post('https://api.xendit.co/invoices/' . $order->invoice_id . '/expire!');

        $result = json_decode($res->body(), true);

        $order->update([
            'status_payment' => $result['status'],
        ]);

        session()->flash('success', 'Order has been canceled');

        return redirect(route('user.orders.show', $order->id));
        // try {
        //     // $apiInstance->expireInvoice($idXendit);

        // } catch (\Xendit\XenditSdkException $e) {
        //     echo 'Exception when calling InvoiceApi->expireInvoice: ', $e->getMessage(), PHP_EOL;
        //     echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        // }
    }
}
