@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Stocks - Create</div>

                <div class="panel-body">


                        <div class="form-group" align="center">
							<a href="{{ url('stocks/create') }}" class="btn btn-primary btn-sm">Add New Product</a>
                        </div>

                        <div class="form-group" align="center">
							<a href="{{ url('stocks/addFromExisting/addFromExisting') }}" class="btn btn-primary btn-sm">Add From Existing</a>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection