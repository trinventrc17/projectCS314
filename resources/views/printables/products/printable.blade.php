                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Capital Per Item</th>
                            <th>Price Per Item</th>
                            <th>Income Per Item</th>
                            <th>Items Sold</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                            <tr>
                                @if($sale->name == 'Additional Payment' || $sale->name == 'Corkage Fee' || $sale->name == 'Additional Person' || $sale->name == 'Additional Movie Fee')
                                @else
                                <td>{{ $sale->name }}</td>
                                @if($sale->capitalPrice == 0)
                                <td>Not Assigned</td>
                                @else
                                <td>₱ {{ number_format($sale->capitalPrice,2) }}</td>
                                @endif
                                <td>₱ {{ number_format($sale->price,2) }}</td>
                                <td>₱ {{ number_format($sale->price - $sale->capitalPrice,2) }}</td>
                                <td>{{ $sale->sold }}</td>

                                <td>₱ {{ number_format($sale->sold * ($sale->price - $sale->capitalPrice),2) }}</td>
                                @endif
                            </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>₱ {{ number_format($saleTotal,2) }}</td>
                    </tr>
                    </tbody>
                </table>