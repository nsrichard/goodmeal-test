<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use App\Models\Store;
use Database\Factories\StoreFactory;

class StoreManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_stores_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        // fake data
        Store::factory()->count(2)->create();

        $response = $this->get('/api/store');

        // response ok
        $response->assertOk();

        // get all stores
        $stores = Store::all();

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

        // count created items 
        $response->assertJsonCount(2, 'response.data');
    }

    /** @test */
    public function a_store_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        // fake data
        $store = Store::factory()->create();

        $response = $this->get('/api/store/'.$store->id);

        // response ok
        $response->assertOk();

        // get last data
        $storeLast = Store::first();

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

        // compare data
        $this->assertEquals($storeLast->id, $store->id);
        $this->assertEquals($storeLast->id, $response['response']['data']['id']);
    }

    /** @test */
    public function a_store_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/store', [
            'name' => 'Test name',
            'about' => 'Test content',
            'logo' => 'https://dummyimage.com/160x160/bfbfbf/0364ff.jpg',
            'banner' => 'https://dummyimage.com/400x150/bfbfbf/0364ff.jpg',
            'service' => 'store'
        ]);

        // first response Ok
        $response->assertStatus(201);

        // verify if exists record
        $this->assertCount(1, Store::all());

        // get saved item
        $store = Store::first();

        // verify data item from database
        $this->assertEquals('Test name', $store->name);
        $this->assertEquals('Test content', $store->about);
        $this->assertEquals('store', $store->service);
        // .. all attributes

        // verify json response
        $response->assertJson([
            'code' => 201,
            'msg' => 'OK'
        ]);
    }

    /** @test */
    public function a_store_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $response = $this->put('/api/store/'. $store->id, [
            'name' => 'Test name',
            'about' => 'Test content',
            'logo' => 'https://dummyimage.com/160x160/bfbfbf/0364ff.jpg',
            'banner' => 'https://dummyimage.com/400x150/bfbfbf/0364ff.jpg',
            'service' => 'store'
        ]);

        // first response Ok
        $response->assertOk();

        // verify if exists record
        $this->assertCount(1, Store::all());

        // get saved item
        $store = $store->fresh();

        // verify data item from database
        $this->assertEquals('Test name', $store->name);
        $this->assertEquals('Test content', $store->about);
        $this->assertEquals('store', $store->service);
        // .. all attributes

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

    }

    /** @test */
    public function a_store_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $response = $this->delete('/api/store/' . $store->id);

        // first response Ok
        $response->assertOk();

        // verify if exists record
        $this->assertCount(0, Store::all());

        // verify json response
        $response->assertJson([
            'code' => 200,
            'msg' => 'OK'
        ]);

    }

    // validations

    /** @test */
    public function data_store_is_required()
    {
        $response = $this->post('/api/store', [
            'name' => '',
            'about' => '',
            'logo' => 'https://dummyimage.com/160x160/bfbfbf/0364ff.jpg',
            'banner' => 'https://dummyimage.com/400x150/bfbfbf/0364ff.jpg',
            'service' => 'store'
        ]);

        $response->assertSessionHasErrors(['name']);
        $response->assertSessionHasErrors(['about']);
    }
}
