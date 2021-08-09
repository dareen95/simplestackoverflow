@extends('layouts.app')

@section('meta_title', 'Stackoverflow | Login')

@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Login</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('welcome') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">Login</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <div class="panel-pop" id="signup">
        <h2>Register Now<i class="icon-remove"></i></h2>
        <div class="form-style form-style-3">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-inputs clearfix">
                    <p>
                        <label class="required">Name<span>*</span></label>
                        <input type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </p>
                    <p>
                        <label class="required">E-Mail<span>*</span></label>
                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </p>
                    <p>
                        <label class="required">Password<span>*</span></label>
                        <input type="password" class="@error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </p>
                    <p>
                        <label class="required">Confirm Password<span>*</span></label>
                        <input type="password" name="password_confirmation" required>
                    </p>
                </div>
                <p class="form-submit">
                    <input type="submit" value="Signup" class="button color small submit">
                </p>
            </form>
        </div>
    </div><!-- End signup -->

    <div class="panel-pop" id="lost-password">
        <h2>Lost Password<i class="icon-remove"></i></h2>
        <div class="form-style form-style-3">
            <p>Lost your password? Please enter your username and email address. You will receive a link to create a new password via email.</p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-inputs clearfix">
                    <p>
                        <label class="required">E-Mail<span>*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </p>
                </div>
                <p class="form-submit">
                    <input type="submit" value="Reset" class="button color small submit">
                </p>
            </form>
            <div class="clearfix"></div>
        </div>
    </div><!-- End lost-password -->

    <section class="container main-content">
        <div class="login">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-content">
                        <h2>Login</h2>
                        <div class="form-style form-style-3">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-inputs clearfix">
                                    <p class="login-text">
                                        <input
                                            autocomplete="email"
                                            autofocus
                                            class="@error('email') is-invalid @enderror"
                                            name="email"
                                            onblur="if (this.value == '') {this.value = 'Email';}"
                                            onfocus="if (this.value == 'Email') {this.value = '';}" required type="email" value="Email">
                                        <i class="icon-user"></i>
                                        @error('email')
                                        <span class="invalid-feedback text-dangerm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                    <p class="login-password">
                                        <input type="password" class="@error('password') is-invalid @enderror" name="password" required>
                                        <i class="icon-lock"></i>
                                        <a href="#">Forget</a>
                                        @error('password')--}}
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>

                                </div>
                                <p class="form-submit login-submit">
                                    <input type="submit" value="Log in" class="button color small login-submit submit">
                                </p>
                                <div class="rememberme">
                                    <label><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</label>
                                </div>
                            </form>
                        </div>
                    </div><!-- End page-content -->
                </div><!-- End col-md-6 -->
                <div class="col-md-6">
                    <div class="page-content">
                        <h2>Register Now</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate posuere nisl quis consequat.</p>
                        <a class="button small color signup">Create an account</a>
                    </div><!-- End page-content -->
                </div><!-- End col-md-6 -->
            </div><!-- End row -->
        </div><!-- End login -->
    </section><!-- End container -->

@endsection


{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
