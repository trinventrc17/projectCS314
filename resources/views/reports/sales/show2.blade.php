@extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Item Details</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Sub Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sale->items as $item)
                        @if($item->price == 0 || $item->quantity == 0)
                        @else
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td> {{ $item->quantity }}</td>
                                <td>₱ {{ number_format($item->price,2) }}</td>
                                <td>₱ {{ number_format($item->quantity * $item->price,2) }}</td>
                            </tr>
                        @endif
                    @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>₱ {{ number_format($sale->subtotal,2) }}</td>

                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Transaction Details</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Total Due</th>
                            <th>Cash</th>
                            <th>Change</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>

                                <td>₱ {{ number_format($sale->subtotal,2) }}</td>
                                <td>₱ {{ number_format($sale->comments,2) }}</td>
                                <td>₱ {{ number_format($sale->comments - $sale->subtotal,2) }}</td>
                            </tr>
                    </tbody>
            </table>
            </div>
        </div>
<div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Room Details</div>

                <table class="table">


                    <thead>
                        <tr>
                            <th>Sales Date</th>
                            <th>Cashier</th>
                            <th>Session Number</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $sale->created_at->format('F d, Y (H:i)') }}</td>
                                <td>{{ $sale->cashier['name'] }}</td>
                                <td>{{ $sale->session }}</td>
                            </tr>
                    </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
