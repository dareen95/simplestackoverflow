@extends('layouts.app')
@section('meta_title', 'Edit Profile')
@section('content')

    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Edit Profile</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('welcome') }}">Home</a>
                        <span class="crumbs-span">/</span>

                        <span class="current">Edit Profile</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">
                <div class="page-content">
                    <div class="boxedtitle page-title"><h2>Edit Profile</h2></div>

                    <div class="form-style form-style-4">
                        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-inputs clearfix">

                                <p>
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" name="name" required value="{{ $user->name }}">
                                </p>
                                <p>
                                    <label class="required" for="email">E-Mail<span>*</span></label>
                                    <input type="email" id="email" name="email" required value="{{ $user->email }}">
                                </p>

                                <p>
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password">
                                </p>
                                <p>
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation">
                                </p>

                            </div>
                            <div class="form-style form-style-2">
                                <div class="user-profile-img"><img src="{{ asset($user->image) }}" alt="{{ $user->nam }}"></div>
                                <p class="user-profile-p">
                                    <label></label>
                                <div class="fileinputs">
                                    <input type="file" class="file" name="image">
                                    <div class="fakefile">
                                        <button type="button" class="button small margin_0">Select file</button>
                                        <span><i class="icon-arrow-up"></i>Browse</span>
                                    </div>
                                </div>
                                <p></p>
                                <div class="clearfix"></div>
                                <p>
                                    <label for="bio">About Yourself</label>
                                    <textarea cols="58" rows="8" id="bio" name="bio">{{ $user->bio }}</textarea>
                                </p>
                            </div>
                            <div class="form-inputs clearfix">
                                <p>
                                    <label for="facebook">Facebook</label>
                                    <input type="text" id="facebook" name="facebook_link" value="{{ $user->facebook_link }}">
                                </p>
                                <p>
                                    <label for="twitter">Twitter</label>
                                    <input type="text" id="twitter" name="twitter_link" value="{{ $user->twitter_link }}">
                                </p>
                                <p>
                                    <label for="linkedin">Linkedin</label>
                                    <input type="email" id="linkedin" name="linkedin_link" value="{{ $user->linkedin_link }}">
                                </p>
                                <p>
                                    <label for="github_link">Github</label>
                                    <input type="text" id="github_link" name="github_link" value="{{ $user->github_link }}">
                                </p>
                            </div>
                            <p class="form-submit">
                                <input type="submit" value="Update" class="button color small login-submit submit">
                            </p>
                        </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End main -->

            @include('partials.aside')

        </div><!-- End row -->
    </section><!-- End container -->

@endsection
