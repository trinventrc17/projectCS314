<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sale;
use Illuminate\Http\Request;
use Validator;
use App\Expenses;
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

        $expenses = Expenses::create([
            'amount' => 0,
            'purpose' => 'Daily Trackings',
            ]);
        $sale = Sale::createAll($form);

        return response()->json($sale, 201);
    }
}
