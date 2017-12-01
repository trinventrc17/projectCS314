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
                ->with('roomType',$request->roomType)
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
        $additionalPersonFee = 0;
        $roomPrice = 230;
        $promoPrice = 0;
        $roomId = $id;
        $sendId = 0;
        $room = Customer::findOrFail($id);
        $session = $room->session;
        $reservationFee = $request->reservationFee;
        $reservationfeeId = 7;
        $numberOfExtraPersonId = 7;
        $additionalTimeFeeId = 7;
        $discountFeeId = 7;
        $discountFee = 0;
        $corkageFeeId = 7;
        $todayOrTomorrow = $request->todayOrTomorrow;

        switch ($roomType) {
            case "None":
                $sendId = 7;
                $corkageFeeId = 7;
                $corkageFee = 0;
                $numberOfMoviesOrHour =0;
                $numberOfExtraPersonId = 7;
                $numberOfExtraPerson = 0;
                $additionalTimeFeeId = 7;
                $additionalTimeFee = 0;
                $promoPrice = 0;
                $reservationFee = 0;
                $reservationfeeId = 7;                
                $discountFeeId = 7;
                $discountFee = 0;
                break;
            case "Movie Good For 2":
                if($promoType == 'Regular'){
                    $promoPrice = 0;
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 30;
                    $roomPrice = 260;
                    $sendId = 1;
                    $corkageFeeId = 4;
                    $numberOfExtraPersonId = 5;
                    $additionalTimeFeeId = 6;
                    $movies = $request->movies;
                    $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                    $numberOfExtraPerson = $request->numberOfExtraPerson;
                    $additionalTimeFee = $request->additionalTimeFee;
                    $corkageFee = $request->corkageFee;
                    $discountFeeId = 8;
                    $discountFee = -$request->discountFee;
                }
                else{
                    $promoPrice = 0;
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 30;
                    $roomPrice = 230;
                    $sendId = 1;
                    $corkageFeeId = 4;
                    $numberOfExtraPersonId = 5;
                    $additionalTimeFeeId = 6;
                    $movies = $request->movies;
                    $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                    $numberOfExtraPerson = $request->numberOfExtraPerson;
                    $additionalTimeFee = $request->additionalTimeFee;
                    $corkageFee = $request->corkageFee;
                    $discountFeeId = 8;
                    $discountFee = -$request->discountFee;
                }
                break;
            case "Movie Good For 4":
                    $promoPrice = 0;
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 30;
                    $roomPrice = 450;
                    $sendId = 2;
                    $corkageFeeId = 4;
                    $numberOfExtraPersonId = 5;
                    $additionalTimeFeeId = 6;
                    $movies = $request->movies;
                    $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                    $numberOfExtraPerson = $request->numberOfExtraPerson;
                    $additionalTimeFee = $request->additionalTimeFee;
                    $corkageFee = $request->corkageFee;
                    $discountFeeId = 8;
                    $discountFee = -$request->discountFee;
                break;
            case "Movie Good For 8":
                    $promoPrice = 0;
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 30;
                    $roomPrice = 800;
                    $sendId = 3;
                    $corkageFeeId = 4;
                    $numberOfExtraPersonId = 5;
                    $additionalTimeFeeId = 6;
                    $movies = $request->movies;
                    $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                    $numberOfExtraPerson = $request->numberOfExtraPerson;
                    $additionalTimeFee = $request->additionalTimeFee;
                    $corkageFee = $request->corkageFee;
                    $discountFeeId = 8;
                    $discountFee = -$request->discountFee;
                break;
            case "Ktv Good For 4":
                    $promoPrice = 0;
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 20;
                    $roomPrice = 150;
                    $sendId = 10;
                    $corkageFeeId = 4;
                    $numberOfExtraPersonId = 5;
                    $additionalTimeFeeId = 6;
                    $movies = $request->movies;
                    $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                    $numberOfExtraPerson = $request->numberOfExtraPerson;
                    $additionalTimeFee = $request->additionalTimeFee;
                    $corkageFee = $request->corkageFee;
                    $discountFeeId = 8;
                    $discountFee = -$request->discountFee;
                break;
            case "Ktv Good For 8":
                    $promoPrice = 0;
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 20;
                    $roomPrice = 199;
                    $sendId = 11;
                    $corkageFeeId = 4;
                    $numberOfExtraPersonId = 5;
                    $additionalTimeFeeId = 6;
                    $movies = $request->movies;
                    $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                    $numberOfExtraPerson = $request->numberOfExtraPerson;
                    $additionalTimeFee = $request->additionalTimeFee;
                    $corkageFee = $request->corkageFee;
                    $discountFeeId = 8;
                    $discountFee = -$request->discountFee;
                break;
            case "Reservation":
                $promoPrice = 0;
                $reservationfeeId = 7;
                $reservationFee = $request->reservationFee;
                $additionalPersonFee = 0;
                $roomPrice = 0;
                $sendId = 9;
                $corkageFeeId = 4;
                $numberOfExtraPersonId = 5;
                $additionalTimeFeeId = 6;
                $movies = $request->movies;
                $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                $numberOfExtraPerson = $request->numberOfExtraPerson;
                $additionalTimeFee = $request->additionalTimeFee;
                $corkageFee = $request->corkageFee;
                $discountFeeId = 7;
                $discountFee = 0;
                break;
            default:
                $promoPrice = 0;
                $promoType = $request->promoType;
                $roomType = $request->roomType;
                $startTime = $request->startTime;
                $endTime = $request->endTime;
                $movies = $request->movies;
                $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                $numberOfExtraPerson = $request->numberOfExtraPerson;
                $additionalTimeFee = $request->additionalTimeFee;
                $corkageFee = $request->corkageFee;
                $additionalPersonFee = 0;
                $roomPrice = 230;
                $roomId = $id;
                $sendId = 0;
                $room = Customer::findOrFail($id);
                $session = $room->session;
                $reservationFee = $request->reservationFee;
                $reservationfeeId = 7;
                $numberOfExtraPersonId = 7;
                $additionalTimeFeeId = 7;
                $discountFeeId = 7;
                $discountFee = 0;
        }




        return view('rooms.roomSales.create')->with('sendId',$sendId)
            ->with('roomId',$roomId)
            ->with('reservationFee',$reservationFee)
            ->with('discountFee',$discountFee)
            ->with('discountFeeId',$discountFeeId)
            ->with('reservationfeeId',$reservationfeeId)
            ->with('additionalPersonFee',$additionalPersonFee)
            ->with('roomType',$roomType)->with('roomPrice',$roomPrice)
            ->with('promoType',$promoType)->with('promoPrice',$promoPrice)
            ->with('session',$session)
            ->with('startTime',$startTime) ->with('endTime',$endTime)
            ->with('numberOfExtraPerson',$numberOfExtraPerson)->with('numberOfExtraPersonId',$numberOfExtraPersonId)
            ->with('movies',$movies)->with('numberOfMoviesOrHour',$numberOfMoviesOrHour)
            ->with('additionalTimeFee',$additionalTimeFee)->with('additionalTimeFeeId',$additionalTimeFeeId)
            ->with('corkageFee',$corkageFee)->with('corkageFeeId',$corkageFeeId)
            ->with('todayOrTomorrow',$todayOrTomorrow);
    }



}
