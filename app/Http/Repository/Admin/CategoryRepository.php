<?php

namespace App\Http\Repository\Admin;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function index()
    {
        $category = Category::all();
        return view('Admin.category.index',compact('category'));
    }

    public function store($request)
    {
        try {
            $category = new Category();
            $category->name = $request->category;
            $category->save();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update($request)
    {
        try {
            $category = Category::findOrFail($request->id);
            $category->name = $request->category;
            $category->save();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($request)
    {
        try {
            $cat = Category::findOrFail($request->id);
            $cat->delete();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
