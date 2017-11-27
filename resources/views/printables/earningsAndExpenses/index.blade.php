    @extends('layouts.app')

@section('content')
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
                                    <td>₱ {{ $earning->total }}</td>
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
                        {!! Form::label('Date Range','Date Range') !!}
                        {!! Form::input('date', 'date_range', null, ['class' => 'datepicker', 'data-date-format' => 'dd/mm/yy']) !!}

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Earnings Summary</div>

                <div class="panel-body">

                <table>
                    <tr>
                        <td colspan=""><strong>Day-------------------------</strong></td>
                        <td align="right">₱ {{$dailyEarnings}}</td>
                    </tr>
                    <tr>
                        <td colspan=""><strong>Week-------------------------</strong></td>
                        <td align="right">₱ {{$dailyEarnings}}</td>
                    </tr>
                    <tr>
                        <td colspan=""><strong>Month-------------------------</strong></td>
                        <td align="right">₱ {{$weeklyEarnings}}</td>
                    </tr>
                    <tr>
                        <td colspan=""><strong>Year-------------------------</strong></td>
                        <td align="right">₱ {{$yearlyEarnings}}</td>
                    </tr>
                    <tr>
                        <td colspan=""><strong>Total-------------------------</strong></td>
                        <td align="right">₱ {{$totalEarnings}}</td>
                    </tr>
                </table>

                </div>
            </div>
        </div>


    </div>
</div>
@endsection