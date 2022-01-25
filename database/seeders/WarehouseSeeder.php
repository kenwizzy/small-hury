<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = new Warehouse();
        $store->name = 'Utako';
        $store->slug = 'utako';
        $store->lga_id = 774;
        $store->state_id = 37;
        $store->longitude = 7.483333;
        $store->latitude = 9.066667;
        $store->save();

        $store1 = new Warehouse();
        $store1->name = 'Maitama';
        $store1->slug = 'Maitama';
        $store1->lga_id = 775;
        $store1->state_id = 37;
        $store1->longitude = 7.497654;
        $store1->latitude = 9.085198;
        $store1->save();

        $store2 = new Warehouse();
        $store2->name = 'Gwarimpa';
        $store2->slug = 'Gwarimpa';
        $store2->lga_id = 776;
        $store2->state_id = 37;
        $store2->longitude = 7.39826;
        $store2->latitude = 9.067318;
        $store2->save();

        $store3 = new Warehouse();
        $store3->name = 'Wuse';
        $store3->slug = 'Wuse';
        $store3->lga_id = 777;
        $store3->state_id = 37;
        $store3->longitude = 7.47087;
        $store3->latitude = 9.079851;
        $store3->save();

        $store4 = new Warehouse();
        $store4->name = 'Kubwa ';
        $store4->slug = 'Kubwa';
        $store4->lga_id = 778;
        $store4->state_id = 37;
        $store4->longitude = 7.338608;
        $store4->latitude = 9.159634;
        $store4->save();
    }
}
