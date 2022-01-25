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

        $store = new Warehouse();
        $store->name = 'Maitama';
        $store->slug = 'Maitama';
        $store->lga_id = 775;
        $store->state_id = 37;
        $store->longitude = 7.497654;
        $store->latitude = 9.085198;
        $store->save();

        $store = new Warehouse();
        $store->name = 'Gwarimpa';
        $store->slug = 'Gwarimpa';
        $store->lga_id = 776;
        $store->state_id = 37;
        $store->longitude = 7.39826;
        $store->latitude = 9.067318;
        $store->save();

        $store = new Warehouse();
        $store->name = 'Wuse';
        $store->slug = 'Wuse';
        $store->lga_id = 777;
        $store->state_id = 37;
        $store->longitude = 7.47087;
        $store->latitude = 9.079851;
        $store->save();

        $store = new Warehouse();
        $store->name = 'Kubwa ';
        $store->slug = 'Kubwa';
        $store->lga_id = 778;
        $store->state_id = 37;
        $store->longitude = 7.338608;
        $store->latitude = 9.159634;
        $store->save();
    }
}
