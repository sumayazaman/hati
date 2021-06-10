<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Carbon\Carbon;

class FaqController extends Controller
{
    //
    function index()
    {
        $faqs = Faq::all();
        return view('faq.index', compact('faqs'));
    }

    function faqpost(Request $request)
    {
        Faq::insert($request -> except('_token') + [
            'created_at' => Carbon::now()
        ]);
        return back() -> with('faq_insert_status', 'A new FAQ Added Successfully');
    }

    function faqedit($faq_id)
    {
        $faq_info = Faq::findOrFail($faq_id);
        return view('faq.edit', compact('faq_info'));
    }
    function faqupdate(Request $request)
    {
        Faq::findOrFail($request -> faq_id) -> update($request -> except('_token', 'faq_id'));
        return redirect('faq');
    }
    function faqdelete($product_id)
    {
        Faq::find($product_id)->delete() ;
        return back();
    }
}
