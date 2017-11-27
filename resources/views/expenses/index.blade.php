@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Expenses
                    <div class="pull-right">
                        <a href="{{ url('expenses/create') }}" class="btn btn-primary btn-xs">Add new Expense</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Issued By</th>
                            <th>Issued To</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($expenses as $key => $expense)
                        <tr>
                            <td>₱ {{ number_format($expense->amount,2) }}</td>
                            <td>{{ $expense->purpose }}</td>
                             <td>{{ $expense->issued }}</td>
                            <td>{{ $expense->person }}</td>
                            <td>{{ $expense->created_at }}</td>
                        </tr>
                    @empty
                        @include('partials.table-blank-slate', ['colspan' => 5])
                    @endforelse
                    </tbody>
                </table>

                <div class="panel-footer" style="text-align: right;">
                    {{ $expenses->links() }}
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection