<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function store(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_name'     => 'required|string',
            'original_price' => 'required|numeric',
            'real_price' => 'required|numeric',
            'default_image' => 'required|file',
            'secondary_image' => 'nullable',
            'product_category' => 'required|numeric',
            'on_sales' => 'required|numeric',
            'expiry' => 'required',
            'desc'=> 'required|string'
          ]);

    if($validator->fails()){
        return redirect()->back()->with('errors', $validator->errors());
    }

    if($request->hasFile('default_image')){
        $filename = $request->default_image->getClientOriginalName();
        //$filename1 = $request->secondary_image->getClientOriginalName();
        $request->default_image->move('assets/img', $filename);
        //$filename1->secondary_image->move('assets/img',$filename1);
    }

        Product::create([
            'name' => $request->product_name,
            'description' => $request->desc,
            'category_id' =>$request->product_category,
            'slug' => Str::slug($request->product_name),
            'real_price' => $request->real_price,
            'original_price' => $request->original_price,
            'sales_expiry' => $request->expiry,
            'on_sales' => $request->on_sales
        ]);

        return redirect('dashboard/products')->withSuccess('Product added successfully');

    }

    public function create(){

        return view('dashboard.create', [
            'categories' => Category::all()
        ]);
    }
}
