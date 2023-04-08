@extends('layouts.master.index')
@push('title', 'Order')
@push('subtitle', 'Order')
@push('description', 'Data order')
@push('tools')
    @can('orders-create')
        <a href="{{ route('order.create') }}" class="btn btn-primary letter-space-1">
            <em class="icon ni ni-plus-sm"></em>
            <span>Add new data</span>
        </a>
    @endcan
@endpush
@section('content')
<div class="nk-block">
    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
        <thead>
            <tr class="nk-tb-item nk-tb-head letter-space-1">
                <th class="nk-tb-col nk-tb-col-check ff-mono"><span>No</span></th>
                <th class="nk-tb-col ff-mono"><span>Code</span></th>
                <th class="nk-tb-col tb-col-md ff-mono"><span>Date</span></th>
                <th class="nk-tb-col tb-col-md ff-mono"><span>Customer</span></th>
                <th class="nk-tb-col tb-col-md ff-mono"><span>Total</span></th>
                <th class="nk-tb-col nk-tb-col-tools">
                    <ul class="nk-tb-actions gx-1 my-n1">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    </ul>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="nk-tb-item">
                    <td class="nk-tb-col nk-tb-col-check">
                        <span> {{ $loop->iteration }} </span>
                    </td>
                    <td class="nk-tb-col">
                        <span class="tb-lead letter-space-1">{{ $order->code }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-md">
                        <span class="letter-space-1">{{ $order->created_time() }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-md">
                        <span class="letter-space-1">{{ $order->customer->name }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-md">
                        <span class="letter-space-1">{{ to_rupiah($order->total) }}</span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1 my-n1">
                            <li class="me-n1">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr ff-mono letter-space-1">
                                            @can('orders-detail')
                                                <li><a href="{{ route('order.show', $order->id) }}"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                            @endcan
                                            @can('orders-delete')
                                                <li><a data-bs-toggle="modal" data-bs-target="#delete{{ $order->id }}"><em class="icon ni ni-trash-empty"></em><span>Hapus</span></a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
                @include('layouts.components.delete', ['id' => 'delete'.$order->id , 'url' => route('order.destroy', $order->id)])
            @endforeach
        </tbody>
    </table>
</div>
@endsection



