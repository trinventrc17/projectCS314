
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Earnings and Expenses Summary</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Earnings</th>
                            <th>Expenses</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($earnings))
                        @forelse($earnings as $earning)
                                <tr>

                                    <td>{{ \Carbon\Carbon::parse($earning->day)->format('M d, Y')}}</td>
                                    <td>₱ {{ $earning->total }}</td>
                                    <td>
                                    @foreach ($expenses as $key => $expense)
                                        @if($expense->day == $earning->day)
                                            {{$expense->total}}
                                        @else
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>
                                    @php ($i = 0)
                                    @php ($j = 0)
                                    @foreach ($expenses as $key => $expense)
                                        @if($expense->day == $earning->day)
                                            @php ($i = $key)
                                            @php ($j = $expense->total)
                                            @break
                                        @else
                                            @php ($i = $key)
                                            @php($j=0)
                                        @endif
                                    @endforeach
                                            {{$earnings[$i]->total - $j}}
                                    </td>
                                </tr>
                        
                        @empty
                                <tr>
                                    <td>--------------------</td>
                                    <td>--------------------</td>
                                </tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
                <div class="panel-footer" style="text-align: right;">

                </div> 
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Summary Report</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Today</th>
                            <th>This Week</th>
                            <th>This Month</th>
                            <th>This Year</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            <td>₱ {{$dailyEarnings}}</td>
                            <td>₱ {{$weeklyEarnings}}</td>
                            <td>₱ {{$monthlyEarnings}}</td>
                            <td>₱ {{$yearlyEarnings}}</td>
                            <td>₱ {{$totalEarnings}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Simple Filter</div>
                    <form action="{{ url('/productsReport/earningsSearched') }}" method="GET">
                        <div class="form-group">
                        {!! Form::select('date_range', array('Select Filter' => 'Select Filter','Today' => 'Today', 'This Week' => 'This Week','This Month' => 'This Month',), '',['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </form>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">Customized Filter</div>
                    <form action="{{ url('/productsReport/earningsSearched') }}" method="GET">
                    {{ csrf_field() }}
                        <div class="form-group">
                        {!! Form::input('date', 'date_range', null, ['class' => 'datepicker', 'data-date-format' => 'dd/mm/yy']) !!}
                        </div>
                        <div class="form-group">
                            <button type="submit" align="right" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>


@endsection

