<?php

namespace Tests\Feature\Http\Controllers\Guest;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
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
    public function can_render_home_page()
    {
        Product::factory()->count(5)->create();

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertViewIs('pages.guest.homepage')
            ->assertViewHas('products');
    }
}
