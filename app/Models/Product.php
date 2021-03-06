<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function subCat()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    // public function defaultImages()
    // {
    //     return $this->hasMany(ProductImage::class)->where('product_id', $this->id)
    //         ->where('default', 1);
    // }

    public function DefaultImage()
    {
        return $this->hasOne(ProductImage::class)->where('product_id', $this->id)
            ->where('default', 1);
    }

    // public function attributes(){
    //     return $this->hasMany(ProductImage::class)->where('product_id',$this->id)
    //            ->where('default', 0);
    // }

    public function attribute()
    {
        $data = $this->output();
        foreach ($data as $result) {
            echo '<strong>' . $result->name . '</strong>:' . $result->attribute_val_name . '<br>';
        }
    }

    public function attrs()
    {
        return $this->output();
    }

    public function totalItems()
    {
        return ProductWarehouse::where([
            'product_id' => $this->id,
        ])->sum('total_quantity');
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, ProductWarehouse::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products', 'product_id', 'cart_id');
    }

    public function apiAttribute()
    {
        return $data = $this->output();
    }

    public function warehouse()
    {
        return ProductWarehouse::where([
            'product_id' => $this->id,
        ])->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function productStoreQty()
    {
        return DB::table('product_warehouses')
            ->join('warehouses', 'product_warehouses.warehouse_id', 'warehouses.id')
            ->where('product_warehouses.product_id', $this->id)
            ->where('warehouses.user_id', Auth::id())->first();
    }

    private function output()
    {
        return DB::table('product_images')->select('attributes.id','attribute_values.id AS value_id','name', 'attribute_val_name', 'image_url')
            ->join('attribute_values', 'attribute_values.id', 'product_images.attribute_value_id')
            ->join('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
            ->where('attributes.id', '!=', 1)
            ->where('product_id', $this->id)
            ->where('default', 0)->get();
    }
}
