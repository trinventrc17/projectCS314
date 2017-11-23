@extends('layouts.app')

@section('assets')
 <link href="{{ asset('css/site.css') }}" rel="stylesheet" type="text/css" >
@endsection


@section('content')
<div class="container">
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>

    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Sales Report</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $key => $sale)
                                @foreach($sale->items as $item)
                                    @if($item->product->id == 'Additional Payment')
                                    @else
                                    <tr>
                                        <td>{{ $sale->created_at->format('F d, Y') }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->category }}</td>
                                        <td>{{ $item->product->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->quantity * $item->product->price }}</td>
                                    @endif
                                    </tr>
                                @endforeach

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Sales Report</div>

                <div class="panel-body">
                    <form action="{{ url('reports/sales') }}" method="GET">
                        <div class="form-group">
                            <label for="price">Date Range</label>
                            <select class="form-control" id="date-range" name="date_range">
                                <option>-- Select Date Range --</option>
                                <option value="today" {{ ($input['date_range'] == 'today') ? 'selected="selected"' : '' }}>Today</option>
                                <option value="current_week" {{ ($input['date_range'] == 'current_week') ? 'selected="selected"' : '' }}>This Week</option>
                                <option value="current_month" {{ ($input['date_range'] == 'current_month') ? 'selected="selected"' : '' }}>This Month</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection