<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Room;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Sale;
use App\SaleItem;
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
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movie.movieGoodFor2')
        ->with('id',$sendId)
        ->with('sessionId',$sessionId);  
    }

    public function movieGoodFor4($id){
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movie.movieGoodFor4')
        ->with('id',$sendId)
        ->with('sessionId',$sessionId);  
    }

    public function movieGoodFor8($id){
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movie.movieGoodFor8')
        ->with('id',$sendId)
        ->with('sessionId',$sessionId);  
    }
}
