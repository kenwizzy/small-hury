<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

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
        return Cart::where([
            'product_id' => $this->id,
            'user_id' => Auth::user()->id,
            'warehouse_id' => $this->pivot->warehouse_id
        ])->get();
    }

    public function apiAttribute()
    {
        return $data = $this->output();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    private function output()
    {
        return DB::table('product_images')->select('name', 'attribute_val_name')
            ->join('attribute_values', 'attribute_values.id', 'product_images.attribute_value_id')
            ->join('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
            ->where('attributes.id', '!=', 1)
            ->where('product_id', $this->id)
            ->where('default', 0)->get();
    }
}
