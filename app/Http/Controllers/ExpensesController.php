<?php

namespace App\Http\Controllers;

use App\Expenses;
use App\Http\Requests;


class ExpensesController extends Controller
{
    public function index()
    {
        $data = [
            'expenses' => Expenses::paginate(),
        ];

        return view('expenses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreExpenses $request)
    {
        $form = $request->all();

        $customer = Expenses::create($form);

        return redirect('expenses')
            ->with('message-success', 'Expenses created!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Expenses::findOrFail($id);

        return view('expenses.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Expenses::findOrFail($id);

        return view('expenses.edit')
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
    public function update(Requests\UpdateExpenses $request, $id)
    {
        $form = $request->all();

        $customer = Customer::findOrFail($id);
        $customer->Expenses($form);

        return redirect('/rooms/'.$id.'/chooseaction/')
            ->with('message-success', 'Room updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */


    public function action($id , $action){

        $customer = Expenses::findOrFail($id);
        $nextAction = $action;


        dd($nextAction);


    }


    public function destroy($id)
    {
        $customer = Expenses::findOrFail($id);
        $customer->delete();

        return redirect('posrooms')
            ->with('message-success', 'Room deleted!');
    }
}
