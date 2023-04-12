@extends('layouts.master.index')
@push('title', 'Edit')
@push('subtitle', 'Edit')
@push('description', 'Edit user')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('user.index')])
@endpush
@section('content')
<div class="nk-block nk-block-lg">
    <form action="{{ route('user.update', $user->id) }}" method="post" class="form-input">
        @csrf
        @method('put')
        <div class="row d-flex justify-content-center align-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-inner">

                        <div class="mb-4">
                            <label class="form-label required">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="name" class="form-control @error('name') error @enderror" value="{{ old('name', $user->name) }}" required>
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> string | min : 8 | maks : 225 </span>
                                @include('layouts.components.error-input', ['name' => 'name'])
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label required">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" name="email" class="form-control @error('email') error @enderror" value="{{ old('email', $user->email) }}" required>
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> email | unique</span>
                                @include('layouts.components.error-input', ['name' => 'email'])
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">New password</label>
                            <div class="form-control-wrap">
                                <input type="password" name="password" class="form-control @error('password') error @enderror" value="{{ old('password') }}">
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> min : 8 | Fill in if you want to change the password </span>
                                @include('layouts.components.error-input', ['name' => 'password'])
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label required col-sm-2">Role</label>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div class="row g-gs">
                                        @foreach($roles as $role)
                                            <div class="col-sm-12 col-md-4">
                                                <div class="custom-control custom-radio ">
                                                    <input type="radio" id="reg-role-{{$role->id}}" name="role" class="custom-control-input" value="{{$role->id}}"
                                                    {{ isset($user->roles->first()->name) ? ($user->roles->first()->id == $role->id) ? 'checked' : '' : ''  }}
                                                    required>
                                                    <label class="custom-control-label" for="reg-role-{{$role->id}}">{{ $role->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @can('users-update')
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button>
                    </div>
                @endcan
            </div>
        </div>
    </form>
</div>
@endsection



