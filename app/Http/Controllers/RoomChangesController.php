<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Room;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Sale;
use App\SaleItem;
use App\RoomChanges;

use DB;

use Carbon\Carbon;

class RoomChangesController extends Controller
{



    public function create()
    {
        return view('rooms.create');
    }

    public function store(Requests\StoreRoomChanges $request)
    {
        $form = $request->all();

        SaleItem::create($form);


        $stocks = Stocks::create([
                'name'=> $productFind->name,
                'quantity' => $request->quantity,
            ]);


        return redirect('asdasd')
            ->with('message-success', 'Room created!');
    }


	public function  updateRoom(Request $request,$id){
		$sessionId = $request->updateSessionId;
		
		return view('rooms.roomchanges.create')
                ->with('id',$id)
                ->with('startTime',$request->startTime)
                ->with('endTime',$request->endTime)
		   		->with('sessionId',$sessionId);
	}


public function roomChangesSale(Requests\RoomRequest $request ,$id)
    {
        $promoType = $request->promoType;
        $roomType = $request->roomType;
        $startTime = $request->startTime;
        $endTime = $request->endTime;

        $movies = $request->movies;
        $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
        $numberOfExtraPerson = $request->numberOfExtraPerson;
        $additionalTimeFee = $request->additionalTimeFee;
        $corkageFee = $request->corkageFee;
        $additionalPersonFee =0;
        $roomId = $id;
        $roomPrice = 0;
        $promoPrice = 0;
        $sendId = 0;
        $room = Customer::findOrFail($id);
        $session = $room->session;

        $corkageId = 7;
        $numberOfExtraPersonId = 7;
        $additionalTimeFeeId = 7;

        if($roomType == 'None' || $promoType == 0){
            $sendId = 7;
            $corkageFeeId = 7;
            $corkageFee = 0;
            $numberOfMoviesOrHour =0;
            $numberOfExtraPersonId = 7;
            $numberOfExtraPerson = 0;
            $additionalTimeFeeId = 7;
            $additionalTimeFee = 0;
        }

        if($roomType == 'Good For 2' && $promoType = 'Regular'){
            $roomPrice = 260;
            $sendId = 1;
            $corkageFeeId = 4;
            $numberOfExtraPersonId = 5;
            $additionalTimeFeeId = 6;
            $movies = $request->movies;
            $additionalPersonFee = 60;
            $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
            $numberOfExtraPerson = $request->numberOfExtraPerson;
            $additionalTimeFee = $request->additionalTimeFee;
            $corkageFee = $request->corkageFee;
        }

        if($roomType == 'Good For 2' && $promoType = 'Happy Hour'){
            $roomPrice = 230;
            $additionalPersonFee = 60;
            $sendId = 1;
            $corkageFeeId = 4;
            $numberOfExtraPersonId = 5;
            $additionalTimeFeeId = 6;
            $movies = $request->movies;
            $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
            $numberOfExtraPerson = $request->numberOfExtraPerson;
            $additionalTimeFee = $request->additionalTimeFee;
            $corkageFee = $request->corkageFee;
        }



        if ($roomType == 'Good For 4'){
            $roomPrice = 450;
            $sendId = 2;
            $corkageFeeId = 4;
            $numberOfExtraPersonId = 5;
            $additionalTimeFeeId = 6;
        }

        if ($roomType == 'Good For 8'){
            $roomPrice = 800;
            $sendId = 3;
            $corkageFeeId = 4;
            $numberOfExtraPersonId = 5;
            $additionalTimeFeeId = 6;
        }
  
  

        return view('rooms.roomSales.roomChangesSale')->with('sendId',$sendId)
            ->with('roomId',$roomId)
            ->with('additionalPersonFee',$additionalPersonFee)
            ->with('roomType',$roomType)->with('roomPrice',$roomPrice)
            ->with('promoType',$promoType)->with('promoPrice',$promoPrice)
            ->with('session',$session)
            ->with('startTime',$startTime) ->with('endTime',$endTime)
            ->with('numberOfExtraPerson',$numberOfExtraPerson)->with('numberOfExtraPersonId',$numberOfExtraPersonId)
            ->with('movies',$movies)->with('numberOfMoviesOrHour',$numberOfMoviesOrHour)
            ->with('additionalTimeFee',$additionalTimeFee)->with('additionalTimeFeeId',$additionalTimeFeeId)
            ->with('corkageFee',$corkageFee)->with('corkageFeeId',$corkageFeeId);
    }



}
