@extends('layouts.app')
 
@section('content')

    <div class="container">



   

        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    
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

                       <div class="pull-right" style="margin-right:3%">
                            <button type="submit" class="btn btn-primary" >End Session</button>
                       </div>
                    </form>

                    <div class="panel-heading">Room Details



                    </div>

                    <div class="panel-body">


                    <div>{{$sales[0]->roomType}}</div>
                    <div>{{$sales[0]->roomPrice}}</div>
                    <div>{{$sales[0]->promoType}}</div>
                    <div>{{$sales[0]->promoPrice}}</div>
                    
                    <br>
                    Additional Orders
                        @foreach ($sales as $key => $sale)
                                @foreach($sale->items as $item)
                                    @if($item->product->id == 82836482)
                                    @else
                                        <div>{{ $item->product->name }}</div>
                                        <div>{{ $item->quantity }} x {{ $item->price }}</div>
                                        <div>{{ $item->quantity * $item->price }}</div>
                                        <br>
                                    @endif
                                @endforeach
                        @endforeach
                        Total : {{($sales[0]->promoPrice + $sales[0]->roomPrice) + $saleItem}}
                    </div>



                </div>

            </div>
        </div>




    </div>



@endsection