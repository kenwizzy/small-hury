<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            StateSeeder::class,
            LgaSeeder::class,

        ]);

        $user = new User();
        $user->first_name = 'Wizzy';
        $user->middle_name = 'smith';
        $user->last_name = 'Kenny';
        $user->phone = '09087645233';
        $user->email = 'wizzi@gmail.com';
        $user->password = Hash::make('password');
        $user->save();

    }

}
