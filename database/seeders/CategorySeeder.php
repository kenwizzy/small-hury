<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new Category();
        $cat->name = 'Electronics';
        $cat->slug = 'electronics';
        $cat->save();

        $cat1 = new Category();
        $cat1->name = 'Clothings';
        $cat1->slug = 'cloths';
        $cat1->save();

        $cat2 = new Category();
        $cat2->name = 'Skin Care';
        $cat2->slug = 'skin-care';
        $cat2->save();

        $cat3 = new Category();
        $cat3->name = 'Pasteries';
        $cat3->slug = 'pasteries';
        $cat3->save();
    }
}
