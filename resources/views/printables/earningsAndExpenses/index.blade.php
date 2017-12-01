    @extends('layouts.app')

@section('content')

<div class="container">
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Earnings Summary</div>

                <div class="panel-body">

           <table class="table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Week</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td> ₱ {{ number_format($dailyEarnings,2) }}</td>
                        <td> ₱ {{ number_format($weeklyEarnings,2) }}</td>
                        <td> ₱ {{ number_format($monthlyEarnings,2) }}</td>
                        <td> ₱ {{ number_format($yearlyEarnings,2) }}</td>
                        <td> ₱ {{ number_format($totalEarnings,2) }}</td>                    
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>



</div>




<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Note : <strong>This is an Exportable File ,Click Export to Export to Excel</strong>

                    <div class="pull-right">

                        <form action="{{ url('/printables/index/earningsAndExpenses/earningsAndExpensesExcelPrintable') }}" method="GET">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" id="date_query" name="date_query" value="{{$date_query}}">
                        <input type="hidden" class="form-control" id="date_query" name="date_query2" value="{{$date_query2}}">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Export</button>
                            </div>
                        </form>

                    </div>

                </div>
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
                                    <td>₱ {{ number_format($earning->total,2) }}</td>
                                    <td>
                                    @foreach ($expenses as $key => $expense)
                                        @if($expense->day == $earning->day)
                                        ₱ {{ number_format($expense->total,2) }}
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
                                            ₱ {{ number_format($earnings[$i]->total - $j,2) }}
                                    </td>
                                </tr>
                        
                        @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                        @endforelse
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>₱ {{ number_format($saleTotal,2) }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="panel-footer" style="text-align: right; height: 50px">
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Simple Filter</div>

                <div class="panel-body">
                    <form action="{{ url('/printables/index/earningsAndExpenses/earningsAndExpensesDefaultFilter') }}" method="GET">
                        <div class="form-group">
                        {!! Form::label('Date Range','Date Range') !!}
                        {!! Form::select('date_range', array('Select Filter' => 'Select Filter','Today' => 'Today', 'This Week' => 'This Week','This Month' => 'This Month',), '',['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Customized Filter</div>

                <div class="panel-body">
                    <form action="{{ url('/printables/index/earningsAndExpenses/earningsAndExpensesCustomizedFilter') }}" method="GET">
                    {{ csrf_field() }}
                        <div class="form-group">
                        {!! Form::label('Date Range','Date From:') !!}
                        {!! Form::input('date', 'date_range', null, ['class' => 'datepicker pull-right', 'data-date-format' => 'dd/mm/yy']) !!}
                        </div>
                        
                        
                        <div class="form-group" class="pull-right">
                        {!! Form::label('Date Range','Date To:') !!}
                        {!! Form::input('date', 'date_range2', null, ['class' => 'datepicker pull-right', 'data-date-format' => 'dd/mm/yy']) !!}
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