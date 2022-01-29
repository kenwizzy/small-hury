<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductWarehouse;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            DB::beginTransaction();
           $newOrder = Order::create([
                'user_id' => 1,
                'total_products_price' => "9500",
                'total_shipping_price' => 1000,
                'total_paid' => '10500',
                'status' => Order::AWAITING_FULFILLMENT,
                'warehouse_id' => 2,
            ]);
            $date = explode('/','29/02/2022');
            $day = $date[0];
            $month = $date[1];
            $year = $date[2];


            //For constraint sake, we need a valid Address
            $add = Address::create([
                "street"=> "No 66 old yaba road",
                "latitude"=> "3.7",
                "longitude" =>"7.6",
                "state" => "lagos",
                "city"=>"Yaba",
                "landmark" =>"Adekunle Bus stop",
                "name"=> "Office",
                "default"=>1
            ]);

            $delDetailId = DB::table('delivery_details')
                        ->insertGetId([
                            'order_id' => $newOrder->id,
                            'delivery_contact' => '08076884964',
                            'address_id' => $add->id,
                            'payment_method' => "CARD",
                            'delivery_date' => Carbon::create($year,$month,$day,0)->toDateTimeString(),
                            'time_interval' => "8AM - 12AM",
                            'delivery_phone' => '08076884964',
                            'delivery_note' => "Please Call me when coming",


                        ]);

            //We all need to create product for it to work
            $stores = Warehouse::all();
            $defaultImageUrl = asset('assets/images/products/' . "meat20.png");

            // //INSERT PRODUCT
            $product = new Product();
            $product->name = "Ofada Rice";
            $product->internal_ref = "123-567-9";
            $product->description ="Ofada Rice is good for your health";
            $product->category_id = "4";
            $product->sub_category_id = 5;
            $product->added_by = 1;
            $product->slug = Str::slug("Ofada Rice");
            $product->real_price = "20000";
            $product->original_price = "25000";
            $product->save();

            // //INSERT PRODUCT DEFAULT IMAGE
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $defaultImageUrl,
                'default' => 1
            ]);

            // //INSERT PRODUCT OTHER IMAGES
            for ($i = 0; $i < sizeof([]); $i++) {

                // $fileImages = $request->attribute_image[$i]->getClientOriginalName();
                // $filenam = time() . '.' . $fileImages;
                // $request->attribute_image[$i]->move('assets/images/products/', $filenam);
                $fileImagesUrl = asset('assets/images/products/' . 'meat20.png');

                    ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $fileImagesUrl,
                    'default' => 0,
                    'attribute_value_id' => 1
                ]);

                // ######## PRODUCT ATTRIBUTES HERE (not sure if needed) #########

                }


                ProductWarehouse::create([
                    'product_id' => $product->id,
                    'warehouse_id' => 2,
                    'total_quantity' => 20
                ]);


            $cartItems =[
                ['name' => $product->name,'quantity' => 2,'id' => $product->id]
            ];
            foreach( $cartItems as $cartItem){
                OrderDetail::create([
                    'order_id' => $newOrder->id,
                    'product_id' => $cartItem['id'],
                    'product_name' => $cartItem['name'],
                    'quantity' => $cartItem['quantity'],
                    'delivery_detail_id' => $delDetailId
                ]);
            }
            DB::commit();
        }catch(\Exception $err){
            DB::rollBack();

        }
    }
}
