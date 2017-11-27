@extends('layouts.transaction')




@section('content')
    <walkinSales :price= "[
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
        additionalTimeFeeId : {{$additionalTimeFeeId}},
        additionalPersonFee : {{$additionalPersonFee}},
        reservationfee : {{$reservationFee}},
        reservationfeeId : {{$reservationfeeId}},
        discountFee : {{$discountFee}},
        discountFeeId : {{$discountFeeId}},
        }]"></walkinSales>
@endsection