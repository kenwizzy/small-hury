<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Support\Str;
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
        $warehouse = new Warehouse();
        $warehouse->name = "Arouchuku store";
        $warehouse->slug = Str::slug("Arouchuku store");
        $warehouse->lga_id = 3;
        $warehouse->state_id = 1;
        $warehouse->zipcode ="442101";
        $warehouse->street = "Arouchukwu";
        $warehouse->longitude = "7.916663";
        $warehouse->latitude ="5.3833318";
        $warehouse->save();

        $warehouse = new Warehouse();
        $warehouse->name = "Ukwa East store";
        $warehouse->slug = Str::slug("Ukwa East store");
        $warehouse->lga_id = 14;
        $warehouse->state_id = 1;
        $warehouse->zipcode ="442101";
        $warehouse->street = "Arouchukwu";
        $warehouse->longitude = "7.916663";
        $warehouse->latitude ="5.3833318";
        $warehouse->save();
    }
}
