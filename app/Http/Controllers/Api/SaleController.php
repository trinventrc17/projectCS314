<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sale;
use Illuminate\Http\Request;
use Validator;
use App\Expenses;
use App\Customer;
use Carbon\Carbon;

class SaleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $request->all();

        // inject current cashier id
        $form['cashier_id'] = $request->user()->id;
        $rules = Sale::$rules;
        // $rules['items'] = 'required';

        $validator = Validator::make($form, $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 400);
        }


        $gg = $request->todayOrTomorrow;



      if($request->todayOrTomorrow == 'Tomorrow'){
        $receivedEndTime = substr($request->endTime, 0,05);
        $formattedEndTime = Carbon::tomorrow()->format('Y-m-d');
        $savedEndTime = $formattedEndTime . ' ' . $receivedEndTime;


        $receivedStartTime = substr($request->startTime, 0,05);
        $formattedStartTime = Carbon::now()->format('Y-m-d');
        $savedStartTime = $formattedStartTime . ' ' . $receivedStartTime;      
      }

      else{
        $receivedEndTime = substr($request->endTime, 0,05);
        $formattedEndTime = Carbon::now()->format('Y-m-d');
        $savedEndTime = $formattedEndTime . ' ' . $receivedEndTime;


        $receivedStartTime = substr($request->startTime, 0,05);
        $formattedStartTime = Carbon::now()->format('Y-m-d');
        $savedStartTime = $formattedStartTime . ' ' . $receivedStartTime;     
      }






        $roomSave = Customer::find($request->customer_id);
        $roomSave->endTime = $savedEndTime; 
        $roomSave->startTime = $savedStartTime;
        $roomSave->save();



        $expenses = Expenses::create([
            'amount' => 0,
            'purpose' => 'Daily Trackings',
            'person' => 'Daily Trackings',
            'issued' => 'Daily Trackings',
            ]);
        
        $sale = Sale::createAll($form);

        return response()->json($sale, 201);
    }
}
