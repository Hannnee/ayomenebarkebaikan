@extends('layouts.master.index')
@push('title', 'Role')
@push('subtitle', 'Role')
@push('description', 'Create Role')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('role.index')])
@endpush
@section('content')
<div class="nk-block nk-block-lg">
    <form action="{{ route('role.store') }}" method="post" class="form-input">
        @csrf
        @method('POST')
        <div class="card">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Add new role</h5>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <label class="form-label required">Role name</label>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" name="name" class="form-control mt-2 @error('name') error @enderror" value="{{ old('name') }}" placeholder="Input role name">
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px">string | max : 225 </span>
                                @include('layouts.components.error-input', ['name' => 'name'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Permissions</h5>
                </div>
                @include('layouts.components.error-input', ['name' => 'permission'])
                <div class="row g-gs">
                    @foreach($features as $feature)
                        <div class="col-sm-12 col-md-3 p-3">
                            <div class="p-1">
                                <div class="letter-space-1 text-capitalize">{{ $feature->name }}</div>
                                @foreach($feature->permissions as $permission)
                                    <div class="mt-2">
                                        <div class="custom-control custom-control-md custom-checkbox">
                                            <input type="checkbox" name="permission[]" class="custom-control-input checkInput" id="checkbox-{{$permission->name}}" value="{{$permission->id}}">
                                            <label class="custom-control-label text-soft letter-space-1 text-capitalize" for="checkbox-{{$permission->name}}">{{ preg_replace("/".$feature->name."-/", "", $permission->name)}}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary me-2"><em class="icon ni ni-save"></em><span>Save</span></button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
    <script>

        function removeLast(param) {
            let strParts = param.split('-');
            strParts.pop();
            strData = strParts.join('-');
            strData = strData.concat('-');
            return strData;
        }

        function replaceToView(param) {
            let parts = param.split('-');
            parts[2] = 'view';
            string = parts.join('-');
            return string;
        }

        $('body').on('change', '.checkInput', function () {
            let id = $(this).attr('id');
            if (id.indexOf('delete') > -1 || id.indexOf('create') > -1 || id.indexOf('detail') > -1 || id.indexOf('update') > -1) {
                //cek dulu apakah ada dari create update delete detail
                let parentId = removeLast(id);
                let replaceView = replaceToView(id);
                if ($('#'+parentId+'delete').is(':checked') || $('#'+parentId+'create').is(':checked') || $('#'+parentId+'detail').is(':checked') || $('#'+parentId+'update').is(':checked')) {
                        $('#'+replaceView+'').prop('checked', true)
                        $('#'+replaceView+'').prop('disabled', true);
                } else {
                    $('#'+replaceView+'').prop('checked', false)
                    $('#'+replaceView+'').prop('disabled', false);
                }
            } else {
                console.log('tidak ditemukan');
            }
        });
    </script>
@endpush
