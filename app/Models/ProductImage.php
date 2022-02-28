<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['created_at', 'updated_at'];

    //public function attribute(){
        //return $this->hasOne(AttributeValue::class, 'attribute_value_id');

    //     return DB::table('product_images')
    //    ->join('attribute_values', 'product_images.attribute_value_id', '=', 'attribute_values.id')
    //     ->where('default', 0)->get();

    // return DB::table('product_images')->select('product_id')
    //     ->where('product_id', $this->id)
    //     ->get();

    //}
}
