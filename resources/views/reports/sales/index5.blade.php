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
                            <th>Cashier</th>
                            <th>Session Number</th>
                            <th>Room Name</th>
                            <th>Sales Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($sales))
                        @forelse ($sales as $key => $sale)
                            @if($sale->additionalTimeFee == 0 && $sale->corkageFee == 0 && $sale->corkageFee == 0 && $sale->numberOfExtraPerson == 0 && $sale->numberOfMoviesOrHour == 0)
                            @else
                            <tr>
                                <td>{{ $sale->cashier->name }}</td>
                                <td>{{ $sale->customer->session }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->created_at->format('F d, Y (H:i)') }}</td>
                                <td>
                                    <a href="{{ url('reports/sales/' . $sale->id) }}" class="btn btn-primary btn-xs pull-right">Show</a>
                                </td>
                            </tr>
                            @endif
                        @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                        @endforelse
                    @endif
                    </tbody>
                </table>
                <div class="panel-footer" style="text-align: right; height: 50px">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Today's Earnings</div>

                <div class="panel-body">
                <H1 align="center"> ₱{{$earnings}}</H1>
                </div>
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