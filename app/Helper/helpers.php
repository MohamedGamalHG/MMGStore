<?php

use App\Models\Category;
use App\Models\SubFilter;
use App\Models\Cart;


if(!function_exists('hello')){
    function hello()
    {
        return 'hello wordl';
    }
}

if(!function_exists('Sub_Filter')){
    function Sub_Filter(){
        $subfilter = SubFilter::with('filter')->get();
        return $subfilter;
    }
}

if(!function_exists('Category')){
    function Category(){
        $category = Category::all();
        return $category;
    }
}
if(!function_exists('Price_Filter')){
    function Price_Filter(){
        $product = \App\Models\Product::select('price')->distinct()->orderBy('price','asc')->get();
        return $product;
    }
}

if (!function_exists('cart_add')){
    function cart_add()
    {
        $cart = Cart::count();
        return $cart;
    }
}
