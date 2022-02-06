<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{


    public function register(Request $request): Response {
        $fields = $request->validate([
             'name' => 'required|string',
             'email' => 'required|string|unique:users,email',
             'password' => 'nullable|string',
             'userMethod' => 'required',
             'socialId' => 'nullable|string',

         ]);

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
         if($fields['userMethod'] == User::USER_METHOD["BASIC_AUTH"]){
            // return response(['message' => "trying to create data"]);
            $user = User::create([
                'first_name'=> $firstname,
                'last_name'=> $lastname,
                'middle_name'=> $middlename,
                'email' => $fields['email'],
                'password' => bcrypt($fields['password']),
                'role_id' => User::CUSTOMER
            ]);

         }
         else if($fields['userMethod'] == User::USER_METHOD["FACEBOOK"] ||
         $fields['userMethod'] == User::USER_METHOD["GOOGLE"]){
             if(empty($fields['socialId'])){
                 return response(["message" => "Social Id required."],401);
             }
            $user = User::create([
                'first_name'=> $firstname,
                'last_name' => $lastname,
                'middle_name'=> $middlename,
                'social_id' => $fields['socialId'],
                'email' => $fields['email'],
                'role_id' => User::CUSTOMER
            ]);
         }


         $response = [
             'user' => $user
         ];
         return response($response, 201);
     }
    public function login(Request $request){
        Log::info($request->all());
         $fields = $request->validate([
             'email'=>'string|required',
             'password'=>'nullable|string',
             'userMethod' => 'required',
             'rememberMe' => 'nullable|boolean',
             'appToken' => 'nullable|string'
         ]);

         $user = User::where('email',$fields['email'])->first();
         $token = "";
         $response =[];
         if(!$user){

             return response([
                 'message' => 'Not valid credentials'
             ],401);
         }
         if(User::USER_METHOD["BASIC_AUTH"] == $fields['userMethod']){
            $remember = $fields['rememberMe'];
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember)){
                $token = $user->createToken('myapptoken')->plainTextToken;
                $user->app_token = $fields['appToken'];
                $user->save();
                $response = [
                    'user' => $user,
                    'token' => $token
                ];
            }
            else{
                return response([
                    'message' => 'Not valid credentials'
                ],401);
            }
         }
         else if(User::USER_METHOD["FACEBOOK"] == $fields['userMethod'] ||
         User::USER_METHOD["GOOGLE"] == $fields['userMethod']){
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
         }

         return response($response, 200);

     }
    public function logout(Request $request){
        $user = User::find(auth()->user()->id);
         auth()->user()->tokens()->delete();
         return $this->sendResponse($user,"User logout");
     }
}
