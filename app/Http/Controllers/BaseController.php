<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Room;
use App\Customer;
use App\Sale;
use App\Product;
use App\Http\Requests;

class BaseController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = Customer::all();
        

        $data = [
            'sale' => Sale::all(),
        ];

        $sales = $data['sale'];
        return view('rooms.home',compact('rooms'))
            ->with('sales',$sales)
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }





}
