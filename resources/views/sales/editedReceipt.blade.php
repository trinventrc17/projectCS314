<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body>  <!-- change to <body onload="window.print()"> for automatic printing -->
    <table>
        <tr>
            <td colspan="3" align="center">Good Times Movie Lounge (<strong>{{ $sale->session }}</strong>)</td>
        </tr>
        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">{{ $sale->created_at->format('d F Y H:i') }}</td>
            <td align="right">{{ $sale->cashier['name'] }}</td>
        </tr>
        <tr>
            <td colspan="2">{{ $sale->invoice_no }}</td>
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

            <tr>
                <td colspan="2">{{ $item->product->name }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ $item->quantity }} x {{ $item->price }}</td>
                <td align="right">{{ number_format($item->quantity * $item->price,2) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Total Due</td>
<!--             <td align="right">{{ ($sale->subtotal +$sale->promoPrice + $sale->roomPrice)}}</td>
 -->            <td align="right">{{ number_format($sale->subtotal,2)}}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Cash</td>
            <td align="right">{{ number_format($sale->comments,2)}}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Change</td>
<!--             <td align="right">{{ $sale->comments - ($sale->subtotal +$sale->promoPrice + $sale->roomPrice) }}</td>
 -->            <td align="right">{{ number_format($sale->comments - $sale->subtotal,2) }}</td>


        </tr>

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="3" align="center">Thank you for comming</td>
        </tr>
    </table>
</body>
</html><!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body>  <!-- change to <body onload="window.print()"> for automatic printing -->
    <table>
        <tr>
            <td colspan="3" align="center">Good Times Movie Lounge (<strong>{{ $sale->session }}</strong>)</td>
        </tr>
        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">{{ $sale->created_at->format('d F Y H:i') }}</td>
            <td align="right">{{ $sale->cashier['name'] }}</td>
        </tr>
        <tr>
            <td colspan="2">{{ $sale->invoice_no }}</td>
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

            <tr>
                <td colspan="2">{{ $item->product->name }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ $item->quantity }} x {{ $item->price }}</td>
                <td align="right">{{ number_format($item->quantity * $item->price,2) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Total Due</td>
<!--             <td align="right">{{ ($sale->subtotal +$sale->promoPrice + $sale->roomPrice)}}</td>
 -->            <td align="right">{{ number_format($sale->subtotal,2)}}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Cash</td>
            <td align="right">{{ number_format($sale->comments,2)}}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Change</td>
<!--             <td align="right">{{ $sale->comments - ($sale->subtotal +$sale->promoPrice + $sale->roomPrice) }}</td>
 -->            <td align="right">{{ number_format($sale->comments - $sale->subtotal,2) }}</td>


        </tr>

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="3" align="center">Thank you for comming</td>
        </tr>
    </table>
</body>
</html>