@extends('layouts.master.index')
@push('title', 'Item')
@push('subtitle', 'Item')
@push('description', 'Data item')
@push('tools')
    @can('items-create')
        <a href="{{ route('item.create') }}" class="btn btn-primary letter-space-1">
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
                <th class="nk-tb-col ff-mono"><span>Name</span></th>
                <th class="nk-tb-col tb-col-md ff-mono"><span>price</span></th>
                <th class="nk-tb-col tb-col-md ff-mono"><span>description</span></th>
                <th class="nk-tb-col nk-tb-col-tools">
                    <ul class="nk-tb-actions gx-1 my-n1">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    </ul>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="nk-tb-item">
                    <td class="nk-tb-col nk-tb-col-check">
                        <span> {{ $loop->iteration }} </span>
                    </td>
                    <td class="nk-tb-col">
                        <span class="tb-lead letter-space-1">{{ $item->name }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-md">
                        <span class="letter-space-1">{{ to_rupiah($item->price) }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-md">
                        <span class="letter-space-1">{{ Str::limit($item->description, $limit = 70, $end = '...') }}</span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1 my-n1">
                            <li class="me-n1">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr ff-mono letter-space-1">
                                            @can('items-detail')
                                                <li><a href="{{ route('item.show', $item->id) }}"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                            @endcan
                                            @can('items-update')
                                                <li><a href="{{ route('item.edit', $item->id) }}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                            @endcan
                                            @can('items-delete')
                                                <li><a data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}"><em class="icon ni ni-trash-empty"></em><span>Hapus</span></a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
                @include('layouts.components.delete', ['id' => 'delete'.$item->id , 'url' => route('item.destroy', $item->id)])
            @endforeach
        </tbody>
    </table>
</div>
@endsection



