@extends('layouts.master.index')
@push('title', 'Detail')
@push('subtitle', 'Detail')
@push('description', 'Detail order')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('order.index')])
@endpush
@section('content')
<div class="nk-block">
    <div class="invoice">
        <div class="invoice-wrap">
            <div class="invoice-head">
                <div class="invoice-contact">
                    <span class="overline-title">Invoice To</span>
                    <div class="invoice-contact-info">
                        <h4 class="title">{{ $order->customer->name }}</h4>
                        <ul class="list-plain">
                            <li><em class="icon ni ni-map-pin-fill"></em><span>{{ $order->address }}</span></li>
                            <li><em class="icon ni ni-call-fill"></em><span>{{ $order->customer->phone }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="invoice-desc text-end">
                    <h3 class="title">Invoice</h3>
                    <ul class="list-plain">
                        <li class="invoice-id text-primary"><span>#{{ $order->code }}</span></li>
                        <li class="invoice-id"><span>{{ $order->created_time() }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="invoice-bills">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="w-150px">Item ID</th>
                                <th class="w-50">Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Minus</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>#{{ $item->id }}</td>
                                    <td>{{ $item->item->name }}</td>
                                    <td>{{ to_rupiah($item->price) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ to_rupiah($item->price * $item->qty) }}</td>
                                    <td>{{ $item->discount }} %</td>
                                    <td class="text-danger">- {{ to_rupiah(($item->price * $item->qty) * $item->discount / 100) }}</td>
                                    <td>{{ to_rupiah($item->total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2">Subtotal</td>
                                <td>{{ to_rupiah($order->subtotal) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2">Order discount</td>
                                <td>{{ $order->discount }} %</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2">Minus</td>
                                <td class="text-danger">- {{ to_rupiah($order->subtotal * $order->discount / 100) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2">Grand Total</td>
                                <td>{{ to_rupiah($order->total) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

