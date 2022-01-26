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
        $cat->parent_id = 0;
        $cat->save();

        $cat1 = new Category();
        $cat1->name = 'Clothings';
        $cat1->slug = 'cloths';
        $cat1->parent_id = 0;
        $cat1->save();

        $cat2 = new Category();
        $cat2->name = 'Skin Care';
        $cat2->slug = 'skin-care';
        $cat2->parent_id = 0;
        $cat2->save();

        $cat3 = new Category();
        $cat3->name = 'Pasteries';
        $cat3->slug = 'pasteries';
        $cat3->parent_id = 0;
        $cat3->save();

        $cat4 = new Category();
        $cat4->name = 'Rice';
        $cat4->slug = 'rice';
        $cat4->parent_id = 0;
        $cat4->save();

        $cat5 = new Category();
        $cat5->name = 'Ofada Rice';
        $cat5->slug = 'ofade-rice';
        $cat5->parent_id = $cat4->id;
        $cat5->save();

        $cat6 = new Category();
        $cat6->name = 'Chinese Rice';
        $cat6->slug = 'chinese-rice';
        $cat6->parent_id = $cat4->id;
        $cat6->save();

        $cat7 = new Category();
        $cat7->name = 'Abakaliki Rice';
        $cat7->slug = 'abakaloki-rice';
        $cat7->parent_id = $cat4->id;
        $cat7->save();

        $cat8 = new Category();
        $cat8->name = 'Laptops';
        $cat8->slug = 'laptops';
        $cat8->parent_id = $cat->id;
        $cat8->save();

        $cat9 = new Category();
        $cat9->name = 'Smart Tvs';
        $cat9->slug = 'Smart-tvs';
        $cat9->parent_id = $cat->id;
        $cat9->save();

        $cat10 = new Category();
        $cat10->name = 'Sound Systems';
        $cat10->slug = 'sound-systems';
        $cat10->parent_id = $cat->id;
        $cat10->save();
    }
}
