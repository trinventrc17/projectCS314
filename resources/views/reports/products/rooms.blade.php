@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Rooms Report</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Promo Name</th>
                            <th>Promo Price</th>
                            <th>Times Sold</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                            <tr>
                                @if($product->name == 'Additional Payment' || $product->name == 'Corkage Fee' || $product->name == 'Additional Person' || $product->name == 'Additional Movie Fee')
                                @else
                                <td>{{ $product->name }}</td>
                                <td>₱ {{ number_format($product->price,2) }}</td>
                                <td>{{ $product->sold }}</td>
                                <td>₱ {{ number_format($product->sold * ($product->price),2) }}</td>
                                @endif
                            </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="panel-footer" style="text-align: right;">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Total Product Earnings</div>

                <div class="panel-body">
                <H1 align="center"> ₱{{$totalEarnings}}</H1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

