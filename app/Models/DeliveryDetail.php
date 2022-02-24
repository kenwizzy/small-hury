<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
