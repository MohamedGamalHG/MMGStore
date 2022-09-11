<?php


namespace App\Http\Repository\Admin;


use App\Models\Filter;
use App\Models\SubFilter;

class SubFilterRepository implements SubFilterRepositoryInterface
{

    public function index()
    {
        $subfilter = SubFilter::all();
        $filter = Filter::all();
        return view('Admin.subfilter.index',compact('subfilter','filter'));
    }

    public function store($request)
    {
        try {
            $subfilter = new SubFilter();
            $subfilter->name = $request->sub_filter_name;
            $subfilter->filter_id = $request->filter_name;
            $subfilter->save();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update($request)
    {
        try {
            $subfilter = SubFilter::findOrFail($request->id);
            $subfilter->name = $request->sub_filter_name;
            $subfilter->filter_id = $request->filter_name;
            $subfilter->save();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($request)
    {
        try {
            $cat = SubFilter::findOrFail($request->id);
            $cat->delete();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
