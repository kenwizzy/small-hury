<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouses';
    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        // $user = DB::table('users')
        //     ->join('warehouses', 'users.id', 'warehouses.user_id')
        //     //->join('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
        //     ->where('warehouses.id', $this->id)
        //     //->where('users.id', '<>', 'manager')
        //     ->get();

        // foreach ($user as $res) {
        //     echo $res->first_name . ' ' . $res->last_name;
        // }
    }

    public function totalItems()
    {
        return ProductWarehouse::where([
            'warehouse_id' => $this->id,
            'deleted_at' => null
        ])->sum('total_quantity');
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
