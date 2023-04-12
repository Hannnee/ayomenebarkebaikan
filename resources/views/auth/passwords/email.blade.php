@extends('layouts.auth.index')
@push('title', 'Reset password')
@section('content')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        {{-- <div class="brand-logo pb-4 text-center">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div> --}}
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                @if (session('status'))
                    <div class="alert alert-icon alert-success alert-dismissible letter-space-1" role="alert">
                        <em class="icon ni ni-alert-circle"></em>
                            {{ session('status') }}
                        <button class="close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title">Reset password</h5>
                        <div class="nk-block-des">
                            <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" name="email" class="form-control form-control-lg @error('email') error @enderror" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email" autofocus>
                            @include('layouts.components.error-input', ['name' => 'email'])
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Send Reset Link</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4">
                    <a href="{{ route('login') }}"><strong>Return to login</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
