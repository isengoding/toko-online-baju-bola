<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
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
    public function can_render_admin_dashboard_page()
    {

        $response = $this->get('/admin/dashboard');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.dashboard');
    }
}
