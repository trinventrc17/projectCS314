<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Room;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Sale;
use App\SaleItem;
use Carbon\Carbon;
class MovieController extends Controller
{
    public function movieChooseRoomType($id){
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movie')
        ->with('id',$sendId)
        ->with('sessionId',$sessionId);  
    }


    public function movieGoodFor2($id){
        $startTime1 = Carbon::now()->format('g:ia');
        $carbon_date = Carbon::parse($startTime1);
        $carbon_date->addHours(2);

        $startTime = Carbon::now()->format('g:ia');
        $endTime = $carbon_date->format('g:ia');
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movie.movieGoodFor2')
        ->with('id',$sendId)
        ->with('endTime',$endTime)
        ->with('startTime',$startTime)
        ->with('sessionId',$sessionId);  
    }

    public function movieGoodFor4($id){
        $startTime1 = Carbon::now()->format('g:ia');
        $carbon_date = Carbon::parse($startTime1);
        $carbon_date->addHours(2);

        $startTime = Carbon::now()->format('g:ia');
        $endTime = $carbon_date->format('g:ia');
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movie.movieGoodFor4')
        ->with('id',$sendId)
        ->with('endTime',$endTime)
        ->with('startTime',$startTime)
        ->with('sessionId',$sessionId);
    }

    public function movieGoodFor8($id){
        $startTime1 = Carbon::now()->format('g:ia');
        $carbon_date = Carbon::parse($startTime1);
        $carbon_date->addHours(2);

        $startTime = Carbon::now()->format('g:ia');
        $endTime = $carbon_date->format('g:ia');
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movie.movieGoodFor8')
        ->with('id',$sendId)
        ->with('endTime',$endTime)
        ->with('startTime',$startTime)
        ->with('sessionId',$sessionId); 
    }


    public function ktvChooseRoomType($id){
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.ktv.index')
        ->with('id',$sendId)
        ->with('sessionId',$sessionId);  
    }


    public function ktvGoodFor4($id){
        $startTime1 = Carbon::now()->format('g:ia');
        $carbon_date = Carbon::parse($startTime1);
        $carbon_date->addHours(2);

        $startTime = Carbon::now()->format('g:ia');
        $endTime = $carbon_date->format('g:ia');
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.ktv.ktvGoodFor4')
        ->with('id',$sendId)
        ->with('endTime',$endTime)
        ->with('startTime',$startTime)
        ->with('sessionId',$sessionId);
    }

    public function ktvGoodFor8($id){
        $startTime1 = Carbon::now()->format('g:ia');
        $carbon_date = Carbon::parse($startTime1);
        $carbon_date->addHours(2);

        $startTime = Carbon::now()->format('g:ia');
        $endTime = $carbon_date->format('g:ia');
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.ktv.ktvGoodFor8')
        ->with('id',$sendId)
        ->with('endTime',$endTime)
        ->with('startTime',$startTime)
        ->with('sessionId',$sessionId); 
    }



}
