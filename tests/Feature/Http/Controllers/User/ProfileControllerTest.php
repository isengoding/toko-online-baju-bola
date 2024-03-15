<?php

namespace Tests\Feature\Http\Controllers\User;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
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
    public function can_display_edit_view_for_user_profile()
    {

        $response = $this->get(route('user.profile.edit'));

        $response
            ->assertOk()
            ->assertViewIs('pages.user.profile.edit');
    }

    /**
     * @test
     */
    public function can_updates_the_user_profile()
    {

        $updateProfileUser = [
            'name' => 'test update name',
            'email' => 'updateemail@example.com',
        ];

        $response = $this->put(route('user-profile-information.update'), $updateProfileUser);


        $this->assertDatabaseHas('users', $updateProfileUser);

        $response->assertSessionHas('success');
    }

}
