@extends('layouts.app')


@section('meta_title', 'Stackoverflow | Reset Password')

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
                        <span class="current">Reset Password</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
        <div class="login">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-content">
                        <h2>Reset Password</h2>
                        <div class="form-style form-style-3">

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">


                                <div class="form-inputs clearfix">
                                    <p class="login-text">
                                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror


                                    </p>
                                    <p class="login-password">
                                        <input placeholder="New Password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </p>

                                    <p class="login-password">
                                        <input placeholder="Confirm new password" type="password" name="password_confirmation" required autocomplete="new-password">
                                    </p>



                                </div>
                                <p class="form-submit login-submit">
                                    <input type="submit" value="{{ __('Reset Password') }}" class="button color small login-submit submit">
                                </p>

                            </form>
                        </div>
                    </div><!-- End page-content -->
                </div><!-- End col-md-6 -->

            </div><!-- End row -->
        </div><!-- End login -->
    </section><!-- End container -->

@endsection





