<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['name','slug','cat_img_url','parent_id'];

    public function products(){
        return  $this->hasMany(Product::class);
    }

    public function subCats(){
        return $this->hasMany(Category::class,'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id');
    }
}
