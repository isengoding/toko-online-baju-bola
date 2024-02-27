<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandControllerTest extends TestCase
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
    public function can_render_brand_index_page()
    {
        Brand::factory()->count(5)->create();

        $response = $this->get('/admin/brands');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.brand.index')
            ->assertViewHas('brands');
    }

    /**
     * @test
     */
    public function can_display_create_view_for_brand()
    {
        $response = $this->get('admin/brands/create');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.brand.create');
    }

    /**
     * @test
     */
    public function can_stores_the_brand()
    {

        $newBrand = Brand::factory()
            ->make(['image' => UploadedFile::fake()->image('test.jpg')])
            ->toArray();

        $response = $this->post(route('brands.store'), $newBrand);

        $this->assertDatabaseHas('brands', [
            'name' => $newBrand['name'],
            'image' => 'test.jpg',
        ]);

        $this->assertFileExists(public_path('assets/img/brand/test.jpg'));

        $response
            ->assertRedirect(route('brands.index'))
            ->assertSessionHas('success');

    }

    /**
     * @test
     */
    public function can_display_edit_view_for_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brands.edit', $brand));

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.brand.edit')
            ->assertViewHas('brand');
    }

    /**
     * @test
     */
    public function can_updates_the_brand()
    {

        $existingBrand = Brand::factory()->create([
            'name' => 'existing-brand',
            'image' => 'existing-image.jpg',
        ]);
        $existingImage = UploadedFile::fake()->image('existing-image.jpg');

        $existingImage->move(public_path('/assets/img/brand'), $existingImage->getClientOriginalName());

        $updateBrand = Brand::factory()->make([
            'name' => 'update-brand',
            'image' => UploadedFile::fake()->image('updateImage.jpg')
        ])->toArray();

        $response = $this->put(route('brands.update', $existingBrand), $updateBrand);


        $this->assertDatabaseHas('brands', [
            'name' => $updateBrand['name'],
            'image' => 'updateImage.jpg',
        ]);

        $this->assertFileDoesNotExist(public_path('assets/img/brand/existing-image.jpg'));
        $this->assertFileExists(public_path('assets/img/brand/updateImage.jpg'));

        $response
            ->assertRedirect(route('brands.index'))
            ->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function can_deletes_the_product()
    {
        $existingBrand = Brand::factory()->create([
            'name' => 'existing-brand',
            'image' => 'existing-image.jpg',
        ]);
        $existingImage = UploadedFile::fake()->image('existing-image.jpg');

        $existingImage->move(public_path('/assets/img/brand'), $existingImage->getClientOriginalName());

        $response = $this->delete(route('brands.destroy', $existingBrand));

        $response
            ->assertRedirect(route('brands.index'))
            ->assertSessionHas('success');

        $this->assertModelMissing($existingBrand);
        $this->assertFileDoesNotExist(public_path('assets/img/brand/existing-image.jpg'));

    }
}
