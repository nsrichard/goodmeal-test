<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;

class ProductManagementTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function list_of_products_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        // fake data
        Store::factory()->count(3)->create();
        Category::factory()->count(3)->create();
        $products = Product::factory()->count(2)->create();

        $response = $this->get('/api/product');

        // response ok
        $response->assertOk();

        // get all stores
        $products = Product::all();

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

        // count created items 
        $response->assertJsonCount(2, 'response.data');
    }

    /** @test */
    public function a_product_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        // fake data
        Store::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();

        $response = $this->get('/api/product/'.$product->id);

        // response ok
        $response->assertOk();

        // get last data
        $productLast = Product::first();

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

        // compare data
        $this->assertEquals($productLast->id, $product->id);
        $this->assertEquals($productLast->id, $response['response']['data']['id']);
    }

    /** @test */
    public function a_product_can_be_created()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();
        $category = Category::factory()->create();

        $response = $this->post('/api/product', [
            'store_id' => $store->id,
            'category_id' => $category->id,
            'name' => 'Test name',
            'description' => 'Test description',
            'image' => 'https://dummyimage.com/160x160/bfbfbf/0364ff.jpg',
            'price' => 1000.50,
            'discount' => 30,
            'stock' => 20,
        ]);

        // first response Ok
        $response->assertCreated();

        // verify if exists record
        $this->assertCount(1, Product::all());

        // get saved item
        $product = Product::first();

        // verify data item from database
        $this->assertEquals('Test name', $product->name);
        $this->assertEquals($store->id, $product->store_id);
        $this->assertEquals(1000.50, $product->price);
        // .. all attributes

        // verify json response
        $response->assertJson([
            'code' => 201,
            'msg' => 'OK'
        ]);
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();
        $category = Category::factory()->create();

        $product = Product::factory()->create();

        $response = $this->put('/api/product/'. $product->id, [
            'store_id' => $store->id,
            'category_id' => $category->id,
            'name' => 'Test name',
            'description' => 'Test description',
            'image' => 'https://dummyimage.com/160x160/bfbfbf/0364ff.jpg',
            'price' => 1000.50,
            'discount' => 30,
            'stock' => 20,
        ]);

        // first response Ok
        $response->assertOk();

        // verify if exists record
        $this->assertCount(1, Product::all());

        // get saved item
        $product = $product->fresh();

        // verify data item from database
        $this->assertEquals('Test name', $product->name);
        $this->assertEquals(30, $product->discount);
        $this->assertEquals(1000.50, $product->price);
        // .. all attributes

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        Store::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();

        $response = $this->delete('/api/product/' . $product->id);

        // first response Ok
        $response->assertOk();

        // verify if exists record
        $this->assertCount(0, Product::all());

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

    }

    // validations

    /** @test */
    public function data_product_is_required()
    {
        $response = $this->post('/api/product', [
            'store_id' => '',
            'category_id' => '',
            'name' => '',
            'description' => '',
        ]);

        $response->assertSessionHasErrors(['store_id']);
        $response->assertSessionHasErrors(['category_id']);
        $response->assertSessionHasErrors(['name']);
        $response->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function data_product_is_exists()
    {
        $response = $this->post('/api/product', [
            'store_id' => 120,
            'category_id' => 15,
        ]);

        $response->assertSessionHasErrors(['store_id']);
        $response->assertSessionHasErrors(['category_id']);
    }
}
