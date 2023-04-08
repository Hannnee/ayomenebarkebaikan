@extends('layouts.master.index')
@push('title', 'Role')
@push('subtitle', 'Role')
@push('description', 'Data Role')
@push('tools')
    @can('roles-create')
        <a href="{{ route('role.create') }}" class="btn btn-primary letter-space-1">
            <em class="icon ni ni-plus"></em>
            <span>Add new data</span>
        </a>
    @endcan
@endpush
@section('content')
<div class="nk-block">
    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
        <thead>
            <tr class="nk-tb-item nk-tb-head letter-space-1">
                <th class="nk-tb-col nk-tb-col-check ff-mono">
                    <span>No</span>
                </th>
                <th class="nk-tb-col ff-mono"><span>Name</span></th>
                <th class="nk-tb-col tb-col-md ff-mono"><span>Permission</span></th>
                <th class="nk-tb-col nk-tb-col-tools">
                    <ul class="nk-tb-actions gx-1 my-n1">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    </ul>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr class="nk-tb-item">
                    <td class="nk-tb-col nk-tb-col-check">
                        <span> {{ $loop->iteration }} </span>
                    </td>
                    <td class="nk-tb-col">
                        <span class="tb-lead letter-space-1">{{ $role->name }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-md">
                        <span class="tb-lead letter-space-1">
                            <span class="badge badge-dim rounded-pill bg-outline-primary ff-mono letter-space-1">{{ $role->permissions->count() }} access</span>
                        </span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1 my-n1">
                            <li class="me-n1">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr ff-mono letter-space-1">
                                            @can('roles-detail')
                                                <li><a href="{{ route('role.show', $role->id) }}"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                            @endcan
                                            @can('roles-update')
                                                <li><a><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                            @endcan
                                            @can('roles-delete')
                                                @if($role->id != 1 && $role->id !=2)
                                                    <li><a data-bs-toggle="modal" data-bs-target="#delete{{$role->id}}"><em class="icon ni ni-trash-empty"></em><span>Delete</span></a></li>
                                                @endif
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
                @include('layouts.components.delete', ['id' => 'delete'.$role->id, 'url' => route('role.destroy', $role->id)])
            @endforeach
        </tbody>
    </table>
</div>
@endsection
