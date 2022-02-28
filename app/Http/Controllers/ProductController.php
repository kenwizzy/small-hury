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
            'sub_category' => 'numeric|nullable',
            'attribute_image.*' => 'mimes:jpeg,jpg,png',
            'attribute_value.*' => 'string|required',
            'attribute.*' => 'required|numeric',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if ($request->hasFile('default_image')) {
            $filen = $request->default_image->getClientOriginalName();
            $filename = time() . '.' . $filen;
            $request->default_image->move('assets/images/products/', $filename);
        }

        $stores = Warehouse::all();
        $defaultImageUrl = asset('assets/images/products/' . $filename);

        // //INSERT PRODUCT
        $product = new Product();
        $product->name = $request->product_name;
        $product->internal_ref = $request->int_ref;
        $product->description = $request->description;
        $product->category_id = $request->product_category;
        $product->sub_category_id = $request->sub_category;
        $product->added_by = Auth::id();
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

            // ######## PRODUCT ATTRIBUTES HERE (not sure if needed) #########

        }

        if ($request->store == 'all') {
            foreach ($stores as $shop) {
                ProductWarehouse::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $shop->id,
                    'total_quantity' => $request->quantity
                ]);
            }
        } else {
            ProductWarehouse::create([
                'product_id' => $product->id,
                'warehouse_id' => $request->store,
                'total_quantity' => $request->quantity
            ]);
        }

        return redirect('dashboard/products')->withSuccess('Product ' . $request->product_name . ' added successfully');
    }

    public function create()
    {
        return view('dashboard.create', [
            'categories' => Category::where('parent_id', 0)->get(),
            'discounts' => Discount::all(),
            'warehouse' => Warehouse::where('user_id', Auth::id())->first(),
            'warehouses' => Warehouse::all(),
            'attributes' => Attribute::where('id', '<>', 1)->get()
        ]);
    }

    public function allProducts()
    {
        Auth::user()->role->name == 'Warehouse Manager' ?
            $products = $this->productData()->where('warehouses.user_id', Auth::id())->get()
            : $products = $this->productData()->groupby('products.id', 'products.name', 'categories.name', 'product_images.product_id', 'categories.name', 'product_images.image_url', 'products.real_price', 'products.added_by', 'products.created_at', 'products.deleted_at', 'attributes.name', 'attribute_values.attribute_val_name')->get();
        return view('dashboard/products', compact('products'));
    }


    public function show(Product $product)
    {
        return view('dashboard.product_details', [
            'product' => $product,
            'qty' =>  DB::table('product_warehouses')
                ->join('warehouses', 'product_warehouses.warehouse_id', 'warehouses.id')
                ->where('product_warehouses.product_id', $product->id)
                ->where('warehouses.user_id', Auth::id())->get()
        ]);
    }

    public function edit(Product $product)
    {
        $warehouse = Warehouse::where('user_id', Auth::id())->first();
        $warehouses = Warehouse::all();
        $categories = Category::where('parent_id', 0)->get();
        $discounts = Discount::all();
        $attributes = Attribute::where('id', '<>', 1)->get();
        // $price = DB::table('product_warehouses')
        //     ->join('warehouses', 'product_warehouses.warehouse_id', 'warehouses.id')
        //     ->where('product_warehouses.product_id', $product->id)
        //     ->where('warehouses.user_id', Auth::id())->first();

        return view('dashboard/edit_product', compact('categories', 'discounts', 'attributes', 'warehouse', 'warehouses', 'product'));
    }

    private function productData()
    {
        return DB::table('products')->select('products.id', 'products.name', 'categories.name AS cat_name', 'product_images.product_id', 'categories.name AS sub_cat', 'product_images.image_url', 'products.real_price', 'products.added_by', 'products.created_at','products.deleted_at', 'attributes.name AS attr_name', 'attribute_values.attribute_val_name')
            ->join('product_warehouses', 'product_warehouses.product_id', 'products.id')
            ->join('product_images', 'product_images.product_id', 'products.id')
            ->join('warehouses', 'product_warehouses.warehouse_id', 'warehouses.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('attribute_values', 'attribute_values.id', 'product_images.attribute_value_id')
            ->join('attributes', 'attribute_values.attribute_id', 'attributes.id')
            //->where('product_images.attribute_value_id', '<>', '1')
            ->where('product_images.default', 1)
            ->where('categories.parent_id', 0)
            ->where('products.deleted_at',null);
        //->where('categories.id', 'categories_parent_id')
    }

    public function destroy(Product $product){
        if($product->id == null){
            return redirect()->back()->withError('Product not found');
        }
        $product->productImages()->forceDelete();
        ProductWarehouse::where('product_id',$product->id)->forceDelete();
        //$product->warehouses()->delete();
        $product->forceDelete();
        

        return redirect()->back()->withSuccess('Product Deleted Successfully');
    }

    public function update(Request $request, Product $product){
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'int_ref' => 'nullable|string',
            'original_price' => 'required|numeric',
            'real_price' => 'required|numeric',
            'store' => 'required',
            'quantity' => 'required|numeric',
            //'default_image' => 'mimes:jpeg,jpg,png',
            'product_category' => 'required|numeric',
            'sub_category' => 'numeric|nullable',
            //'attribute_image.*' => 'mimes:jpeg,jpg,png',
            'attribute_value.*' => 'string|required',
            'attribute.*' => 'required|numeric',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // if ($request->hasFile('default_image')) {
        //     $filen = $request->default_image->getClientOriginalName();
        //     $filename = time() . '.' . $filen;
        //     $request->default_image->move('assets/images/products/', $filename);
        // }


        $stores = Warehouse::all();
        //$defaultImageUrl = asset('assets/images/products/' . $filename);

        // //UPDATE PRODUCT
        $product = Product::find($product->id);
        $product->name = $request->product_name;
        $product->internal_ref = $request->int_ref;
        $product->description = $request->description;
        $product->category_id = $request->product_category;
        $product->sub_category_id = $request->sub_category;
        //$product->added_by = Auth::id();
        $product->slug = Str::slug($request->product_name);
        $product->real_price = $request->real_price;
        $product->original_price = $request->original_price;
        $product->save();

        // //INSERT PRODUCT DEFAULT IMAGE
        // ProductImage::create([
        //     'product_id' => $product->id,
        //     'image_url' =>$defaultImageUrl,
        //     'default' => 1
        // ]);

        // //INSERT PRODUCT OTHER IMAGES
        // for ($i = 0; $i < sizeof($request->attribute); $i++) {

        //     $fileImages = $request->attribute_image[$i]->getClientOriginalName();
        //     $filenam = time() . '.' . $fileImages;
        //     $request->attribute_image[$i]->move('assets/images/products/', $filenam);
        //     $fileImagesUrl = asset('assets/images/products/' . $filenam);

        //     ProductImage::create([
        //         'product_id' => $product->id,
        //         'image_url' => $fileImagesUrl,
        //         'default' => 0,
        //         'attribute_value_id' => $request->attribute_value[$i]
        //     ]);

        //     // ######## PRODUCT ATTRIBUTES HERE (not sure if needed) #########

        // }

        if ($request->store == 'all') {
            $prod_stores = ProductWarehouse::where('product_id',$product->id)->get();
            foreach ($prod_stores as $shop) {
            
            // $shop->update([
            //     'product_id' => $product->id,
            //     'warehouse_id' => $shop->id,
            //     'total_quantity' => $request->quantity,
            // //$prod_store->save();
            // ]);
  
            $prod_store = ProductWarehouse::find($shop->id);
            //$prod_store->product_id= $product->id;
            //$prod_store->warehouse_id = $shop->id;
            $prod_store->total_quantity = $request->quantity/$prod_stores->count();
            $prod_store->save();


            }
        } else {
            $prod_store = ProductWarehouse::find($product->id);
            $prod_store->product_id= $product->id;
            $prod_store->warehouse_id = $request->store;
            $prod_store->total_quantity = $request->quantity;
            $prod_store->save();
        }

        return redirect('dashboard/products')->withSuccess('Product ' . $request->product_name . ' updated successfully');
    }
}
