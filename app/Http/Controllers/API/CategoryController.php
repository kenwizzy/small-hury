<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends BaseController
{
    public function getCategories()
    {
        $categories = Category::all();
        return $this->sendResponse($categories, 'Categories fetched successfully.');
    }

    public function show($id)
    {
        $cat = Category::findOrFail($id);
        // if ($cat == null) {
        //     return $this->sendError('Record not found', $cat);
        // } else {
        $subCats = Category::where('parent_id', $cat->id)->get();
        $products = Product::where('sub_category_id', $cat->id)->get();
        $res = [];

        $res['category'] = $cat;
        $cat->parent_id == 0 ? $res['sub categories'] = $subCats : $res['products'] = $products;

        return $this->sendResponse($res, 'Record fetched successfully.');
        //}
    }
}
