<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];
    public const USER_METHOD = [
      "FACEBOOK" => 1,
      "GOOGLE" => 2,
      "BASIC_AUTH" => 3
    ];
    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const WAREHOUSE_MANAGER = 3;
    public const CUSTOMER = 5;
    public const BIKER = 4;
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function add_to_cart(Product $product)
    {
        return Cart::create([
            'product_id' => $product->id,
            'user_id' => $this->id,
            'product_name' => $product->name,
            'warehouse_id' => $product->warehouse_id
        ]);
    }
    public function increase_product(Product $product, $quantity = 1)
    {
        return $this->cart()->where('product_id', $product->id)->update([
            'quantity' => $this->cart->quantity + $quantity
        ]);
    }
    public function decrease_product(Product $product, $quantity = 1)
    {
        return $this->cart()->where('product_id', $product->id)->update([
            'quantity' => $this->cart->quantity - $quantity
        ]);
    }
    public function clear_cart()
    {
        return $this->cart()->delete();
    }
}
