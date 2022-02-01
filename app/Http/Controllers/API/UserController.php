<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\UploadedFile;
// use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

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
           'image' => 'nullable',
        ]);
        //return  $this->sendResponse(["gender" => $request->input('gender')],"User successfully updated");


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


        // if ($request->hasFile('image')) {
        //     $filen = $request->image->getClientOriginalName();
        //     $filename = time() . '.' . $filen;
        //     $request->image->move('assets/images/users/', $filename);
        //     $defaultImageUrl = asset('assets/images/users/' . $filename);
        // }
        if($request->input('image') != null){
            $base64File = $request->input('image');
            // decode the base64 file
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
            // save it to temporary dir first.
            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);
            // this just to help us get file info.
            $tmpFile = new File($tmpFilePath);

            $file = new UploadedFile(
                $tmpFile->getPathname(),
                $tmpFile->getFilename(),
                $tmpFile->getMimeType(),
                0,
                false // Mark it as test, since the file isn't from real HTTP POST.
            );
            $filename = time() . '.' . $user->first_name.$user->last_name. $user->id .".jpg";
             $file->storePubliclyAs('public/assets/images/users/',$filename);

             $defaultImageUrl = asset('storage/assets/images/users/' .$filename);
        }
        $saved =$user->update([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'middle_name' => $middlename ? $middlename :$user->middle_name,
            'phone' => $fields['phone'],
            'email' => $newEmail,
            'gender' => $fields['gender'],
            'image_url' => $defaultImageUrl ? $defaultImageUrl :$user->image_url
        ]);
        if($saved){
         return  $this->sendResponse($user,"User successfully updated");

        }
        else
            return $this->sendError('Unable to save user');
    }
    public function changePassword(Request $request){
        $fields = $request->validate([
            'password' => 'confirmed|string|required'
        ]);
        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($fields['password']);
        $user->save();
        return $this->sendResponse($user,"Password changed");
    }


}
