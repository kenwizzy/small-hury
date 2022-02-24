<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    // status block
    public const AWAITING_FULFILLMENT = 1;
    public const AWAITING_SHIPMENT = 2;
    public const AWAITING_PICKUP = 3;
    //public const PARTIALLY_SHIPPED = 4;
    public const SHIPPED = 5;
    public const COMPLETED = 6;
    public const CANCELLED = 7;
    public const DECLINED = 8;
    public const REFUNDED = 9;
    public const PARTIALLY_REFUNDED = 10;
    public const PROCESSING = 11;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    public function delivery()
    {
        return $this->hasOne(DeliveryDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'update_by');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function starus()
    {
        return $this->belongsTo(OrderStatus::class, 'status');
    }
    public function delivery_detail()
    {
        return $this->hasOne(DeliveryDetail::class);
    }
}
