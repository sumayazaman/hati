<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
Use Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_name =  Str::random(10).time().".".$request->image->getClientOriginalExtension();
        Image::make($request->image)->save(base_path('public/uploads/testimonial/'.$image_name));
        Testimonial::create($request->except('_token','image')+[
            'image' => $image_name
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonial.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        if ($request->hasFile('image')) {
            
            unlink(base_path('public/uploads/testimonial/'.$testimonial->image));
            
            $img = Str::random(10).time().".".$request -> image->getClientOriginalExtension();
            Image::make($request -> image)->save(base_path('public/uploads/testimonial/'.$img));
            
            $testimonial -> update([
                'image' => $img
            ]);
        }

        $testimonial ->update($request->except('_token','_method','image'));
        
        return redirect('testimonial');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        unlink(base_path('public/uploads/testimonial/'.$testimonial -> image)) ;
        $testimonial->delete();
        return back();
    }
}
