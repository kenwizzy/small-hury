<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;

class CartController extends BaseController
{
    // This is responsible for adding and incrementing item in a cart
    public function addProduct(Request $request,$id)
    {
        $fields = $request->validate([
            'warehouse_id' => 'required|integer'
        ]);
        $product = Product::findOrFail($id);

        $user = User::find(Auth::user()->id);

        $cart = $user->cart;

        if ($cart) {
            $products = $cart->products;

            if($products->contains($product)){

                $cart = $cart->increase_product($product,$fields['warehouse_id']);
                return $this->sendResponse($cart, "Product successfully incremented");
            }
            else{
                $cart = $cart->add_product($product,$fields['warehouse_id']);
                if($cart)
                    return $this->sendResponse($cart, "Product successfully added");
                else
                    return $this->sendError("No product in warehouse");
            }

        }

        $cart = $user->add_new_product_to_cart($product,$fields['warehouse_id']);
        return $this->sendResponse($cart, "Product successfully added");
    }

    public function removeProduct(Request $request,$id)
    {
        $fields = $request->validate([
            'warehouse_id' => 'required|integer'
        ]);
        $product = Product::findOrFail($id);

        $user = User::find(Auth::user()->id);

        $cart = $user->cart;
        if ($cart) {
            $products = $cart->products;
            if($products->contains($product)){
                $cart = $cart->decrease_product($product,$fields['warehouse_id']);
                return $this->sendResponse($cart, "Product successfully decremented");
            }
            else{

                return $this->sendError("Product does not exists");
            }

        }
        return $this->sendError('No cart available',[],401);
    }

    public function index(){
        $user = User::find(Auth::user()->id);
        $cart = $user->cart;
        if($cart){

            $products = $cart->products;
            $prod = (object)[];

            foreach($products as $product){
                $quantity = $user->cart->product_quantity($product);
                $prod->default_image = $product->DefaultImage()->first()->image_url;
               $product->incart = $quantity;
               $product->default_image = $prod->default_image;
            }
            return $this->sendResponse($products,"Product Fetched Successfully");

        }
        else{
            return $this->sendResponse($cart,"No cart, add item to get cart");
        }
    }


}
