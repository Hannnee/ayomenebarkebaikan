



@extends('layouts.auth.index')
@push('title', 'Email verification')
@section('content')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body">
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
                        <h5 class="nk-block-title">Verification email</h5>
                        <div class="nk-block-des">
                            <p>A fresh verification link has been sent to your email address. Before proceeding, please check your email for a verification link. If you did not receive the email</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('verification.resend') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-secondary btn-block">Request another</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
