@extends('layouts.master.index')
@push('title', 'Role')
@push('subtitle', 'Role')
@push('description', 'Detail Role')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('role.index')])
@endpush
@section('content')
<div class="nk-block nk-block-lg">
    <div class="card">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Role detail</h5>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <label class="form-label">Role name</label>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control mt-2" value="{{ $role->name }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <label class="form-label">Created</label>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control mt-2" value="{{ $role->created_time() }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Permission</h5>
            </div>
            <div class="row g-gs">
                @foreach($features as $feature)
                    <div class="col-sm-12 col-md-3 p-3">
                        <div class="p-1">
                            <div class="letter-space-1 text-capitalize">{{ $feature->name }}</div>
                            @foreach($feature->permissions as $permission)
                                <div class="mt-2">
                                    <div class="custom-control custom-control-md custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkInput" value="{{$permission->id}}" @if ($role->permissions->contains($permission->id)) checked="checked" @endif readonly>
                                        <label class="custom-control-label text-soft letter-space-1 text-capitalize" for="checkbox-{{$permission->name}}">{{ preg_replace("/".$feature->name."-/", "", $permission->name)}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

