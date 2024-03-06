<?php

namespace Tests\Feature\Http\Controllers\User;

use Cart;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use Xendit\Configuration;
use Mockery\MockInterface;
use App\Services\OrderService;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Create a user instance for the tests
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->withoutExceptionHandling();
    }

    public function test_create_invoice_success_mock()
    {

        $body = file_get_contents(base_path('tests/Feature/Http/Controllers/User/body.json'));

        $stock = Stock::factory()->create();
        $rowId = $stock->product_id . '-' . $stock->id;

        \Cart::session(100)->add(
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

        Http::fake([
            'https://api.xendit.co/v2/invoices' => Http::response($body, 200),
        ]);

        $result = json_decode($body);

        $response = $this->post('orders');

        $this->assertDatabaseHas('orders', [
            'user_id' => auth()->user()->id,
            'no_order' => $result->external_id,
            'invoice_Id' => $result->id,
            'checkout_url' => $result->invoice_url,
            'status_payment' => 'PENDING',
            'total' => $result->amount,
        ]);

        $order = Order::first();

        $this->assertDatabaseHas('order_details', [
            'order_id' => $order->id,
            'product_id' => $stock->product_id,
            'stock_id' => $stock->id,
            'quantity' => 1,
            'price' => $stock->product->price,
            'total' => $stock->product->price * 1,
        ]);

        $response
            ->assertRedirect(route('user.orders.show', $order->id));
        // ->assertSessionHas('success');

    }


    public function test_cancel_invoice()
    {

        $body = file_get_contents(base_path('tests/Feature/Http/Controllers/User/bodyResponseExpireInvoice.json'));

        $existingOrder = Order::factory()->create([
            'user_id' => auth()->user()->id,
            'status_payment' => 'PENDING',
        ]);

        Http::fake([
            'https://api.xendit.co/invoices/' . $existingOrder->invoice_id . '/expire!' => Http::response($body, 200),
        ]);

        $response = $this->get('orders/cancel/' . $existingOrder->id);

        $this->assertDatabaseHas('orders', [
            'status_payment' => 'EXPIRED',
        ]);

        $response
            ->assertRedirect(route('user.orders.show', $existingOrder->id));
        // ->assertSessionHas('success');

    }
}
