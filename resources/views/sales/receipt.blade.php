<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body onload="window.print()">  <!-- change to <body onload="window.print()"> for automatic printing -->
    <table>
        <tr>
            <td colspan= "3" align="center"><strong>GOOD TIMES</strong></td>
        </tr>
        <tr>
            <td colspan="3" align="center">MOVIE LOUNGE & KTV</td>
        </tr>
        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">{{ $sale->created_at->format('F d, Y (H:i)') }}</td>
            <td align="right">{{ $sale->cashier['name'] }}</td>
        </tr>
        <tr>
            <td colspan="2">Sale Session # {{ $sale->session }}</td>
            <td align="right">{{ $sale->customer['name'] }}</td>

        </tr>
        
        
        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>


            <tr>

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        @foreach($sale->items as $item)
            @if($item->product->name == 'Additional Payment' || $item->price == 0 || $item->quantity == 0)
            @else
            <tr>
                <td colspan="2">(<strong>{{$item->quantity}}</strong>){{ $item->product->name }}</td>
                <td align="right">₱ {{ number_format($item->quantity * $item->price,2) }}</td>
            </tr>
            @endif
        @endforeach

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Total Due</td>
<!--             <td align="right">{{ ($sale->subtotal +$sale->promoPrice + $sale->roomPrice)}}</td>
 -->            <td align="right">₱ {{ number_format($sale->subtotal,2)}}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Cash</td>
            <td align="right">₱ {{ number_format($sale->comments,2)}}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Change</td>
<!--             <td align="right">{{ $sale->comments - ($sale->subtotal +$sale->promoPrice + $sale->roomPrice) }}</td>
 -->            <td align="right">₱ {{ number_format($sale->comments - $sale->subtotal,2) }}</td>


        </tr>

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="3" align="center">Happy Watching!</td>
        </tr>
    </table>
</body>
</html>