<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Featurephoto;
use App\Models\Customer;
use App\Models\Faq;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\City;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Cartorder;
use App\Models\Order_details;
use Carbon\Carbon;
use Hash;
use Auth;

class FrontendController extends Controller
{
    function about(){
        $names = [
            "potato", "cat", "fox", "dog", "tom", "jerry"
        ];
        return view('about', compact('names'));
    }
    function home(){
        $categories = Category::all();
        $products = Product::latest() -> limit(4) -> get();
        $banners = Banner::all();
        $testimonials = Testimonial::all();
                
        return view('index', compact('categories','products', 'banners','testimonials'));
    }
    function contact(){
        return view('contact');
    }
    function productdetails($product_id)
    {
        $product_info = Product::find($product_id);
        $related_products = Product::where('category_id', $product_info -> category_id) -> where('id','!=', $product_id) -> get();
        $faqs = Faq::all();
        $feature_photos = Featurephoto::where('product_id', $product_id) -> get();
        return view('product.details', compact('product_info', 'faqs', 'related_products', 'feature_photos'));
    }
    function contactform(Request $request)
    {
        Customer::insert($request -> except('_token') + [
            'created_at' => Carbon::now()
        ]);
        return back();
    }
    function shop()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('shop', compact('products', 'categories'));
    }
    function categoryshop($category_id)
    {
        $products_all = Product::where('category_id', $category_id) -> get();
        return view('category.shop', compact('products_all'));
    }

    function cart($coupon_name = "")
    {
        $discount_amount=0;
        if ($coupon_name) {

            if (Coupon::where('coupon_name', $coupon_name)->exists()) {

                if (Coupon::where('coupon_name', $coupon_name)->first()->expired_date > Carbon::now()->format('Y-m-d')) {
                    
                    if (Coupon::where('coupon_name', $coupon_name)->first()->usage_limit > 0) {
                        
                        $discount_amount = Coupon::where('coupon_name', $coupon_name)->first()->discount_amount;

                    } else {
                        return back()->withErrors(['coupon_error' => 'Limit sesh']);
                    }
                    
                } else {
                    return back()->withErrors(['coupon_error' => 'date expired']);
                }
                
            } else {
                return back()->withErrors(['coupon_error' => 'Invalid Coupon Name']);
            }
            
        }else{
            $discount_amont = 0;
        }
        
        $ip_address = request()->ip();
        $carts = Cart::where('ip_address',$ip_address) -> get();

        return view('cart', [
            'carts' => $carts,
            'discount_amount' => $discount_amount,
            'coupon_name' => $coupon_name
        ]);
    }

    function updatecart(Request $request)
    {
        foreach ($request->quantity as $key => $value) {
            Cart::find($key)->update([
                'quantity' => $value
            ]);
        }
        return back();
    }

    function checkout()
    {
        return view('checkout',[
            'countries' => Country::select('id','name')->get(),
            'cities' => City::select('id','name')->get()
        ]);
    }

    function loginform()
    {
        return view('customer.login');
    }

    function login(Request $request)
    {
        if (User::where('email', $request->email) ->exists()) {
            $db_password = User::where('email', $request->email)-> first()-> password;
            
            if (Hash::check($request -> password, $db_password)) {
                
                if (Auth::attempt($request -> except('_token'))) {
                    return redirect() -> intended('home');
                }
            } else {
                return back() -> withErrors([
                    'email' => 'the credentials do not match'
                    ]);
            }
            
        } else {
            return back() -> withErrors([
                'email' => 'The Email Address is not found'
                ]);
        }
        
    }

    function registerform()
    {
        return view('customer.register');
    }

    function register(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request -> email,
            'password' => bcrypt($request->password),
            'role' => 2,
            'created_at' => now()
        ]);

        return back();
    }

    function cities(Request $request)
    {
        echo $cities = City::where('country_id', $request->country_id)->select('id','name')->get();
        $str = "";
        foreach ($cities as $city ) {
            
            $str .= "<option value='".$city->id."'>".$city->name."</option>";
        }
        echo $str;
    }

    function storeorder(Request $request)
    {
       if ($request->payment_option == 1) {

       } else {
           $order_id = Cartorder::insertGetId($request->except('_token') + [
               'user_id' => Auth::id(),
               'discount' => session('discount_amount'),
               'subtotal' => session('subtotal'),
               'total' => session('total'),
               'payment_status'=> 1,
               'created_at' => now()
               ]);
               
            $carts = Cart::where('ip_address', request()->ip())->select('id','product_id', 'quantity')->get( );
            foreach ($carts as $cart ) {
                Order_details::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart -> product_id,
                    'quantity' => $cart -> quantity,
                    'created_at' => now() 
                ]);
                Product::find($cart->product_id)-> decrement('product_quantity', $cart-> quantity);
                Cart::find($cart->id)->delete();
            }
            return redirect()->route('home');
        
       }
       
    }
}
