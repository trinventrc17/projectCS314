<!DOCTYPE html>
<html>
<head>
	<title>Sales To Excel</title>
</head>
<body>


<table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($sales))
                        @forelse($sales as $sale)
                            @if($sale->product->name == 'Additional Payment' || $sale->price == 0 || $sale->quantity == 0)
                            @else
                            <tr>
                                <td>{{ $sale->created_at->format('F d, Y') }}</td>
                                <td>{{ $sale->product->name }}</td>
                                <td>{{ $sale->product->category }}</td>
                                <td> ₱ {{ number_format($sale->price,2) }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>₱ {{ number_format($sale->quantity * $sale->price,2) }}</td>
                            </tr>
                            @endif
                    @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                    @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>₱ {{ number_format($saleTotal,2) }}</td>
                            </tr>
                    @endif
                    </tbody>
 </table>

</body>
</html>