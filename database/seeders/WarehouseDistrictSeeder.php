<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warehouse_districts')
            ->insert([
                ['name' => 'Central Business Area', 'warehouse_id' => 1],
                ['name' => 'Garki', 'warehouse_id' => 1],
                ['name' => 'Maitama', 'warehouse_id' => 1],
                ['name' => 'Asokoro', 'warehouse_id' => 1],
                ['name' => 'Guazepe', 'warehouse_id' => 1],
                ['name' => 'Durumi ', 'warehouse_id' => 1],
                ['name' => 'Gudu', 'warehouse_id' => 1],
                ['name' => 'Jahi', 'warehouse_id' => 1],
                ['name' => 'Wuse', 'warehouse_id' => 2],
                ['name' => 'Kado', 'warehouse_id' => 2],
                ['name' => 'Life Camp', 'warehouse_id' => 2],
                ['name' => 'Utako', 'warehouse_id' => 2],
                ['name' => 'Jabi', 'warehouse_id' => 2],
                ['name' => 'Mabuchi', 'warehouse_id' => 2],
                ['name' => 'Katampe', 'warehouse_id' => 2],
                ['name' => 'wuye', 'warehouse_id' => 2],

                ['name' => 'Gwarinpa', 'warehouse_id' => 3],
                ['name' => 'Dawaki', 'warehouse_id' => 3],
            ]);
    }
}
