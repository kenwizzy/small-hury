<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = DB::table('delivery_costs')
        ->insert([
            ['price_range' => '0 to 999','cost' => '200'],
            ['price_range' => '1000 to 4999','cost' => '500'],
            ['price_range' => '5000 to 9999','cost' => '800'],
            ['price_range' => '10000 to 19999','cost' => '1200'],
            ['price_range' => '20000 to 49999','cost' => '1800'],
            ['price_range' => '50000 to 99999','cost' => '2500'],
        ]);
    }
}
