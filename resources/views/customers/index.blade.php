@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rooms
                    <div class="pull-right">
                        <a href="{{ url('posrooms/create') }}" class="btn btn-primary btn-xs">Add new Room</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($customers as $key => $customer)
                        <tr>
                            <td>{{ $customers->firstItem() + $key }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>
                                <form id="delete-customer" action="{{ url('posrooms/' . $customer->id) }}" method="POST" class="form-inline">
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}
                                
                                @if(Auth::user()->role_id != 1)
                                @else    
                                    <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                                @endif

                                </form>
                                @if(Auth::user()->role_id != 1)
                                @else
                                <a href="{{ url('posrooms/' . $customer->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        @include('partials.table-blank-slate', ['colspan' => 5])
                    @endforelse
                    </tbody>
                </table>

                <div class="panel-footer" style="text-align: right;">
                    {{ $customers->links() }}
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection