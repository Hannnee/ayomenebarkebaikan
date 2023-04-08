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
                            <p>New password here. Enter a strong and hard-to-guess password. Use a combination of letters, numbers, and special characters to make your password stronger</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('password.update') }}" method="post">
                    @csrf
                    @method('post')

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" name="email" class="form-control form-control-lg @error('email') error @enderror" value="{{ $email ?? old('email') }}" required readonly>
                            @include('layouts.components.error-input', ['name' => 'email'])
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="password" name="password" class="form-control form-control-lg @error('password') error @enderror" value="{{ old('password') }}" required autocomplete="new-password">
                            @include('layouts.components.error-input', ['name' => 'password'])
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Confirm Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg @error('password_confirmation') error @enderror" required autocomplete="new-password">
                            @include('layouts.components.error-input', ['name' => 'password_confirmation'])
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
