<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

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
}
