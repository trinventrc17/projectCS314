@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

<div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Room Sales</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th></th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($sales as $key => $sale)

                                @foreach($sale->items as $item)
                                    @if($item->product->name == 'Additional Payment' || $item->price == 0 || $item->quantity == 0 )
                                    @else
                                    <tr>
                                        <td>
                                        <form id="delete-sale" action="{{ url('suppliers/' . $item->id) }}" method="POST" class="form-inline">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="type" value="all">
                                            @if(Auth::user()->role_id !=1)
                                            @else
                                            <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                                            @endif
                                        </form>
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>₱ {{ number_format($item->price,2) }}</td>
                                        <td>
                                        
                                        @if($item->quantity > 1)
                                        <form id="delete-sale" action="{{ url('suppliers/' . $item->id) }}" method="POST" class="form-inline">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="type" value="reduce">
                                            @if(Auth::user()->role_id !=1)
                                            @else
                                            <input type="submit" value="-" class="btn btn-danger btn-xs pull-right btn-delete">
                                            @endif
                                        </form>
                                        </td>
                                        @else
                                        @endif
                                        <td>
                                        {{ $item->quantity }}
                                        </td>
                                        <td>₱ {{ number_format($item->quantity * $item->price,2) }}</td>
                                    @endif
                                    </tr>
                                @endforeach

                        @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                        <td>₱ {{$saleItem}}</td>
                                    </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Room Details - <strong>({{$sales[0]->roomType}})</strong></div>

                <div class="panel-body">
                <br>
                <div><strong>Promo Type</strong><p class="pull-right">{{$sales[0]->promoType}}</p></div>
                <br>
                <div> <strong>Movie/s ({{$numberOfMoviesOrHour}}) or KTV</strong><p class="pull-right">
                @foreach($sales as $sale)
                    @if($sale->movies == 'None')
                    @else
                        {{$sale->movies}},
                    @endif
                @endforeach

                </p></div>
                <br>

                <div><strong>Time</strong><p class="pull-right">{{$startTime}} to {{$endTime}}</p></div>
                <br>
                <div><strong>Additional Person</strong><p class="pull-right">{{$additionalPerson}}</p></div>
                <br>
                <div><strong>Additional Time Fee</strong><p class="pull-right">₱ {{ number_format($additionalTimeFee,2) }}</p></div>
                <br>
                <div><strong>Corkage Fee</strong><p class="pull-right">₱ {{ number_format($corkageFee,2) }}</p></div>

                </div>
            </div>
        </div>



        <div class="col-md-2">
            <div class="panel panel-default">
                    <div class="panel-body">                
                    <br><br>
                    
                    <form action="{{ url('roomchanges/'.$customer->id.'/updateRoom') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="startTime" name="startTime" value="{{$sales[$count]->startTime}}">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="roomType" name="roomType" value="{{$sales[0]->roomType}}">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="endTime" name="endTime" value="{{$sales[$count]->endTime}}">
                       </div>


                        <div class="form-group">
                            <input type="hidden" class="form-control" id="updateSessionId" name="updateSessionId" value="{{$updateSessionId}}">
                       </div>

                       <div align="center" >
                            <button type="submit" class="btn btn-primary" >Update Room</button>
                       </div>
                    </form>
                    <br><br>
                    </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel panel-default">
                    <div class="panel-body">                
                    <br><br>
                    <form action="{{ url('rooms/' . $customer->id) }}" method="POST">
                        <input type="hidden" name="_method" value="put">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status" name="status" value="Available">
                       </div>
    
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="session" name="session" value="{{$sessionId}}">
                       </div>

                       <div align="center" >
                            <button type="submit" class="btn btn-primary" >End Session</button>
                       </div>
                    </form>
                    <br><br>
                    </div>
            </div>
        </div>

        



<!--         <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Total</center></div>
                    <center>
                    <h2>₱ {{$saleItem}}</h2>
                    </center>
            </div>
        </div> -->




    </div>

</div>
@endsection