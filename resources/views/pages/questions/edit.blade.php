@extends('layouts.app')

@section('meta_title', 'Stackoverflow | Edit Question')

@section('content')

    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Edit Question</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('welcome') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">Edit Question</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">

                <div class="page-content ask-question">
                    <div class="boxedtitle page-title"><h2>Edit Question</h2></div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="form-style form-style-3" id="question-submit">
                        <form method="POST" action="{{ route('questions.update', $question->id) }}" enctype="multipart/form-data" id="adding-question-form">
                            @csrf
                            @method('PUT')
                            <div class="form-inputs clearfix">
                                <p>
                                    <label for="title" class="required">Question Title<span>*</span></label>
                                    <input type="text" id="title" name="title" value="{{ $question->title }}">
                                    <span class="form-description">Please choose an appropriate title for the question to answer it even easier .</span>
                                </p>
                                <p>
                                    <label for="tags">Tags</label>
                                    <input type="text" class="input" name="tags" id="tags" data-seperator="," value="{{ $question->tags }}">
                                </p>

                                <label>Attachments</label>
                                <div class="fileinputs">
                                    <input type="file" class="file" name="images[]" multiple>
                                    <div class="fakefile">
                                        <button type="button" class="button small margin_0">Select files</button>
                                        <span><i class="icon-arrow-up"></i>Browse</span>
                                    </div>
                                </div>

                            </div>
                            <div id="form-textarea">
                                <p>
                                    <label for="description" class="required">Description<span>*</span></label>
                                    <textarea id="description" name="description" aria-required="true" cols="58" rows="8">{{ $question->description }}</textarea>
                                    <span class="form-description">Type the description thoroughly and in detail .</span>
                                </p>
                            </div>
                            <p class="form-submit">
                                <input type="submit" id="publish-question" value="Update Your Question" class="button color small submit">
                            </p>
                        </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End main -->
            @include('partials.aside')
        </div><!-- End row -->
    </section><!-- End container -->

@endsection
@section('js')
    <script>
        document.getElementById('adding-question-form').onsubmit = function (evt) {
            evt.preventDefault()
        };

        document.getElementById('publish-question').onclick = function () {
            document.getElementById('adding-question-form').submit()
        }
    </script>
@endsection
