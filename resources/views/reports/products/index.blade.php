@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Products Report</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Capital Per Item</th>
                            <th>Price Per Item</th>
                            <th>Income Per Item</th>
                            <th>Items Sold</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                            <tr>
                                @if($product->name == 'Additional Payment' || $product->name == 'Corkage Fee' || $product->name == 'Additional Person' || $product->name == 'Additional Movie Fee')
                                @else
                                <td>{{ $product->name }}</td>
                                @if($product->capitalPrice == 0)
                                <td>Not Assigned</td>
                                @else
                                <td>₱ {{ number_format($product->capitalPrice,2) }}</td>
                                @endif
                                <td>₱ {{ number_format($product->price,2) }}</td>
                                <td>₱ {{ number_format($product->price - $product->capitalPrice,2) }}</td>
                                <td>{{ $product->sold }}</td>

                                <td>₱ {{ number_format($product->sold * ($product->price - $product->capitalPrice),2) }}</td>
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