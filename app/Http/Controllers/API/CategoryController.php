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
        $categories = Category::paginate(15);
        return $this->sendResponse($categories, 'Categories fetched successfully.');
    }

    public function show($id)
    {
        $cat = Category::findOrFail($id);
        $subCats = Category::where('parent_id', $cat->id)->paginate(15);
        $products = Product::where('sub_category_id', $cat->id)->paginate(15);
        $res = [];

        $res['category'] = $cat;
        $cat->parent_id == 0 ? $res['sub categories'] = $subCats : $res['products'] = $products;

        return $this->sendResponse($res, 'Record fetched successfully.');
    }
}
