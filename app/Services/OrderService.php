<?php

namespace App\Services;

use Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class OrderService
{
    private $apiKey;

    public function __construct()
    {
        $this->setApiKey(env('XENDIT_SECRET_KEY'));
    }

    public function setApiKey($value)
    {
        $this->apiKey = $value;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }



    /**
     * Create an invoice using the provided data and send a post request to the Xendit API.
     *
     * @return array The response from the Xendit API as an associative array.
     */
    public function createInvoice()
    {
        $data = [
            'external_id' => "INV/" . date('dmY') . "/" . time(),
            // 'description' => 'harusa ada description?',
            'amount' => \Cart::session(100)->getTotal(),
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            'reminder_time' => 1,
            'success_redirect_url' => 'localhost:8000',
            'customer' => [
                "given_names" => "John",
                "surname" => "Doe",
                "email" => "johndoe@example.com",
                "mobile_number" => "+6287774441111",
                "addresses" => [
                    [

                        "city" => "Jakarta Selatan",
                        "country" => "Indonesia",
                        "postal_code" => "12345",
                        "state" => "Daerah Khusus Ibukota Jakarta",
                        "street_line1" => "Jalan Makan",
                        "street_line2" => "Kecamatan Kebayoran Baru"
                    ]

                ]
            ],
            "items" => $this->getItemsCart(),
            // "should_send_email" => true,
        ];

        $api_key = base64_encode($this->getApiKey());
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $api_key,
        ];

        $res = Http::withHeaders($headers)->post('https://api.xendit.co/v2/invoices', $data);

        return json_decode($res->body(), true);
    }

    /**
     * Retrieves the items in the cart and organizes them into an array.
     *
     * @return array The array of items in the cart
     */
    public function getItemsCart()
    {

        $carts = Cart::session(100)->getContent()->sortBy('id');

        $items = [];

        foreach ($carts as $cart) {
            $item = [
                'name' => $cart->name,
                'quantity' => $cart->quantity,
                'price' => $cart->price,
                'category' => 'away',
                'url' => 'www.kaosan.com',
            ];

            array_push($items, $item);
        }

        return $items;
    }


    public function store()
    {

        $result = $this->createInvoice();

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'no_order' => $result['external_id'],
                'invoice_id' => $result['id'],
                'checkout_url' => $result['invoice_url'],
                'status_payment' => $result['status'],
                'total' => $result['amount'],
            ]);

            $carts = Cart::session(100)->getContent()->sortBy('id');

            foreach ($carts as $cart) {

                $order->orderDetails()->create([

                    'product_id' => $carts->first()->associatedModel->id,
                    'stock_id' => $cart->attributes[0]['stock_id'],
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'total' => $cart->price * $cart->quantity,
                ]);

            }

            Cart::session(100)->clear();

            DB::commit();

            return $order;

        } catch (\Throwable $e) {

            DB::rollBack();

            throw $e;
        }

    }
}
