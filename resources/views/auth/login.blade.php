@extends('layouts.auth.index')
@push('title', 'Login')
@section('content')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        {{-- <div class="brand-logo pb-4 text-center">
            <a href="{{ url('/') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ url('assets/images/logo.png') }}" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ url('assets/images/logo-dark.png') }}" alt="logo-dark">
            </a>
        </div> --}}
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                @include('layouts.components.alert')
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Sign-In</h4>
                        <div class="nk-block-des">
                            <p>Access the dashboard panel using your email and password.</p>
                        </div>
                        <div class="card bg-primary-dim mt-3">
                            <div class="card-body">
                                <div class="fw-light fs-12px">Admin email :<span class="text-primary"> superadmin@gmail.com </span> / pass <span class="text-primary"> 12345678 </span> </div>
                                <div class="fw-light fs-12px">Sataff email :<span class="text-primary"> staff@gmail.com </span> / pass <span class="text-primary"> 12345678 </span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" name="email" class="form-control form-control-lg @error('email') error @enderror" value="{{ old('email') }}" placeholder="Please input your email">
                            @include('layouts.components.error-input', ['name' => 'email'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label">Password</label>
                            <a class="link link-primary link-sm" href="{{ route('password.request') }}">Forgot password ?</a>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') error @enderror" placeholder="Please input your password">
                            @include('layouts.components.error-input', ['name' => 'password'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-control-xs custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="checkbox">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                    </div>
                </form>
                {{-- <div class="form-note-s2 text-center pt-4"> New on our platform?
                    <a href="{{ route('register') }}">Create an account</a>
                </div>
                <div class="text-center pt-4 pb-3">
                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                </div>
                <ul class="nav justify-center gx-4">
                    <li class="nav-item"><a class="nav-link">Google</a></li>
                </ul> --}}
            </div>
        </div>
    </div>

</div>
@endsection


{{-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> --}}
