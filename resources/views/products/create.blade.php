@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Products - Create</div>

                <div class="panel-body">
                    <form action="{{ url('products') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="price">Capital Price (per Item) </label>
                            <input type="text" class="form-control" id="capitalPrice" name="capitalPrice" value="{{ old('capitalPrice') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Selling Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Category</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-link" href="{{ url('products') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection