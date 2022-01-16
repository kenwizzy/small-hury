<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function index()
    {
        return view('dashboard.discounts', [
            'discounts' => Discount::all()
        ]);
    }

    public function addDiscount(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'value'     => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        Discount::create([
            'value' => $request->value,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->withSuccess('Discount created successfully');
    }
}
