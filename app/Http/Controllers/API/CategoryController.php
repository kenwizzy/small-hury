<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class CategoryController extends BaseController
{
    public function getCategories()
    {
        $categories = Category::all();
        return $this->sendResponse($categories, 'Categories fetched successfully.');
    }

    public function getParent()
    {
        $cats = Category::where('parent_id',0)->get();
        $result = [];
        foreach($cats as $key => $cat){
            $subCats = Category::where('parent_id', $cat->id)->get();
            $res['category'] = $cat;
            $res['sub_categories'] = $subCats;
            $result[] = $res;
        }



        return $this->sendResponse($result,"Main Categories fetched successfully");
    }
    public function show($id,$warehouse_id)
    {
        $cat = Category::findOrFail($id);
        // if ($cat == null) {
        //     return $this->sendError('Record not found', $cat);
        // } else {
        $subCats = Category::where('parent_id', $cat->id)->get();
        $products = Product::where('sub_category_id',$cat->id)->paginate(15);
            $newProducts = [];
        foreach($products as $product){
            $user = User::find(auth()->user()->id);


            if($product->warehouses->contains($warehouse_id)){
                $prod = (object)[];
                if($user->cart){
                    $quantity = $user->cart->product_quantity($product);
                    $prod->incart = $quantity;
                }else
                    $prod->incart = 0;
                $prod->id = $product->id;
                $prod->name = $product->name;
                $prod->description = $product->description;
                $prod->category_id = $product->category_id;
                $prod->sub_category_id = $product->sub_category_id;
                $prod->real_price = $product->real_price;
                $prod->original_price = $product->original_price;
                $prod->on_sales = $product->on_sales;
                $prod->default_image = $product->defaultImage->image_url;

                $newProducts["data"][] = $prod;
            }
        }
        $products = json_decode($products->toJSON());
        $newProducts['current_page'] = $products->current_page;
        $newProducts[ "first_page_url"] =$products->first_page_url;
        $newProducts["from"] = $products->from;
        $newProducts["last_page"] = $products->last_page;
        $newProducts["last_page_url"] = $products->last_page_url;
        $newProducts["links"] = $products->links;
        $newProducts["next_page_url"] = $products->next_page_url;
        $newProducts["path"] = $products->path;
        $newProducts["per_page"] = $products->per_page;
        $newProducts["prev_page_url"] = $products->prev_page_url;
        $newProducts["to"] = $products->to;
        $newProducts["total"] = $products->total;
        $res = [];

        $res['category'] = $cat;
        $cat->parent_id == 0 ? $res['sub_categories'] = $subCats : $res['products'] = $newProducts;

        return $this->sendResponse($res, 'Record fetched successfully.');
        //}
    }
}
