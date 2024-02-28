<?php

namespace Tests\Feature\Http\Controllers\Guest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertViewIs('pages.guest.homepage')
            ->assertViewHas('products');
    }
}
