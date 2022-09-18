<?php


namespace App\Http\Repository\Customer;


use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SubFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomePageRepository implements HomePageRepositoryInterface
{

    public function index()
    {
        //$category = Category::all();
        return view('Customer.body_page');
    }
    public function Shop_Detail($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $filter = SubFilter::all();
        //return $filter;
        return view('Customer.shop_details',compact('product','filter'));
    }
    public function Add_Cart($id)
    {
        $product_id = Product::with('images')->findOrFail($id);
        $product_image = $product_id->id .'/'. $product_id->images[0]->name;
        $carts = new Cart();
        $carts->item = $product_id->name;
        $carts->price = $product_id->price;
        $carts->total = $product_id->price;
        $carts->quantity = $product_id->quantity;
        $carts->src_image = $product_image;
        $carts->save();

        return redirect()->back();
    }
    public function Item_Add($request)
    {

        if(!empty($request->size) && !empty($request->color))
        {
            $product_id = Product::with('images')->findOrFail($request->product_id);
            $product_image = $product_id->id .'/'. $product_id->images[0]->name;
            $carts = new Cart();
            $carts->item = $product_id->name;
            $carts->price = $product_id->price;
            $carts->total = $product_id->price;
            $carts->quantity = $request->quantity;
            $carts->src_image = $product_image;
            $carts->save();

            return redirect()->route('shop');
        }
        else {
            //return $request;
            $cart_id = Cart::findOrFail($request->id);
            $cart_id->update([
                'quantity' => $request->add_quantity
            ]);
        }
        return redirect()->back();
    }
    public function Item_Delete($request)
    {
        $cart_id = Cart::findOrFail($request->id);
        $cart_id->delete();
        return redirect()->back();
    }


    private function Real_Price()
    {
        $total_price = Cart::select('price','quantity')->get();
        $real_price = 0;
        $tax=.06;
        foreach ($total_price as $t_p) { $real_price = $real_price + ($t_p->price*$t_p->quantity); }
        $real_price_tax = $real_price + ($real_price*$tax);
        $Price['real'] = $real_price;
        $Price['tax']   = $real_price_tax;
        return $Price;
    }


    public function Shop_Cart()
    {
        $carts = Cart::get();
        $real_price = $this->Real_Price()['real'];
        $real_price_tax = $this->Real_Price()['tax'];
        return view('Customer.shopping_cart',compact('carts','real_price','real_price_tax'));
    }

    public function Checkout()
    {
        $carts = Cart::all();
        $real_price = $this->Real_Price()['real'];
        $real_price_tax = $this->Real_Price()['tax'];
        return view('Customer.checkout',compact('carts','real_price','real_price_tax'));
    }

    public function Shop_list()
    {
        //$category = Category::all();
        //$subfilter = SubFilter::with('filter')->get();

        $product = Product::with('images')->get();
        // We make helper function without put category in all pages that has navbar
        // so that navbar contain the data of Category so we make helper function to that
        return view('Customer.product_list',compact('product'));
    }


    public function Login_Customer_View(){
        $category = Category::all();
        return view('Customer.login',compact('category'));
    }

    public function Login_Customer($request)
    {
        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password]))
            return redirect()->route('index');
        else
            return redirect()->back()->with(['errors'=>'your email or password may be wrong']);
    }
    public function Register_Customer_View(){
        $category = Category::all();
        return view('Customer.register',compact('category'));
    }
    public function Register_Customer($request)
    {
        if($request->password == $request->confirm_password)
        {
            try {
                DB::beginTransaction();
                $customer = new Customer();
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->password = Hash::make($request->password);
                $customer->confirm_password = $request->confirm_password;

                $customer->save();

                DB::commit();
                // here you should make in config file guard and name it like customer to use this in the login and register operateion
                // to get the user name and register in session to take the name from session like Session::get('name')
                // so in the guard you have access to driver session so you can get the name of user from session
                Auth::guard('customer')->login($customer);

                return redirect()->route('index');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with($e->getMessage());
            }
        }
    }
    public function Logout($id)
    {
        $logout = Customer::findOrFail($id);
        auth()->logout();
        session()->invalidate();
        return redirect()->route('index');
    }
}
