<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
    use HasFactory;
    protected $tableName = 'product_warehouses';

    protected $fillable = ['product_id','warehouse_id','total_quantity'];
}
