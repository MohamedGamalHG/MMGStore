<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\CategoryRepositoryInterface;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Traits\SaveImageTrait;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubFilter;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    use SaveImageTrait;
    public function create(){
        $product = Product::all();
        return view('Admin.ajax.index',compact('product'));
    }
    public function show(){

        $subfilter = SubFilter::all();
        $subcategory = SubCategory::all();
        return view('Admin.ajax.add',compact('subfilter','subcategory'));
    }

    public function store(Request $request){
        $product = new Product();
        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->quantity = $request->product_quantity;
        $product->description = $request->product_description;
        $product->sub_category_id = $request->sub_category;



        $product->save();
        $truthy = $this->save_images($request->photo,'photos/',$product->id);
        $sub_pro = SubFilter::find($request->filter_color);
        $sub_pro2 = SubFilter::find($request->filter_size);

        $product->sub_filters()->attach($sub_pro);
        $product->sub_filters()->attach($sub_pro2);

//        if($request->photo){
//            foreach ($request->photo as $photos){
//                $photos->storeAs('photos/'.$product->id,$photos->getClientOriginalName(),'public');
//                $photos->move(public_path('photos/'.$product->id),$photos->getClientOriginalName());
//
//                $img = new Image();
//                $img->name = $photos->getClientOriginalName();
//                $img->product_id = $product->id;
//                $img->save();
//            }
        //}

        if($product && $truthy){
            return response()->json([
                'status'       => true,
                'msg'          => 'data saved',
            ]);
        }
        else return response()->json([
                'status'       => false,
                'msg'          => 'data note saved',
        ]);

    }
    public function delete(Request $request){
        //return $request;
        $pro = Product::findOrFail($request->id);
        //return  $pro;
        if($pro){
            $pro->delete();
            return response()->json([
                'status'       => true,
                'msg'          => 'data deleted',
                'id'           => $request->id
            ]);
        }else return response()->json([
            'status'       => false,
            'msg'          => 'data note saved',
        ]);


    }
}
