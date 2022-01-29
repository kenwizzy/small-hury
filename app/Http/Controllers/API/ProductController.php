<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wishlist;

class ProductController extends BaseController
{
    // public function getProducts()
    // {
    //     $products = Product::all();
    //     $res = [];
    //     foreach ($products as $product) {
    //         $res['product_name'] = $product->name;
    //         $res['product_id'] = $product->id;
    //         $res['product_slug'] = $product->slug;
    //         $res['description'] = $product->description;
    //         $res['real_price'] = $product->real_price;
    //         $res['original_price'] = $product->original_price;
    //         $res['category'] = $product->category->name;
    //         $res['sub_category'] = $product->subCat->name;
    //         $res['default_image'] = $product->defaultImage->image_url;
    //         $res['attributes'] = $product->apiAttribute();
    //     }
    //     return $this->sendResponse($res, 'Products fetched successfully.');
    // }

    public function show($id)
    {
        $item = Product::findOrFail($id);
       $wishlist = $item->wishlists()->where('user_id',auth()->user()->id)->first();
        // if ($item == null) {
        //     return $this->sendError('Record not found', $item);
        // } else {
        $product = [];
        $product['product_name'] = $item->name;
        $product['product_slug'] = $item->slug;
        $product['description'] = $item->description;
        $product['real_price'] = $item->real_price;
        $product['original_price'] = $item->original_price;
        $product['category'] = $item->category->name;
        $product['sub_category'] = $item->subCat == '' ? 'Unavailable' : $item->subCat->name;
        $product['default_image'] = $item->defaultImage->image_url;
        $product['attributes'] = $item->apiAttribute();
       $product['wishlist'] = $wishlist?true: false;
            // get the number of items in cart
            $user = User::find(auth()->user()->id);

            if($user->cart){
                $quantity = $user->cart->product_quantity($item);
                $product['incart'] = $quantity;
            }
            $product['incart'] = 0;
        return $this->sendResponse($product, 'Product fetched successfully.');
        // }
    }
    public function wishProduct($id){
        $item = Product::findOrFail($id);
        //check whetther already wishlist this product
       $wishlist= $item->wishlists()->where('user_id',auth()->user()->id)->first();
       if($wishlist){
        return $this->sendError('Product Already wishlisted', $item);
       }
        $wished =   Wishlist::create([
            'user_id' => auth()->user()->id,
            'product_id' => $item->id,
        ]);
        return $this->sendResponse($wished, 'Product successfully wished.');
    }

    public function removeWished($id){
        $item = Product::findOrFail($id);
       $deleted = Wishlist::where([
            'user_id' => auth()->user()->id,
            'product_id' => $item->id
        ])->delete();
        if(!$deleted){
            return $this->sendError('Item not wishlisted', $deleted);
        }
        return $this->sendResponse($deleted, 'Product successfully removed from Wished');
    }
}
