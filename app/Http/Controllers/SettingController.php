<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    //
    function index()
    {
        $settings = Setting::all();
        return view('setting.index', compact('settings'));
    }
    function update(Request $request)
    {
        // return $request -> except('_token');
        foreach ($request -> except('_token') as $key => $value) {
            Setting::where('setting_name', $key) -> update([
                'setting_value' => $value
            ]);
        }
        return back();
    } 
}
