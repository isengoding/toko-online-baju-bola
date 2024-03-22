<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
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
    public function can_render_user_index_page()
    {
        User::factory()->count(5)->create();

        $response = $this->get('/admin/users');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.user.index')
            ->assertViewHas('users');
    }

    /**
     * @test
     */
    public function can_display_create_view_for_brand()
    {
        $response = $this->get('admin/users/create');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.user.create');
    }

    /**
     * @test
     */
    public function can_stores_the_user()
    {

        $newUser = User::factory()
            ->make([
                'role' => 'admin',
            ])
            ->toArray();
        $newUser['password'] = 'password';
        $newUser['password_confirmation'] = 'password';

        $response = $this->post(route('users.store'), $newUser);

        $this->assertDatabaseHas('users', [
            'name' => $newUser['name'],
            'email' => $newUser['email'],
            'role' => $newUser['role'],
        ]);

        $response
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success');

    }

    /**
     * @test
     */
    public function can_display_edit_view_for_user()
    {
        $existingUser = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->get(route('users.edit', $existingUser));

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.user.edit')
            // ->assertViewHas('roles')
            ->assertViewHas('user');
    }

    /**
     * @test
     */
    public function can_update_the_user()
    {

        $existingUser = User::factory()->create([
            'role' => 'admin',
        ]);

        $updateUser = User::factory()->make([
            'email' => $existingUser['email']
        ])->toArray();

        $updateUser['password'] = 'password';
        $updateUser['password_confirmation'] = 'password';

        $response = $this->put(route('users.update', $existingUser), $updateUser);

        unset($updateUser['email_verified_at']);
        unset($updateUser['password']);
        unset($updateUser['password_confirmation']);

        $this->assertDatabaseHas('users', $updateUser);


        $response
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function can_delete_the_user()
    {
        $existingUser = User::factory()->create();

        $response = $this->delete(route('users.destroy', $existingUser));

        $response
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success');

        $this->assertModelMissing($existingUser);
    }
}
