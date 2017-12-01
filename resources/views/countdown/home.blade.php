@extends('layouts.home')
 
@section('content')





<div class="container">
        <div class="row">
            <div class="col-md-9">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">List of Rooms

                    </div>

                    <div class="panel-body">

                  @foreach ($rooms as $key => $room)
                  <a href="{{ url('rooms/' . $room->id . '/checkstatus') }}">         
                    <div class="col-md-4"> <!-- start-col -->
                        @if($room->status == 'Available')            
                        <div class="well" id = "well2" style="background-color:pink">
                        @else
                        <div class="well" id = "well1" style="background-color:yellow">
                        @endif
                                <p style="color:black">{{$room->name}}</p>
                                <li style="color:black">{{$room->status}}</li>
                             <br>
                        </div> <!-- end-well -->
                    </div> <!-- end-col -->
                    </a>

                @endforeach


                    </div>
                </div>

            </div>


  <div class="col-md-3">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Room Time

                    </div>

                    <div class="panel-body">

                  @foreach ($rooms as $key => $room)


                                
                                

                                  @if($room->endTime <= \Carbon\Carbon::now())
                                  {{$room->name}}:
                                  <p style="color: red" align="right">
                                       Session has Expired
                                  </p>
                                  @else
                                    {{$room->name}} :
                                    <p align="right">  
                                     <span id="clock" data-countdown="{{$room->endTime}}"></span>
                                     
                                    </p>
                                  @endif



                                
                @endforeach


                    </div>
                </div>

            </div>




        </div>
    </div>

  <script type="text/javascript">

  $('[data-countdown]').each(function() {
    var $this = $(this), finalDate = $(this).data('countdown');


    $this.countdown(finalDate, function(event) {
      $this.html(event.strftime('%H:%M:%S'));
    
    }).on('finish.countdown', function(event) {
    $this.html(event.strftime('Session has expired'))
    $this.css('color', 'red')
    $('#well2').css("color", "red")
      .parent().addClass('disabled');
  });



  });

  $('#clock').countdown('[data-countdown]')
  .on('update.countdown', function(event) {
    var format = '%H:%M:%S';
    if(event.offset.totalDays > 0) {
      format = '%-d day%!d ' + format;
    }
    if(event.offset.weeks > 0) {
      format = '%-w week%!w ' + format;
    }
    $(this).html(event.strftime(format));
  })
  .on('finish.countdown', function(event) {
    $(this).html('Session has expired')
      .parent().addClass('disabled');
  })
      
  </script>
@endsection

