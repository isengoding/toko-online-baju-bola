<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Create a user instance for the tests
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($user);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function can_render_stock_index_page()
    {
        Stock::factory()->count(5)->create();

        $response = $this->get('/admin/stocks');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.stock.index')
            ->assertViewHas('stocks');
    }

    /**
     * @test
     */
    public function can_display_create_view_for_stock()
    {
        $response = $this->get('admin/stocks/create');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.stock.create')
            ->assertViewHas('products');
    }

    /**
     * @test
     */
    public function can_stores_the_stock()
    {

        $newStock = Stock::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('stocks.store'), $newStock);

        $this->assertDatabaseHas('stocks', [
            'product_id' => $newStock['product_id'],
            'size' => $newStock['size'],
            'size_stock' => $newStock['size_stock'],
        ]);

        $response
            ->assertRedirect(route('stocks.index'))
            ->assertSessionHas('success');

    }

    /**
     * @test
     */
    public function can_display_edit_view_for_stock()
    {
        $stock = Stock::factory()->create();

        $response = $this->get(route('stocks.edit', $stock));

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.stock.edit')
            ->assertViewHas('products')
            ->assertViewHas('stock');
    }

    /**
     * @test
     */
    public function can_updates_the_stock()
    {

        $existingStock = Stock::factory()->create();

        $updateStock = Stock::factory()->make()->toArray();

        $response = $this->put(route('stocks.update', $existingStock), $updateStock);


        $this->assertDatabaseHas('stocks', [
            'product_id' => $updateStock['product_id'],
            'size' => $updateStock['size'],
            'size_stock' => $updateStock['size_stock'],
        ]);

        $response
            ->assertRedirect(route('stocks.index'))
            ->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function can_deletes_the_stock()
    {
        $existingStock = Stock::factory()->create();

        $response = $this->delete(route('stocks.destroy', $existingStock));

        $response
            ->assertRedirect(route('stocks.index'))
            ->assertSessionHas('success');

        $this->assertModelMissing($existingStock);

    }
}
