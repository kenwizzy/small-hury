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

        $store1 = new Warehouse();
        $store1->name = 'Asokoro ';
        $store1->slug = 'Asokoro ';
        $store1->email = 'asokorostore@smallhurry.com';
        $store1->lga_id = 779;
        $store1->state_id = 37;
        $store1->longitude = 7.519309;
        $store1->latitude = 9.04084;
        $store1->save();

        $store2 = new Warehouse();
        $store2->name = 'Gwarimpa';
        $store2->slug = 'Gwarimpa';
        $store2->email = 'gwarinpastore@smallhurry.com';
        $store2->lga_id = 776;
        $store2->state_id = 37;
        $store2->longitude = 7.39826;
        $store2->latitude = 9.067318;
        $store2->save();

        $store3 = new Warehouse();
        $store3->name = 'Jabi ';
        $store3->slug = 'Jabi ';
        $store3->email = 'jabistore@smallhurry.com';
        $store3->lga_id = 780;
        $store3->state_id = 37;
        $store3->longitude = 7.42191;
        $store3->latitude = 9.06478;
        $store3->save();
    }
}
