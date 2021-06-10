<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Featurephoto;
use App\Models\Category;
use Carbon\Carbon;
use Image;
use Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    function product()
    {
        $id = Auth::id();
        $products = Product::where('user_id', $id)->get();
        $categories = Category::all();
        return view('product.index', compact('categories','products'));
    }

    function productpost(Request $request)
    {
        $request -> validate([
            'product_photo' => 'mimes:jpg,png'
        ]);      
        $photo_name = Str::random(10).time(). "." . $request -> product_photo -> getClientOriginalExtension();
        $photo = $request -> file('product_photo');
        Image::make($photo) -> save(base_path('public/uploads/product/').$photo_name);

        $product_id = Product::insertGetId($request -> except('_token','product_photo','user_id','feature_photo') + [
            'user_id' => Auth::id(),
            'product_photo' => $photo_name,
            'created_at' => Carbon::now()
        ]);
        
        foreach ($request -> feature_photo as $image) {
            $feature_image = Str::random(10).time(). "." . $image -> getClientOriginalExtension();
            Image::make($image) -> save(base_path('public/uploads/feature_photo/').$feature_image);

            Featurephoto::insert([
                'product_id' => $product_id,
                'image_name' => $feature_image,
                'created_at' => Carbon::now()
            ]);
        }
        return back() -> with('product_insert_status', 'Product '. $request -> product_name. ' Added Successfully');
    }

    function productedit($product_id)
    {
        $categories = Category::all();
        $product_info = Product::findOrFail($product_id);
        return view('product.edit', compact('product_info', 'categories'));
    }
    function producteditpost(Request $request, $product_id)
    {
        // print_r($request -> all());
        if ($request -> hasFile('product_photo')) {
            $product_photo = Product::find($product_id) -> product_photo;
            unlink(base_path('public/uploads/product/'. $product_photo));

            $photo_name = Str::random(10).time(). "." . $request -> product_photo -> getClientOriginalExtension();
            $photo = $request -> file('product_photo');
            Image::make($photo) -> save(base_path('public/uploads/product/').$photo_name);
            
            Product::findOrFail($product_id) -> update([
                'product_photo' => $photo_name
            ]);
        }         
        Product::findOrFail($product_id) -> update($request -> except('_token','product_photo'));
        return redirect('product');
    }
    function productdelete($product_id)
    {
        Product::find($product_id)->delete() ;
        return back();
    }  
}
