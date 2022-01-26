<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Attribute;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductWarehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'int_ref' => 'nullable|string',
            'original_price' => 'required|numeric',
            'real_price' => 'required|numeric',
            'store' => 'required',
            'quantity' => 'required|numeric',
            'default_image' => 'required|mimes:jpeg,jpg,png',
            'product_category' => 'required|numeric',
            'sub_category' => 'required|numeric',
            'attribute_image.*' => 'mimes:jpeg,jpg,png',
            'attribute_value.*' => 'string|required',
            'attribute.*' => 'required|numeric',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        //dd($request->all());

        if ($request->hasFile('default_image')) {
            $filen = $request->default_image->getClientOriginalName();
            $filename = time() . '.' . $filen;
            $request->default_image->move('assets/images/products/', $filename);
        }

        $stores = Warehouse::all();
        $defaultImageUrl = asset('assets/images/products/' . $filename);
        DB::transaction(function () use ($request,$defaultImageUrl,$stores) {
            // //INSERT PRODUCT
            $product = new Product();
            $product->name = $request->product_name;
            $product->internal_ref = $request->int_ref;
            $product->description = $request->description;
            $product->category_id = $request->product_category;
            $product->added_by = Auth::id();
            $product->sub_category_id = $request->sub_category;
            $product->slug = Str::slug($request->product_name);
            $product->real_price = $request->real_price;
            $product->original_price = $request->original_price;
            $product->save();

            // //INSERT PRODUCT DEFAULT IMAGE
            ProductImage::create([
            'product_id' => $product->id,
            'image_url' => $defaultImageUrl,
            'default' => 1
        ]);

            // //INSERT PRODUCT OTHER IMAGES
            for ($i = 0; $i < sizeof($request->attribute); $i++) {
                $fileImages = $request->attribute_image[$i]->getClientOriginalName();
                $filenam = time() . '.' . $fileImages;
                $request->attribute_image[$i]->move('assets/images/products/', $filenam);
                $fileImagesUrl = asset('assets/images/products/' . $filenam);

                ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $fileImagesUrl,
                'default' => 0,
                'attribute_value_id' => $request->attribute_value[$i]
            ]);


            }

            if ($request->store == 'all') {
                foreach ($stores as $shop) {
                    ProductWarehouse::create([
                    'product_id' => $product->id,
                    'warehouse_id' =>$shop->id,
                    'total_quantity' => $request->quantity
                ]);
                }
            } else {
                ProductWarehouse::create([
            'product_id' => $product->id,
            'warehouse_id' =>$request->store,
            'total_quantity' => $request->quantity
        ]);
            }
        });

        return redirect('dashboard/products')->withSuccess('Product' . $request->product_name . ' added successfully');
    }

    public function create()
    {
        return view('dashboard.create', [
            'categories' => Category::where('parent_id',0)->get(),
            'discounts' => Discount::all(),
            'warehouses' => Warehouse::all(),
            'attributes' => Attribute::where('id','<>',1)->get()
        ]);
    }

    public function allProducts(){
        return view('dashboard/products',[
          'products' => Product::all()
        ]);
    }
}
