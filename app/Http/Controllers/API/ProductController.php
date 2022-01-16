<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends BaseController
{
    public function getProducts(){
        $products = Product::all();
        //$res = [];
        foreach($products as $product){
         $res['product_name'] = $product->name;
         $res['product_id'] = $product->id;
         $res['product_slug'] = $product->slug;
         $res['description'] = $product->description;
         $res['real_price'] = $product->real_price;
         $res['original_price'] = $product->original_price;
         $res['category'] = $product->category->name;
         $res['sub_category'] = $product->subCat->name;
         $res['default_image'] = $product->defaultImage->image_url;
         $res['attributes'] = $product->apiAttribute();
        }
        return $this->sendResponse($res, 'Products fetched successfully.');
    }

    public function show($id){
        $item = Product::findOrFail($id);
        if ($item == null) {
            return $this->sendError('Record not found', $item);
        } else {
        $product = [];
        $product['product_name'] = $item->name;
        $product['product_slug'] = $item->slug;
        $product['description'] = $item->description;
        $product['real_price'] = $item->real_price;
        $product['original_price'] = $item->original_price;
        $product['category'] = $item->category->name;
        $product['sub_category'] = $item->subCat->name;
        $product['default_image'] = $item->defaultImage->image_url;
        $product['attributes'] = $item->apiAttribute();

            return $this->sendResponse($product, 'Product fetched successfully.');
        }
    }
}
