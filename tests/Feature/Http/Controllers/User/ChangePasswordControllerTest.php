<?php

namespace Tests\Feature\Http\Controllers\User;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePasswordControllerTest extends TestCase
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

    /**
     * @test
     */
    public function can_display_change_password_for_user()
    {

        $response = $this->get(route('user.password.edit'));

        $response
            ->assertOk()
            ->assertViewIs('pages.user.password.edit');
    }

}
