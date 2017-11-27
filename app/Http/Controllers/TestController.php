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
class TestController extends Controller
{




    public function walkinSale(Requests\RoomRequest $request ,$id)
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
        $roomId = $id;
        $sendId = 0;
        $room = Customer::findOrFail($id);
        $session = $room->session;
        $reservationFee = $request->reservationFee;
        $reservationfeeId = 7;
        $numberOfExtraPersonId = 7;
        $additionalTimeFeeId = 7;



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
                break;
            case "Good For 2":
                if($promoType == 'Regular'){
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 60;
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
                }
                else{
                    $reservationfeeId = 7;
                    $reservationFee = 0;
                    $additionalPersonFee = 60;
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
                }
                break;
            case "Good For 4'":
                $roomPrice = 450;
                $sendId = 1;
                $corkageFeeId = 4;
                $numberOfExtraPersonId = 5;
                $additionalTimeFeeId = 6;
                $movies = $request->movies;
                $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                $numberOfExtraPerson = $request->numberOfExtraPerson;
                $additionalTimeFee = $request->additionalTimeFee;
                $corkageFee = $request->corkageFee;
                break;
            case "Good For 8"
                $roomPrice = 800;
                $sendId = 3;
                $corkageFeeId = 4;
                $numberOfExtraPersonId = 5;
                $additionalTimeFeeId = 6;
                break;
            case "Reservation":
                $reservationfeeId = 7;
                $reservationFee = $request->reservationFee;
                $additionalPersonFee = 0;
                $roomPrice = 0;
                $sendId = 1;
                $corkageFeeId = 4;
                $numberOfExtraPersonId = 5;
                $additionalTimeFeeId = 6;
                $movies = $request->movies;
                $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
                $numberOfExtraPerson = $request->numberOfExtraPerson;
                $additionalTimeFee = $request->additionalTimeFee;
                $corkageFee = $request->corkageFee;.
                break;
            default:
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
        }




        return view('rooms.roomSales.create')->with('sendId',$sendId)
            ->with('roomId',$roomId)
            ->with('reservationFee',$reservationFee)
            ->with('reservationfeeId',$reservationfeeId)
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
