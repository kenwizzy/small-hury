<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function getUser(Request $request){
        return $this->sendResponse(Auth::user(), 'User fetched successfully.');
    }

    public function getWishlists()
    {
        $user = User::find(Auth::id());
        $wishlists = $user->wishlists;
        $wished = [];
        foreach($wishlists as $wishlist){
            $product = Product::find($wishlist->product_id);
            $product->wishlist = true;


            if($user->cart){
                $quantity = $user->cart->product_quantity($product);
                $product->incart = $quantity;
            }else
                $product->incart = 0;
            $product->default_image = $product->DefaultImage()->first()->image_url;
            $wished[] = $product;
        }
        return $this->sendResponse($wished, "Wished products fetched");

    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'name' => 'string|required',
             'email' => 'email|required',
             'phone' => 'string|required',
             'gender'=> 'string|required',
             'image' => 'nullable|mimes:jpeg,jpg,png',
        ]);
        // $validator = Validator::make($request->all(), [
        //      'name' => 'string|required',
        //      'email' => 'email|required',
        //      'phone' => 'string|required',
        //      'gender'=> 'string|required',
        //      'image' => 'nullable|mimes:jpeg,jpg,png',
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError($validator->errors());
        // }
        $user =[];
         $names = explode(' ', $fields['name']);
         $firstname="";
         $lastname="";
         $middlename="";
        if(count($names) > 2){
            $firstname = $names[0];
            $middlename = $names[1];
            $lastname= $names[2];
        }
        else if( count($names) > 1){
            $firstname = $names[0];
            $lastname= $names[1];
        }
        else if (count($names) > 0){
            return response(
                ['message' =>
                "Enter your full name ( at least first name and last name)"],401);
        }
        $user = User::find(Auth::id());
        $newEmail = $fields['email'];
        if($user->email != $fields['email']){
            $newUser = User::where('email',$fields['email'])->first();
            if($newUser){
                return response(
                    ['message' =>
                    "Authentication Error"],401);
            }

        }
        $defaultImageUrl = null;
        if ($request->hasFile('image')) {
            $filen = $request->image->getClientOriginalName();
            $filename = time() . '.' . $filen;
            $request->image->move('assets/images/products/', $filename);
            $defaultImageUrl = asset('assets/images/products/' . $filename);
        }
        $saved =$user->update([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'middle_name' => $middlename || $user->middle_name,
            'phone' => $fields['phone'],
            'email' => $newEmail,
            'gender' => $fields['gender'],
            'image_url' => $defaultImageUrl || $user->image_url
        ]);
        if($saved){
         return  $this->sendResponse($user,"User successfully updated");

        }
        else
            return $this->sendError('Unable to save user');
    }
}
