<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $results = Cart::with('user','products')->get();
        return view('dashboard/abandoned-cart',compact('results'));
    }
}
