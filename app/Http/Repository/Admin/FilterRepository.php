<?php


namespace App\Http\Repository\Admin;


use App\Models\Filter;

class FilterRepository implements FilterRepositoryInterface
{

    public function index()
    {
       $filter = Filter::all();
       return view('Admin.filter.index',compact('filter'));
    }

    public function store($request)
    {
        try {
            $filter = new Filter();
            $filter->name = $request->filter_name;
            $filter->save();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update($request)
    {
        try {
            $filter = Filter::findOrFail($request->id);
            $filter->name = $request->filter_name;
            $filter->save();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($request)
    {
        try {
            $cat = Filter::findOrFail($request->id);
            $cat->delete();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
