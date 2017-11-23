<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'customers' => Customer::paginate(),
        ];

        return view('customers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreCustomer $request)
    {
        $form = $request->all();

        $customer = Customer::create($form);

        return redirect('posrooms')
            ->with('message-success', 'Room created!');
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
        $customer = Customer::findOrFail($id);

        return view('customers.show', compact('customer'));
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

        $customer = Customer::findOrFail($id);
        $nextAction = $action;


        dd($nextAction);


    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('posrooms')
            ->with('message-success', 'Room deleted!');
    }
}
