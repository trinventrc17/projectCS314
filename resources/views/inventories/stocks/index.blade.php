@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Products
                    <div class="pull-right">

                        <a href="{{ url('/stocks/ask/ask') }}" class="btn btn-primary btn-xs">Add Items To Stock</a>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="GET">
                        <div class="form-group" style="margin:0">
                            <div class="input-group">
                                @if(!empty($keyword))
                                <span class="input-group-btn">
                                    <a href="{{ url('stocks') }}" class="btn btn-primary">Clear</a>
                                </span>
                                @endif
                                <input type="text" name="q" class="form-control" value="{{ $keyword }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="submit">Search</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Items Added</th>
                            <th>Added By</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($stocks as $key => $stock)
                        <tr>

                            <td>{{ $stock->name }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->added_by }}</td>
                            <td>{{ $stock->created_at->format('M d, Y (g:i A)') }}</td>
                        </tr>
                    @empty
                        @include('partials.table-blank-slate', ['colspan' => 4])
                    @endforelse
                    </tbody>
                </table>

                <div class="panel-footer" style="text-align: right;">
                    {{ $stocks->links() }}
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection