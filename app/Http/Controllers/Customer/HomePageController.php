<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Repository\Customer\HomePageRepositoryInterface;
use App\Http\Requests\Customer\RegisterCustomerRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SubFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomePageController extends Controller
{
    protected $home;
    public function __construct(HomePageRepositoryInterface $page)
    {
        $this->home = $page;
    }
    public function index()
    {
        return $this->home->index();
    }


    public function store(Request $request)
    {
        return $this->home->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->home->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->home->delete($request);
    }
    public function Add_Cart($id){
        return $this->home->Add_Cart($id);
    }
    public function Item_Add(Request $request)
    {
        return $this->home->Item_Add($request);
    }
    public function Item_Delete(Request $request)
    {
        return $this->home->Item_Delete($request);
    }
    public function Shop_list(){
        return $this->home->Shop_list();
    }

    public function Shop_Detail($id){
        return $this->home->Shop_Detail($id);
    }

    public function Shop_Cart(){
        return $this->home->Shop_Cart();
    }
    public function Checkout(){
        return $this->home->Checkout();
    }

    public function ajaxColor(Request $request){
        //return $request;
        $filter_color_id = $request->filter_color ;
        $filter = SubFilter::find($filter_color_id);
    /*   $pro = Product::with(['sub_filters'=>function($q){
           $q->select('product_id','name');
       }])->get();*/
        $product = SubFilter::with(['products'=> function($q) use ($filter_color_id){
            $q->select('*')->where('sub_filter_id',$filter_color_id);
        }])->where('id',$filter_color_id)->get();
        //$pro = Product::with('sub_filters')->get();
        //return $product[0]->products[0]->name;
        /*foreach ($product as $pr) {
            echo $pr->products[0]->id;
            /*foreach ($pr->products as $sub)
            echo $sub->pivot;
        }*/
            //echo $pr->sub_filters[0]->pivot;
        //return $product->products[0];
        /*return response()->json([
            'status'           => true,
            'products'         => $product
        ]);*/
        return view('Customer.product_list_ajax',compact('product'));
    }

    public function Login_Customer_View()
    {
        return $this->home->Login_Customer_View();
    }
    public function Register_Customer_View()
    {
        return $this->home->Register_Customer_View();
    }
    public function Login_Customer(Request $request)
    {
        return $this->home->Login_Customer($request);
    }
    public function Register_Customer(RegisterCustomerRequest $request)
    {
        return $this->home->Register_Customer($request);
    }
    public  function Logout($id)
    {
        return $this->home->Logout($id);
    }
}
