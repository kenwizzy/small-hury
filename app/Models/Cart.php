<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details(){
        return CartProduct::where([
            'cart_id' => $this->id,
        ])->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'cart_products','cart_id','product_id');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function add_product(Product $product,$quantity=1)
    {

      return  DB::table('cart_products')->insert([
            'product_id' => $product->id,
            'cart_id' => $this->id,
            'product_name' => $product->name,
            'quantity' => $quantity,
        ]);
    }
    public function increase_product(Product $product,$quantity=1)
    {
       return DB::table('cart_products')
            ->where([
                'product_id' => $product->id,
                'cart_id' => $this->id

            ])
            ->increment('quantity', $quantity);
    }

    public function decrease_product(Product $product,$quantity = 1)
    {
        $row = DB::table('cart_products')
            ->where([
                'product_id' => $product->id,
                'cart_id' => $this->id,

            ]);
        if($row && $row->first() && $row->first()->quantity > 1){
            $row->update([
                'quantity' => $row->first()->quantity - $quantity
            ]);
            // $row->save();
        }
        else {
            $row->delete();
        }
        return $row->first();

    }

    public function product_exists(Product $product)
    {
      return  $this->products->contains($product);
    }
    public function product_quantity(Product $product)
    {
        if($this->product_exists($product)){
            $prod = DB::table('cart_products')
            ->where([
                'product_id' =>  $product->id,
                'cart_id' => $this->id
            ])->first();
            return $prod->quantity;
        }
        else return 0;
    }
}
