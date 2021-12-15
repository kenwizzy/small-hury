<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = new Role();
        $superAdmin->name = 'Super Admin';
        $superAdmin->slug = 'super-admin';
        $superAdmin->save();

        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->save();

        $warehouse = new Role();
        $warehouse->name = 'Warehouse Manager';
        $warehouse->slug = 'warehouse-manager';
        $warehouse->save();

        $biker = new Role();
        $biker->name = 'Bikers';
        $biker->slug = 'biker';
        $biker->save();

        $end_user = new Role();
        $end_user->name = 'Customers';
        $end_user->slug = 'customer';
        $end_user->save();


    }
}
