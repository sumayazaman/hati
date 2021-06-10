<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cartorder;
use App\Models\Order_details;
use Auth;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $users = User::limit(2) -> get();
        $orders = Cartorder::where('user_id', Auth::id())->get();
        $users = User::latest() -> paginate(4);
        return view('home', compact('users','orders'));
    }

    public function downloadinvoice($order_id)
    {
        $order = Cartorder::find($order_id);
        $order_details = Order_details::where('order_id',$order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('order','order_details'));
        $name = "invoice - ".now().".pdf";
        return $pdf->download($name);
    }
}
