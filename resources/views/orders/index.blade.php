@extends('layouts.app')

@section('content')

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Orders <span class="float-right">Total: {{ number_format($orders->total()) }}</span></div>

                            <div class="card-body">
                                <table class="table table-striped table-sm" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">Order Total</th>
                                            <th scope="col">Transaction Id</th>
                                            <th scope="col">Shipper</th>
                                            <th scope="col">Tracking Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
@foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->product_name }}</td>
                                            <td>{{ $order->color }}</td>
                                            <td>{{ $order->size }}</td>
                                            <td>{{ $order->order_status }}</td>
                                            <td>${{ number_format(($order->total_cents + $order->tax_total_cents)/100, 2) }}</td>
                                            <td>{{ $order->transaction_id }}</td>
                                            <td>{{ $order->shipper_name }}</td>
                                            <td>{{ $order->tracking_number }}</td>
                                        </tr>
@endforeach
                                    </tbody>
                                </table>

                                {{ $orders->links() }}
                            </div>

                            <div class="card-body">
                                <div class="float-left">
                                    <h2>Total Sales:</h2>
                                    ${{ number_format(($sumTotalSales[0]->sum_total_cents + $sumTotalSales[0]->sum_tax_total_cents)/100, 2) }}
                                </div>

                                <div class="float-right">
                                    <h2>Average Sale:</h2>
                                    ${{ number_format($avgTotalSales[0]->avg_total_cents/100 + $avgTotalSales[0]->avg_tax_total_cents/100, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection