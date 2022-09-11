<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\SubFilter;
use Livewire\Component;

class Filter extends Component
{
    public $products,$filter_id,$product_id,$mode = false;

    /*public function mount($id)
    {
        $filter_color_id = $id ;
        $filter = SubFilter::find($filter_color_id);
        $this->products = SubFilter::with(['products'=> function($q) use ($filter_color_id){
            $q->select('*')->where('sub_filter_id',$filter_color_id);
        }])->where('id',$filter_color_id)->get();
        return $this->products;
    }*/


    public function getDate($id){
        //return $request;
        $this->filter_id = $id;
        $filter_color_id = $this->filter_id ;
        $filter = SubFilter::find($filter_color_id);
        $product = SubFilter::with(['products'=> function($q) use ($filter_color_id){
            $q->select('*')->where('sub_filter_id',$filter_color_id);
        }])->where('id',$filter_color_id)->get();

        //return view('Customer.product_list_ajax',compact('product'));
    }

    public $producting;

    public function getFilterColor($id)
    {
        //return dd($id);
        $filter_color_id = $id;
        $filter = SubFilter::with('products')->find($filter_color_id);
        $product_id = [];
        $i=0;
        //return dd($filter->products);
        foreach ($filter->products as $fil)
        {
               $product_id[$i++] =  $fil->id;
        }
        //return dd($product_id);
        //$product = SubFilter::with('products')->where('id',13)->get();
        $product = Product::with([
                         'sub_filters'=>function($q) use ($filter_color_id)
                         {  $q->where('sub_filters.id',$filter_color_id); }
                        ,'images'])
                        ->whereIn('id',$product_id)
                        ->get();
        //return dd($product);
        //return dd($filter_color_id);
        /*$product = Product::with(['sub_filters'=>function($q) use ($filter_color_id){
               $q->select('*')->where('sub_filter_id',$filter_color_id);
           }])->get();
        return dd($product);*/
        /*$product = SubFilter::with(['products'=> function($q) use ($filter_color_id){
            $q->select('*')->where('sub_filter_id',$filter_color_id);
        }])->where('id',$filter_color_id)->get();*/
        $this->mode= true;
        $this->producting = $product;
     /*    foreach ($this->producting as $pr)
             return dd($pr->images[0]->name);
                //return dd($pr->sub_filters[0]->name);
    return dd($this->producting);*/

        return view('livewire.filter',['producting'=>$this->producting]);

    }

    public function getFilterSize($id)
    {
        $filter_size_id = $id;
        $filter = SubFilter::with('products')->find($filter_size_id);
        $product_id = []; $i=0;
        foreach ($filter->products as $fil)
        {
            $product_id[$i++] =  $fil->id;
        }
        $product = Product::with([
            'sub_filters'=>function($q) use ($filter_size_id)
            {  $q->where('sub_filters.id',$filter_size_id); }
            ,'images'])
            ->whereIn('id',$product_id)
            ->get();
        $this->mode= true;
        $this->producting = $product;
        return view('livewire.filter',['producting'=>$this->producting]);

    }

    public function getFilterPrice($id)
    {
        $filter_price_id = $id;
        $product = Product::with('images')->where('price' ,'=',$filter_price_id)->get();
        $this->mode= true;
        $this->producting = $product;
        return view('livewire.filter',['producting'=>$this->producting]);
    }

    public function render()
    {

            return view('livewire.filter', [
                'product' => Product::with('images')->get()
            ]);

    }
}
