@extends('layouts.transaction')




@section('content')
    <additionalsale :price= "[
        {roomType : '{{$roomType}}' ,
        roomPrice: {{$roomPrice}},
        promoType: '{{$promoType}}',
        promoPrice: {{$promoPrice}},
        roomId : {{$roomId}},
        session:{{$session}},
        sendId:{{$sendId}},
        startTime:'{{$startTime}}',
        endTime: '{{$endTime}}' ,
        movies: '{{$movies}}' ,
        numberOfMoviesOrHour:{{$numberOfMoviesOrHour}},
        additionalTimeFee:{{$additionalTimeFee}},
        corkageFee:{{$corkageFee}},
        numberOfExtraPerson: {{$numberOfExtraPerson}},
        corkageFeeId:{{$corkageFeeId}},
        numberOfExtraPersonId: {{$numberOfExtraPersonId}},
        additionalTimeFeeId : {{$additionalTimeFeeId}}



        }]"></additionalsale>
@endsection