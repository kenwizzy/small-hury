<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Discount;
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
        $user->role_id = 1;
        $user->password = Hash::make('password');
        $user->save();

        $attribute = new Attribute();
        $attribute->name = 'default';
        $attribute->save();

        $attribute1 = new Attribute();
        $attribute1->name = 'size';
        $attribute1->save();

        $attribuleValue = new AttributeValue();
        $attribuleValue->attribute_id = 1;
        $attribuleValue->attribute_val_name = 'default';
        $attribuleValue->save();

        $attribuleValue1 = new AttributeValue();
        $attribuleValue1->attribute_id = $attribute1->id;
        $attribuleValue1->attribute_val_name = 'small';
        $attribuleValue1->save();

        $attribuleValue2 = new AttributeValue();
        $attribuleValue2->attribute_id = $attribute1->id;
        $attribuleValue2->attribute_val_name = 'medium';
        $attribuleValue2->save();

        $attribuleValue3 = new AttributeValue();
        $attribuleValue3->attribute_id = $attribute1->id;
        $attribuleValue3->attribute_val_name = 'large';
        $attribuleValue3->save();

        $discount = new Discount();
        $discount->value = 5;
        $discount->user_id = 1;
        $discount->save();

        $discount1 = new Discount();
        $discount1->value = 10;
        $discount1->user_id = 1;
        $discount1->save();

        $discount2 = new Discount();
        $discount2->value = 15;
        $discount2->user_id = 1;
        $discount2->save();
    }
}
