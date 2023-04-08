@extends('layouts.auth.index')
@push('title', 'Sign up')
@section('content')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
        {{-- <div class="brand-logo pb-4 text-center">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div> --}}
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Sign up</h4>
                        <div class="nk-block-des">
                            <p>Create a new account</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    @method('post')

                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name" required autocomplete="name" autofocus>
                            @include('layouts.components.error-input', ['name' => 'name'])
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="email" placeholder="Enter your email address" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @include('layouts.components.error-input', ['name' => 'email'])
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password" required autocomplete="new-password">
                            @include('layouts.components.error-input', ['name' => 'password'])
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Confirm Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="password" class="form-control form-control-lg @error('password_confirmation') error @enderror" name="password_confirmation" required autocomplete="new-password">
                            @include('layouts.components.error-input', ['name' => 'password_confirmation'])
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Sign up</button>
                    </div>
                </form>

                <div class="form-note-s2 text-center pt-4"> Already have an account?
                    <a href="{{ route('login') }}"><strong>Sign in instead</strong></a>
                </div>
                <div class="text-center pt-4 pb-3">
                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                </div>
                <ul class="nav justify-center gx-8">
                    <li class="nav-item"><a class="nav-link">Google</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

