@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Room Details</div>

                <div class="panel-body">
                <div><strong>Movie(s)</strong></div>
                {{$sales[0]->movies}}
                <div><strong>Start Time</strong></div>
                {{$sales[0]->startTime}}
                <div><strong>Movies</strong></div>
                {{$sales[0]->endTime}}
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Room Sales</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($sales as $key => $sale)

                                @foreach($sale->items as $item)
                                    @if($item->product->name == 'Additional Payment')
                                    @else
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->quantity * $item->price }}</td>
                                    @endif
                                    </tr>
                                @endforeach

                        @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$saleItem}}</td>
                                    </tr>

                    </tbody>
                </table>
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

        <div class="col-md-3">
            <div class="panel panel-default">
                    <div class="panel-body">                
                    
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
                    </div>
            </div>
        </div>


    </div>

</div>
@endsection