@extends('layouts.home')

@section('content')
<form action="{{ url('/CountDownTimer/save') }}" method="POST">
            {{ csrf_field() }}
<div class="container" style="margin-top: 20px">
    <div style="position: relative">
	
	<select id="state" name="today" class="pull-right"> 
		<option value="Today">Today</option>
		<option value="Tomorrow">Tomorrow</option>
	</select>
        
        <input style="width:20%" class="form-control" type="text" id="time" name="dateTime" />
    </div>


<button type="submit" class="btn btn-primary">Next</button>
</div>
</form>
<script>
    $('#time').datetimepicker({
        format: 'HH:mm A'
    });
</script>
@endsection

