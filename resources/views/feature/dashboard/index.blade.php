@extends('layouts.master.index')
@push('title', 'Dashboard')
@push('subtitle', 'Dashboard')
@push('description', 'All the report from your application')
@section('content')
<div class="nk-block">
    <div class="row g-gs">
        <div class="col-12 col-md-4">
            <div class="card is-dark h-100">
                <div class="nk-ecwg nk-ecwg1">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title letter-space-1">Total Income</h6>
                            </div>
                            <div class="card-tools">
                                <a href="#" class="link">View Report</a>
                            </div>
                        </div>
                        <div class="data">
                            <div class="amount">{{ to_rupiah($totalAmount) }}</div>
                            <div class="info">In all {{ $orders }} order transaction</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-inner">
                    <div class="card-title-group mb-2">
                        <div class="card-title">
                            <h6 class="title">Store Statistics</h6>
                        </div>
                    </div>
                    <ul class="nk-store-statistics">
                        <li class="item">
                            <div class="info">
                                <div class="title">Orders</div>
                                <div class="count">{{ $orders }}</div>
                            </div>
                            <em class="icon bg-primary-dim ni ni-bag"></em>
                        </li>
                        <li class="item">
                            <div class="info">
                                <div class="title">Customers</div>
                                <div class="count">{{ $customers }}</div>
                            </div>
                            <em class="icon bg-info-dim ni ni-users"></em>
                        </li>
                        <li class="item">
                            <div class="info">
                                <div class="title">Items</div>
                                <div class="count">{{ $items }}</div>
                            </div>
                            <em class="icon bg-pink-dim ni ni-box"></em>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-inner">
                <div class="card-title-group mb-2">
                    <div class="card-title">
                        <h6 class="title">Top items</h6>
                    </div>
                </div>
                @foreach ($topItems as $item)
                    <ul class="nk-top-products">
                        <li class="item">
                            <div class="thumb">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-purple-dim">
                                        <span>{{ isset($item->name) ? Str::limit($item->name, 2, '') : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <div class="title">{{ $item->name }}</div>
                                <div class="price">{{ to_rupiah($item->price) }}</div>
                            </div>
                            <div class="total">
                                <div class="amount">{{ $item->total_order }} Sold</div>
                            </div>
                        </li>
                    </ul>
                @endforeach
            </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">Recent Orders</h6>
                        </div>
                    </div>
                </div>
                <div class="nk-tb-list mt-n2">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span>Order Code.</span></div>
                        <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
                        <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                        <div class="nk-tb-col"><span>Amount</span></div>
                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                    </div>
                    @foreach ($newOrders as $order)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">#{{ $order->code }}</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-purple-dim">
                                        <span>{{ isset($order->customer->name) ? Str::limit($order->customer->name, 2, '') : '-' }}</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">{{ isset($order->customer->name) ? $order->customer->name : 'deleted' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">{{ date('d/m/y h:i:s', strtotime($order->created_at)) }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">{{ to_rupiah($order->total) }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-success">Paid</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
