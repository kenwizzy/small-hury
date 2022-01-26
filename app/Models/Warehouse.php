<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['created_at','updated_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, ProductWarehouse::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
