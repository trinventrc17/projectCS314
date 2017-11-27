    @extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Note : <strong>This is an Exportable File ,Click Export to Export to Excel</strong>

                    <div class="pull-right">

                        <form action="{{ url('/printables/index/sales/salesExcelPrintable') }}" method="GET">
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
                            <th>Ses. # </th>
                            <th>Room </th>
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
                    @if (!empty($sales))
                        @forelse($sales as $sale)
                            @if($sale->product->name == 'Additional Payment' || $sale->price == 0 || $sale->quantity == 0)
                            @else
                            <tr>
                                <td>{{ $sale->session }}</td>
                                <td>{{ $sale->sale->customer['name'] }}</td>
                                <td>{{ $sale->created_at->format('M. d, Y (g:ia)') }}</td>
                                <td>{{ $sale->product->name }}</td>
                                <td>{{ $sale->product->category }}</td>
                                <td> ₱ {{ number_format($sale->price,2) }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>₱ {{ number_format($sale->quantity * $sale->price,2) }}</td>

                            </tr>
                            @endif
                    @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                    @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> ₱ {{ number_format($saleTotal,2) }}</td>
                            </tr>
                    @endif
                    </tbody>
                </table>
                <div class="panel-footer" style="text-align: right; height: 50px">
                    {{$sales->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Simple Filter</div>

                <div class="panel-body">
                    <form action="{{ url('/printables/index/sales/salesDefaultFilter') }}" method="GET">
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
                <div class="panel-heading">Simple Filter</div>

                <div class="panel-body">
                    <form action="{{ url('/printables/index/sales/salesCustomizedFilter') }}" method="GET">
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

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Total Sales</div>

                <div class="panel-body">
                   ₱ {{ number_format($saleTotal,2) }}
                </div>
            </div>
        </div>


    </div>
</div>
@endsection