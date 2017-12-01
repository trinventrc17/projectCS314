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
                            <th>Earnings</th>
                            <th>Expenses</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($earnings))
                        @forelse($earnings as $earning)
                                <tr>

                                    <td>{{ \Carbon\Carbon::parse($earning->day)->format('M d, Y')}}</td>
                                    <td>₱ {{ $earning->total }}</td>
                                    <td>
                                    @foreach ($expenses as $key => $expense)
                                        @if($expense->day == $earning->day)
                                            ₱ {{ number_format($expense->total,2) }}
                                        @else
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>
                                    @php ($i = 0)
                                    @php ($j = 0)
                                    @foreach ($expenses as $key => $expense)
                                        @if($expense->day == $earning->day)
                                            @php ($i = $key)
                                            @php ($j = $expense->total)
                                            @break
                                        @else
                                            @php ($i = $key)
                                            @php($j=0)
                                        @endif
                                    @endforeach
                                            ₱ {{ number_format($earnings[$i]->total - $j,2) }}
                                    </td>
                                </tr>
                        
                        @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                        @endforelse
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>₱ {{ number_format($saleTotal,2) }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>>

</body>
</html>