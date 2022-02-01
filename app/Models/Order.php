<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];

    // status block
    public const AWAITING_FULFILLMENT = 1;
    public const AWAITING_SHIPMENT = 2;
    public const AWAITING_PICKUP = 3;
    public const PARTIALLY_SHIPPED = 4;
    public const COMPLETELY_SHIPPED = 5;
    public const COMPLETED = 6;
    public const CANCELLED = 7;
    public const DECLINED = 8;
    public const REFUNDED = 9;
    public const PARTIALLY_REFUNDED = 10;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
