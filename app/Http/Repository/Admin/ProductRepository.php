<?php

namespace App\Http\Repository\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubFilter;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{

    public function index()
    {

        $product = Product::all();
        return view('Admin.product.index',compact('product'));
    }

    public function store($request)
    {
        //return $request;
        try {
            DB::beginTransaction();
            $product = new Product();
            $product->name = $request->product_name;
            $product->price = $request->product_price;
            $product->quantity = $request->product_quantity;
            $product->description = $request->product_description;
            $product->sub_category_id = $request->sub_category;
            $product->save();

            $this->saveImage($request->photo,$product->id);

            $sub_pro = SubFilter::find($request->filter);
            $product->sub_filters()->attach($sub_pro);

            DB::commit();
            return redirect()->route('product.index');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show()
    {
        $subfilter = SubFilter::all();
        $subcategory = SubCategory::all();
        return view('Admin.product.add',compact('subfilter','subcategory'));
    }

    public function update($request)
    {
        //return $request;
        try {
            DB::beginTransaction();
            $product =  Product::findOrFail($request->id);
            $product->name = $request->product_name;
            $product->price = $request->product_price;
            $product->quantity = $request->product_quantity;
            $product->description = $request->product_description;
            $product->sub_category_id = $request->sub_category;
            $product->save();

            $this->saveImage($request->photo,$product->id);

            /* this trait for saving images
             * $truthy = $this->save_images($request->photo,'photos/',$product->id);
             */


            $sub_pro = SubFilter::find($request->filter);
            $product->sub_filters()->attach($sub_pro);

            DB::commit();
            return redirect()->route('product.index');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        //return $product;
        $subfilter = SubFilter::all();
        $subcategory = SubCategory::all();
        return view('Admin.product.edit',compact('subfilter','subcategory','product'));
    }

    public function destroy($request)
    {
        try {
            $cat = Product::findOrFail($request->id);

            $product = Product::find($request->id);

            $product->sub_filters()->detach($product);
            //return $product;
            $cat->delete();
            return redirect()->route('index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    private function saveImage($photo,$product_id){
        if(!empty($photo)){
            foreach ($photo as $photos)
            {
                $photos->storeAs('photos/'.$product_id,$photos->getClientOriginalName(),'public');
                $photos->move(public_path('photos/'.$product_id),$photos->getClientOriginalName());

                $img = new Image();
                $img->name = $photos->getClientOriginalName();
                $img->product_id = $product_id;
                $img->save();
            }
        }

    }
}
