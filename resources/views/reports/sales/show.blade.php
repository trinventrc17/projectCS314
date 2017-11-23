@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading">Details</div>

                    <div class="panel-body">
                    <div>Date: {{ $sale->created_at->format('d F Y H:i') }}</div>
                    <div>Cashier : {{ $sale->cashier['name'] }}</div>
                    <div>Session Number : {{ $sale->session }}</div>
                    <div>Room Name : {{ $sale->customer['name'] }}</div>
                    <br>


                    @if($sale->roomType == 'None')
                    @else
                    <div><strong>Room Details</strong></div>
                    <div>Room Type : {{ $sale->roomType}}</div>
                    <div>Price: {{ $sale->roomPrice }}</div>
                    <div>Promo Type : {{ $sale->promoType}}</div>
                    <div>Price: {{ $sale->promoPrice }}</div>
                    <br>
                    @endif
                    <div><strong>ITEMS SOLD</strong></div>
                     @foreach($sale->items as $item)
                        @if($item->product->name == 'Additional Payment')
                        @else
                            <div>Product/Service : {{ $item->product->name }} x {{ $item->quantity }}</div>
                            <div>Price : {{ $item->price }}</div>
                            <div>SubCost: {{ $item->quantity * $item->price }}</div>
                            <br>
                        @endif
                    @endforeach                   
                        <div>Total Due : {{ ($sale->subtotal)}}</div>
                        <div>Cash : {{ $sale->comments}}</div>
                        <div>Change : {{ $sale->comments - $sale->subtotal}}</div>


                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection