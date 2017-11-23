@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">What do you want to do?</div>

                <div class="panel-body">
                    <form action="{{ url('customers/' . $customer->id) }}" method="POST">
                        <input type="hidden" name="_method" value="put">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status" name="status" value="Available">
                       </div>
    
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="session" name="session" value="{{$sessionId}}">
                       </div>

                       <div align="center">
                            <button type="submit" class="btn btn-primary" style="width:70%">Make this room Available</button>
                       </div>
                    </form>
                    <br>


                    <form action="{{ url('rooms/'.$id.'/walkinsales') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="roomType" name="roomType" value="None">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="promoType" name="promoType" value="None">
                       </div>

                        <div>
                            <div align="center" >
                                <button type="submit" class="btn btn-primary" style="width:70%">Add another purchase in this room</button>
                            </div>
                        </div>

                    </form>

                    <br>
     

                    <div align="center" >
                        <a href="{{ url('home') }}"><button type="submit" class="btn btn-primary" style="width:70%">Nothing,Take me back!</button></a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contaner">

                    @if (!empty($sales))
                        @forelse ($sales as $key => $sale)

                                {{ $sale->cashier['name']}}
                                {{ $sale->roomType }}
                                {{ $sale->promoType }}
                                {{ $sale->created_at->format('d F Y') }}
                        @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                        @endforelse
                    @endif

</div>

@endsection