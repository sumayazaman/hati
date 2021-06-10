<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    function category(){
        $categories = Category::all();
        $categories_deleted = Category::onlyTrashed() -> get();
        return view('category.index', compact('categories','categories_deleted'));
    }
    function categorypost(Request $request)
    {
        $photo_name = Str::random(10).time() .".". $request -> category_photo -> getClientOriginalExtension();
        $photo = $request -> file('category_photo');
        Image::make($photo) -> save(base_path('public/uploads/category/').$photo_name);
        $request -> validate([
            'category_name' => 'required|max:20|min:2|unique:categories,category_name'
        ]);

        Category::insert([
            'category_name' => $request -> category_name,
            'category_photo' => $photo_name,
            'created_at' => Carbon::now() 
        ]);

        return back() -> with('category_insert_status', 'Category '. $request -> category_name . ' Added successfully');
    }
    function  categorydelete($category_id){
        Category::find($category_id)->delete();
        Product::where('category_id', $category_id) -> delete();
        return back() -> with('category_delete_status', 'Category deleted with its products'); 
    }
    function categoryalldelete(){
        // Category::truncate();
        Category::whereNull('deleted_at')->delete();
        return back();
    }
    function categoryedit($category_id){
        $category_info = Category::find($category_id);
        return view('category.edit',compact('category_info'));
    }
    function categoryeditpost(Request $request){
        if($request -> category_name == Category::find($request -> category_id) -> category_name){
            return back() -> withErrors('Please Enter a New Category Name');
        }
        $request -> validate([
            'category_name' => 'required|max:20|min:2|unique:categories,category_name'
        ]);
        Category::find($request -> category_id) -> update([
            'category_name' => $request -> category_name
        ]);
        return redirect('category');
    }
    function categoryselectedelete(Request $request){
        if(isset($request -> category_id)){
            foreach ($request -> category_id as $single_category_id) {
                Category::find($single_category_id)->delete();
            }
            return back() -> with('category_delete_status', 'Selected Categories deleted successfully'); 
        }else {
            return back() -> with('category_delete_status', 'Select category to delete'); 
        }
    }
    function categoryrestore($category_id){
        Category::withTrashed() -> where('id', $category_id) -> restore();
        return back();
    }
    function categoryforcedelete($category_id){
        Category::withTrashed() -> where('id', $category_id) -> forcedelete();
        return back();
    }
    function categoryallrestore(){
        Category::withTrashed() -> restore();
        return back();
    }
    function categoryallforcedelete(){
        Category::withTrashed() -> forcedelete();
        return back();
    }
}
