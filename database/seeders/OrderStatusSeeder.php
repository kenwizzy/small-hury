<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')
            ->insert([
                ['name' => "Awaiting Fulfillment", 'slug' => Str::slug('Awaiting Fulfillment')],
                ['name' => "Awaiting Shipment", 'slug' => Str::slug('Awaiting Shipment')],
                ['name' => "Awaiting Pickup", 'slug' => Str::slug('Awaiting Pickup')],
                ['name' => "Partially Shipped", 'slug' => Str::slug('Partially Shipped')],
                ['name' => "Completely Shipped", 'slug' => Str::slug('Completely Shipped')],
                ['name' => "Completed", 'slug' => Str::slug('Completed')],
                ['name' => "Cancelled", 'slug' => Str::slug('Cancelled')],
                ['name' => "Declined", 'slug' => Str::slug('Declined')],
                ['name' => "Refunded", 'slug' => Str::slug('Refunded')],
                ['name' => "Partially Refunded", 'slug' => Str::slug('Partially Refunded')],
                ['name' => "Processing", 'slug' => Str::slug('Processing')],

            ]);
    }
}
