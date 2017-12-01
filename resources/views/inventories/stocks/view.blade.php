@extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Items Remaining</th>
                            <th>Items Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                            <tr>
                                @if($sale->name == 'Additional Payment' || $sale->name == 'Corkage Fee' || $sale->name == 'Additional Person' || $sale->name == 'Additional Movie Fee')
                                @else
                                <td>{{ $sale->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->sold }}</td>
                                @endif
                            </tr>
                    @endforeach
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
                    <form action="{{ url('/stocks/index/products/productsDefaultFilter') }}" method="GET">
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
                    <form action="{{ url('/stocks/index/products/productsCustomizedFilter') }}" method="GET">
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