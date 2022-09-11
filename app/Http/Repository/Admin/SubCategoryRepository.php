<?php

namespace App\Http\Repository\Admin;

use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{

    public function index()
    {
        $subcategory = SubCategory::all();
        $category = Category::all();
        return view('Admin.subcategory.index',compact('subcategory','category'));
    }

    public function store($request)
    {
        try {
            $subcategory = new SubCategory();
            $subcategory->name = $request->sub_category;
            $subcategory->category_id = $request->category_id;
            $subcategory->save();
            return redirect()->route('sub_category.index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update($request)
    {

        try {
            $subcategory = SubCategory::findOrFail($request->id);
            $subcategory->name = $request->sub_category;
            $subcategory->category_id = $request->category_id;
            $subcategory->save();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($request)
    {
        try {
            $cat = SubCategory::findOrFail($request->id);
            $cat->delete();
            return redirect()->route('sub_category.index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
