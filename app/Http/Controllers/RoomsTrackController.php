<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

use App\Http\Requests\RoomsTrackRequest;

class RoomsTrackController extends Controller
{

 public function index(Request $request)
    {
        $customers = Customer::all();
        return view('RoomsTrack.index',compact('customers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('RoomsTrack.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);

        RoomsTrack::create($request->all());
        return redirect()->route('RoomsTrack.index')
                        ->with('success','Rooms created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $item = RoomsTrack::find($id);
        return view('RoomsTrack.show',compact('item'));
    }


    public function chooseAction($id)
    {    
        $sendId = $id;
        $item = Customer::find($id);
        return view('RoomsTrack.chooseAction')
        ->with('sendId',$sendId);
    }

    public function actionChosen($id,$chosen)
    {    
        $kill = $chosen;
        dd($chosen);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = RoomsTrack::find($id);
        return view('RoomsTrack.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);

        RoomsTrack::find($id)->update($request->all());
        return redirect()->route('RoomsTrack.index')
                        ->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoomsTrack::find($id)->delete();
        return redirect()->route('RoomsTrack.index')
                        ->with('success','Item deleted successfully');
    }
}
