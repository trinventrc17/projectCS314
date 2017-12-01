<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CountDownTimerController extends Controller
{
    public function index (){
    	$rooms = Customer::all();
    	return view('countdown.home')->with('rooms',$rooms);
    }


   public function trap(){
   		return view('countdown.trap');
   }

    public function save (Request $request){
      if($request->today == 'Tomorrow'){
        $time = substr($request->dateTime, 0,05);
        $date = Carbon::tomorrow()->format('Y-m-d');
        $dateTime = $date . ' ' . $time;        
      }

      else{
        $time = substr($request->dateTime, 0,05);
        $date = Carbon::now()->format('Y-m-d');
        $dateTime = $date . ' ' . $time;        
      }


        dd($dateTime);
    }



}
