<?php

namespace Tests\Feature\Http\Controllers\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressControllerTest extends TestCase
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
    public function can_render_address_index_page()
    {
        Address::factory()->count(5)->create();

        $response = $this->get('/addresses');

        $response
            ->assertOk()
            ->assertViewIs('pages.user.address.index')
            ->assertViewHas('addresses');
    }

    /**
     * @test
     */
    public function can_display_create_view_for_address()
    {
        $response = $this->get('/addresses/create');

        $response
            ->assertOk()
            ->assertViewIs('pages.user.address.create');
    }

    /**
     * @test
     */
    public function can_stores_the_address()
    {

        $newAddress = Address::factory()
            ->make([
                'user_id' => auth()->user()->id,
            ])
            ->toArray();

        $response = $this->post(route('user.addresses.store'), $newAddress);

        $this->assertDatabaseHas('addresses', $newAddress);

        $response
            ->assertRedirect(route('user.addresses.index'))
            ->assertSessionHas('success');

    }

    /**
     * @test
     */
    public function can_display_edit_view_for_address()
    {
        $address = Address::factory()->create();

        $response = $this->get(route('user.addresses.edit', $address));

        $response
            ->assertOk()
            ->assertViewIs('pages.user.address.edit')
            ->assertViewHas('address');
    }

    /**
     * @test
     */
    public function can_updates_the_address()
    {

        $existingAddress = Address::factory()->create([
            'user_id' => auth()->user()->id,
        ]);

        $updateAddress = Address::factory()->make([
            'user_id' => auth()->user()->id,
        ])->toArray();

        $response = $this->put(route('user.addresses.update', $existingAddress), $updateAddress);

        unset($updateAddress['is_default']);

        $this->assertDatabaseHas('addresses', $updateAddress);

        $response
            ->assertRedirect(route('user.addresses.index'))
            ->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function can_deletes_the_address()
    {
        $existingAddress = Address::factory()->create();

        $response = $this->delete(route('user.addresses.destroy', $existingAddress));

        $response
            ->assertRedirect(route('user.addresses.index'))
            ->assertSessionHas('success');

        $this->assertModelMissing($existingAddress);

    }
}
