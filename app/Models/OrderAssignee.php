<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssignee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'status',
        'order_accepted',
        'order_acceptance_time',
        'order_rejected_time',
        'processed'
    ];

    public function order_details()
    {
        return $this->hasOne(OrderDetail::class,'order_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
