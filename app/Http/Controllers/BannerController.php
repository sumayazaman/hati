<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class BannerController extends Controller
{
    //
    function index()
    {
        $banners = Banner::all();
        return view('banner.index',compact('banners'));
    }
    function store(Request $request)
    {
        $image_name = Str::random(10).time().".".$request->image->getClientOriginalExtension();
       
        Image::make($request ->image)->save(base_path('public/uploads/banner/'.$image_name));
        
        Banner::insert([
            'title' => $request -> title,
            'description' => $request-> description,
            'image' => $image_name,
            'created_at' => Carbon::now()
        ]);

        return back();
    }

    function delete($banner_id)
    {
        $image_name = Banner::find($banner_id)->image;
        unlink(base_path('public/uploads/banner/'.$image_name));
        Banner::find($banner_id)->delete();
        return back();
    }

    function edit($banner_id)
    {
        $banner_info = Banner::find($banner_id);
        return view('banner.edit', compact('banner_info'));
    }

    function update(Request $request, $banner_id)
    {
        if ($request -> hasFile('image')) {
            $banner = Banner::find($banner_id)->image;
            unlink(base_path('public/uploads/banner/').$banner);
            
            $image_name =  Str::random(10).time().".".$request -> image -> getClientOriginalExtension();
            Image::make($request -> image)->save(base_path('public/uploads/banner/'.$image_name));

            Banner::findOrFail($banner_id)->update([
                'image' => $image_name
            ]);            
        }

        Banner::findOrFail($banner_id)->update($request -> except('_token', 'image'));
        return redirect('banner');
    }
}
