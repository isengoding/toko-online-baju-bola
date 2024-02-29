<?php

namespace Tests\Feature\Http\Controllers\Guest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function can_render_all_product_page()
    {

        $response = $this->get('/products');

        $response
            ->assertOk()
            ->assertViewIs('pages.guest.product.index')
            ->assertViewHas('products');
    }
}
