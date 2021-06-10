<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;

class CartController extends Controller
{
    //
    function cartadd(Request $request, $product_id)
    {
        $quantity = $request -> quantity;
        $product_id;
        $ip_address = request()->ip();
        $product_quantity = Product::find($product_id)->product_quantity;

        if ($quantity > $product_quantity) {
            return back()->withErrors([
                'quantity' => 'Stock is not Available'
            ]);
        }
        
        if (Cart::where('ip_address',$ip_address)->where('product_id', $product_id) ->exists()) {
            Cart::where('ip_address',$ip_address)->where('product_id', $product_id) ->increment('quantity', $quantity);
        } else {
            Cart::insert([
                'product_id' => $product_id,
                'ip_address' => $ip_address,
                'quantity' => $quantity,
                'created_at' => Carbon::now()
            ]);            
        }
        return back();
    }

    function cartdelete($cart_id)
    {
        Cart::find($cart_id) -> delete();
        return back();
    }

    
}
