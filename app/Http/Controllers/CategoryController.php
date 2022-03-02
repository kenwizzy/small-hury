<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/categories', [
            'categories' => Category::where('parent_id',0)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cat_name'     => 'required|string|unique:categories,slug',
            'sub_cat_name.*'     => 'required|string',
            'image' => 'required|file'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if ($request->hasFile('image')) {
            $filen = $request->image->getClientOriginalName();
            $filename = time() . '.' . $filen;
            $request->image->move('assets/images/categories', $filename);
        }

        $category = new Category();
        $category->name = $request->cat_name;
        $category->slug = Str::slug($request->cat_name);
        $category->cat_img_url = asset('assets/images/categories/' . $filename);
        $category->save();
        if (!empty($request->sub_cat_name)) {
            foreach ($request->sub_cat_name as $subCategory) {
                $subcategory = new Category();

                $subcategory->name = $subCategory;
                $subcategory->slug = Str::slug($subCategory);
                $subcategory->parent_id = $category->id;
                $subcategory->cat_img_url = null;
                $subcategory->save();
            }
        }
        return redirect('dashboard/categories')->withSuccess('Category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function createSubCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'cat'     => 'required|numeric',
            'sub_cat'     => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        Category::create([
            'parent_id'=>$request->cat,
            'name'=>$request->sub_cat,
            'slug'=>Str::slug($request->sub_cat)
        ]);

        return redirect()->back()->withSuccess($request->sub_cat.' created successfully');
    }

    public function FetchSubCategoryValues($id)
    {
        $values = Category::where('parent_id', $id)->get();

        //$res = json_decode($values);
        foreach ($values as $sub) {
            echo "<option value='" . $sub->id . "'>$sub->name</option>";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get category record
        $category = Category::findOrFail($id);

        $data = [
            'category'    =>  $category,
        ];

        return view('dashboard/edit_category', $data);
    }

    public function getSubCategories($id)
    {
        $data = Category::where('id',$id)->select('name')->first();
        $categories = Category::where('parent_id', $id)->get();

        return view('dashboard/sub_categories', compact('categories', 'data'));
    }

    public function getsCats() 
    {
        //$data = Category::where('id',$id)->select('name')->first();
        $categories = Category::with('parent')->where('parent_id', '<>', 0)->orderBy('id','desc')->get();
        $data = Category::where('parent_id',0)->get();
        return view('dashboard/sub-categories', compact('categories','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'image' => 'nullable|file'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $oldCategoryName = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->move('assets/images/categories', $filename);

            $categorymageUrl = asset('assets/images/categories/' . $filename);
        }

        $updateCategory = Category::where('id', $id)->first();
        if ($updateCategory->parent_id == 0) {
            $updateCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'cat_img_url' => $request->image==''? $updateCategory->cat_img_url:$categorymageUrl
        ]);
            return redirect('dashboard/categories')->withSuccess('Category updated successfully');
        } else {
            $updateCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'cat_img_url' => $request->image==''? $updateCategory->cat_img_url:$categorymageUrl
        ]);
            return redirect('dashboard/sub-categories')->withSuccess('Sub category updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->parent_id==0) {
            $category->subCats()->delete();
            Category::where('id',$category->id)->delete();
         return redirect()->back()->withSuccess(ucfirst($category->name).' and it"s Sub Sategories Deleted Successfully');
        }else{
            Category::where('id',$category->id)->delete();
         return redirect()->back()->withSuccess('Sub Category '.ucfirst($category->name).' Deleted Successfully');
        }
        
    }
}
