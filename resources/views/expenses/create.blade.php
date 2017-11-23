@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Expenses - Create</div>

                <div class="panel-body">
                    <form action="{{ url('expenses') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Purpose</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" value="{{ old('purpose') }}">
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-link" href="{{ url('expenses') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection