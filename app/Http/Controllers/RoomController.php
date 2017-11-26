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
class RoomController extends Controller
{



//Add category to Products , add Rooms Category to Products , 
    //Products listed in the walkin sales must !be Rooms


    public function index(Request $request)
    {
        
        $rooms = Customer::all();
        return view('rooms.index',compact('rooms'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Requests\StoreRoom $request)
    {
        $form = $request->all();

        $room = Customer::create($form);

        return redirect('asdasd')
            ->with('message-success', 'Room created!');
    }


    public function checkstatus($id){
        $sendId = $id;
        $customer = Customer::findOrFail($id);
        
        $status ='';

        if($customer->status =='Occupied'){
            $status = 'roomoccupied';
        }


        if($customer->status =='Available'){
            $status = 'askoccupy';
        }
            
        return redirect('/rooms/'.$id.'/'.$status.'/');        
    }



    public function roomoccupied($id){
        $customer = Customer::findOrFail($id);

        $find = $customer->session;

        $roomChanges = Sale::where('session',$find);
        $sendCount = Sale::where('session',$find)->count();
        $count = $sendCount-1;

        $data = [
            'sale' => Sale::where('session', $find)->get(),
        ];


        $saleItem = SaleItem::where('session', $find)
            ->sum(DB::raw('price * quantity'));

        $sale = $data['sale'];
        $sendId = $id;
        $sessionId = Sale::count() + 1;

        $counter = $data['sale']->count();         
       return view('rooms.roomoccupied')
            ->with('count',$count)
            ->with('sales',$sale)
            ->with('counter',$counter)
            ->with('saleItem',$saleItem)
            ->with('sessionId',$sessionId)
            ->with('customer',$customer)
            ->with('id',$sendId);
    }





    public function roomDetailsAndReceipt($id){
        $customer = Customer::findOrFail($id);

        $find = $customer->session;

        $roomChanges = Sale::where('session',$find);
        $sendCount = Sale::where('session',$find)->count();
        $count = $sendCount-1;
        
        $data = [
            'sale' => Sale::where('session', $find)->get(),
        ];


        $saleItem = SaleItem::where('session', $find)
            ->sum(DB::raw('price * quantity'));

        $sale = $data['sale'];
        $sendId = $id;
        
        $additionalPerson = Sale::where('session', $find)
            ->sum(DB::raw('numberOfExtraPerson'));

        $numberOfMoviesOrHour = Sale::where('session', $find)
            ->sum(DB::raw('numberOfMoviesOrHour'));

        $additionalTimeFee = Sale::where('session', $find)
            ->sum(DB::raw('additionalTimeFee'));

        $corkageFee = Sale::where('session', $find)
            ->sum(DB::raw('corkageFee'));

        $updateSessionId = $find;
        $sessionId = Sale::count() + 1;
                
       return view('rooms.roomDetailsAndReceipt')
            ->with('sales',$sale)
            ->with('count',$count)
            ->with('numberOfMoviesOrHour',$numberOfMoviesOrHour)
            ->with('additionalPerson',$additionalPerson)
            ->with('additionalTimeFee',$additionalTimeFee)
            ->with('corkageFee',$corkageFee)
            ->with('updateSessionId',$updateSessionId)
            ->with('roomchanges',$roomChanges)
            ->with('saleItem',$saleItem)
            ->with('sessionId',$sessionId)
            ->with('customer',$customer)
            ->with('id',$sendId);        
    }







    public function askoccupy($id){
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $customer = Customer::findOrFail($id);
        return view('rooms.askoccupy')
            ->with('customer',$customer)
            ->with('sessionId',$sessionId);
    }

    public function chooseaction($id)
    {    
        $sendId = $id;
        $item = Customer::find($id);
        return view('rooms.chooseaction')
        ->with('id',$sendId);
    }


    public function movieOrKtv($id)
    {
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.movieOrKtv')
        ->with('id',$sendId);        
    }




    public function ktv($id){
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.ktv')
        ->with('id',$sendId);  
    }


    public function walkin($id){
        $sendId = $id;
        $sessionId = Sale::count() + 1;
        $item = Customer::find($id);
        return view('rooms.walkin')
        ->with('id',$sendId)
        ->with('sessionId',$sessionId);
    }




    public function makeRoomAvailable(){
        
    }

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

        if($roomType == 'Good For 2' && $promoType = 'Happy Hour'){
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



        if ($roomType == 'Good For 4'){
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
        }

        if ($roomType == 'Good For 8'){
            $roomPrice = 800;
            $sendId = 3;
            $corkageFeeId = 4;
            $numberOfExtraPersonId = 5;
            $additionalTimeFeeId = 6;
        }
  
  

        return view('rooms.roomSales.create')->with('sendId',$sendId)
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



    public function additionalSale(Requests\RoomRequest $request ,$id)
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
            
            $numberOfMoviesOrHour = $request->numberOfMoviesOrHour;
            $numberOfExtraPerson = $request->numberOfExtraPerson;
            $additionalTimeFee = $request->additionalTimeFee;
            $corkageFee = $request->corkageFee;
        }

        if($roomType == 'Good For 2' && $promoType = 'Happy Hour'){
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
  
  

        return view('rooms.roomSales.additionalSale')->with('sendId',$sendId)
            ->with('roomId',$roomId)
            ->with('roomType',$roomType)->with('roomPrice',$roomPrice)
            ->with('promoType',$promoType)->with('promoPrice',$promoPrice)
            ->with('session',$session)
            ->with('startTime',$startTime) ->with('endTime',$endTime)
            ->with('numberOfExtraPerson',$numberOfExtraPerson)->with('numberOfExtraPersonId',$numberOfExtraPersonId)
            ->with('movies',$movies)->with('numberOfMoviesOrHour',$numberOfMoviesOrHour)
            ->with('additionalTimeFee',$additionalTimeFee)->with('additionalTimeFeeId',$additionalTimeFeeId)
            ->with('corkageFee',$corkageFee)->with('corkageFeeId',$corkageFeeId);
    }



    public function roomSales()
    {
       $price = 100;
       dd($price);
        // return view('rooms.roomSales.create')
        //     ->with('price',$price);
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit')
            ->with('customer',$customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests $request
     * @param int               $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateCustomer $request, $id)
    {
        $form = $request->all();

        $customer = Customer::findOrFail($id);
        $customer->update($form);

        return redirect('home')
            ->with('message-success', 'Session Ended');
    }



}
