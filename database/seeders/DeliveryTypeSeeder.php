<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('delivery_type')
       ->insert([
           ['name' => 'Pickup','status'=> 1],
           ['name' => 'Delivery','status'=> 1]
       ]);
    }
}
