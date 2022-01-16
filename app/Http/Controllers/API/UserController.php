<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function getUser(Request $request){
        return $this->sendResponse(Auth::user(), 'User fetched successfully.');
    }
}
