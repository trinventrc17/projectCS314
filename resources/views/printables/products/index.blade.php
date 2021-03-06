@extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
            <div class="col-md-4 col-md-offset-8">
            <div class="panel panel-default">
                <div class="panel-heading">Total Sales</div>

                <div class="panel-body">
                  ₱ {{ number_format($saleTotal,2) }}
                </div>
            </div>
        </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Note : <strong>This is an Exportable File ,Click Export to Export to Excel</strong>

                    <div class="pull-right">

                    <div class="pull-right">

                        <form action="{{ url('/printables/index/products/productsExcelPrintable') }}" method="GET">
                        {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="date_query" name="date_query" value="{{$date_query}}">
                            <input type="hidden" class="form-control" id="date_query" name="date_query2" value="{{$date_query2}}">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Export</button>
                            </div>
                        </form>

                    </div>

                    </div>

                </div>
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
                    @foreach($sales as $sale)
                            <tr>
                                @if($sale->name == 'Additional Payment' || $sale->name == 'Corkage Fee' || $sale->name == 'Additional Person' || $sale->name == 'Additional Movie Fee')
                                @else
                                <td>{{ $sale->name }}</td>
                                @if($sale->capitalPrice == 0)
                                <td>Not Assigned</td>
                                @else
                                <td>₱ {{ number_format($sale->capitalPrice,2) }}</td>
                                @endif
                                <td>₱ {{ number_format($sale->price,2) }}</td>
                                <td>₱ {{ number_format($sale->price - $sale->capitalPrice,2) }}</td>
                                <td>{{ $sale->sold }}</td>

                                <td>₱ {{ number_format($sale->sold * ($sale->price - $sale->capitalPrice),2) }}</td>
                                @endif
                            </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>₱ {{ number_format($saleTotal,2) }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="panel-footer" style="text-align: right; height: 70px">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Simple Filter</div>

                <div class="panel-body">
                    <form action="{{ url('/printables/index/products/productsDefaultFilter') }}" method="GET">
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
                    <form action="{{ url('/printables/index/products/productsCustomizedFilter') }}" method="GET">
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