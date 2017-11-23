@extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Sales Report</div>
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
                    @if (!empty($sales))
                        @forelse ($sales as $key => $sale)
                            @foreach($sale->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->capitalPrice }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->price - $item->pproduct->capitalPrice}}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->quantity * $item->price }}</td>

                            </tr>
                            @endforeach
                        @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                        @endforelse
                    @endif
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