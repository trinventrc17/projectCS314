
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Total</div>
                    <div align="center">
                        <h1>₱ {{$totalEarnings}}</h1>
                    </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Earnings Summary</div>
                    <div align="center">
                        <div>Today: ₱ {{$dailyEarnings}}</div>
                        <div>This Week: ₱ {{$weeklyEarnings}}</div>
                        <div>This Month : ₱{{$monthlyEarnings}}</div>
                        <div>This Year : ₱{{$yearlyEarnings}}</div>
                    </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Earnings Report</div>
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
                    {{ $earnings->links() }}
                </div> 
            </div>
        </div>

    </div>
</div>


@endsection

