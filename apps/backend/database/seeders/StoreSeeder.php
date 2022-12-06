<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\StoreOpening;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::factory()->count(10)->create();
        foreach($stores as $store){
            for($i=1; $i<=7; $i++){
                StoreOpening::create([
                    'store_id' => $store->id,
                    'weekday' => $i,
                    'open' => '08:00',
                    'close' => '16:00'
                ]);
            }
        }
    }
}
