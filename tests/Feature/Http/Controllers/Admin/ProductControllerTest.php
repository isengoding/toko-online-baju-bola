<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
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
    public function can_render_product_index_page()
    {
        Product::factory()->count(5)->create();

        $response = $this->get('/admin/products');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.product.index')
            ->assertViewHas('products');
    }

    /**
     * @test
     */
    public function can_display_create_view_for_product()
    {
        $response = $this->get('admin/products/create');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.product.create')
            ->assertViewHas('brands')
            ->assertViewHas('teams');
    }

    /**
     * @test
     */
    public function can_stores_the_product()
    {

        $newProduct = Product::factory()
            ->make(['image' => UploadedFile::fake()->image('product-test.jpg')])
            ->toArray();

        $response = $this->post(route('products.store'), $newProduct);

        $this->assertDatabaseHas('products', [
            'name' => $newProduct['name'],
            'sku' => $newProduct['sku'],
            'price' => $newProduct['price'],
            'description' => $newProduct['description'],
            'size_guide' => $newProduct['size_guide'],
            'team_id' => $newProduct['team_id'],
            'brand_id' => $newProduct['brand_id'],
            'type' => $newProduct['type'],
            'image' => 'product-test.jpg',
        ]);

        $this->assertFileExists(public_path('assets/img/product/product-test.jpg'));

        $response
            ->assertRedirect(route('products.index'))
            ->assertSessionHas('success');

    }

    /**
     * @test
     */
    public function can_display_edit_view_for_product()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.product.edit')
            ->assertViewHas('product')
            ->assertViewHas('brands')
            ->assertViewHas('teams');
    }

    /**
     * @test
     */
    public function can_updates_the_product()
    {

        $existingProduct = Product::factory()->create([
            'name' => 'existing-product',
            'image' => 'existing-image.jpg',
        ]);
        $existingImage = UploadedFile::fake()->image('existing-image.jpg');

        $existingImage->move(public_path('/assets/img/product'), $existingImage->getClientOriginalName());

        $updateProduct = Product::factory()->make([
            'name' => 'update-brand',
            'image' => UploadedFile::fake()->image('updateImage.jpg')
        ])->toArray();

        $response = $this->put(route('products.update', $existingProduct), $updateProduct);


        $this->assertDatabaseHas('products', [
            'name' => $updateProduct['name'],
            'sku' => $updateProduct['sku'],
            'price' => $updateProduct['price'],
            'description' => $updateProduct['description'],
            'size_guide' => $updateProduct['size_guide'],
            'team_id' => $updateProduct['team_id'],
            'brand_id' => $updateProduct['brand_id'],
            'type' => $updateProduct['type'],
            'image' => 'updateImage.jpg',
        ]);

        $this->assertFileDoesNotExist(public_path('assets/img/product/existing-image.jpg'));
        $this->assertFileExists(public_path('assets/img/product/updateImage.jpg'));

        $response
            ->assertRedirect(route('products.index'))
            ->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function can_deletes_the_product()
    {
        $existingProduct = Product::factory()->create([
            'name' => 'existing-product',
            'image' => 'existing-image.jpg',
        ]);
        $existingImage = UploadedFile::fake()->image('existing-image.jpg');

        $existingImage->move(public_path('/assets/img/product'), $existingImage->getClientOriginalName());

        $response = $this->delete(route('products.destroy', $existingProduct));

        $response
            ->assertRedirect(route('products.index'))
            ->assertSessionHas('success');

        $this->assertModelMissing($existingProduct);
        $this->assertFileDoesNotExist(public_path('assets/img/product/existing-image.jpg'));

    }
}
