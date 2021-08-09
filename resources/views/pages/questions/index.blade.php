@extends('layouts.app')

@section('meta_title', 'Stackoverflow | My Questions')

@section('content')

    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>My Questions</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('welcome') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">My Questions</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <section class="container main-content">
                    <div class="row">
                        <div class="col-md-9">

                            <div class="tabs-warp question-tab">
                                <ul class="tabs">
                                    <li class="tab"><a href="#" class="current">My Questions</a></li>
                                </ul>
                                <div class="tab-inner-warp">
                                    <div class="tab-inner">
                                        @forelse($questions as $question)
                                            <article class="question question-type-normal">
                                                <h2>
                                                    <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
                                                </h2>
                                                <div class="question-author">
                                                    <a href="#" original-title="{{ $question->user->name }}" class="question-author-img tooltip-n">
                                                        <span></span><img alt="{{ $question->user->name }}" src="{{ asset($question->user->image) }}">
                                                    </a>
                                                </div>
                                                <div class="question-inner">
                                                    <div class="clearfix"></div>
                                                    <p class="question-desc">{{ $question->description }}</p>
                                                    <div class="question-details">
                                                        <span class="question-answered @if($question->solved) question-answered-done @endif"><i class="icon-ok"></i>{{ $question->getSolved() }}</span>
                                                    </div>
                                                    <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::make($question->created_at)->diffForHumans()}} </span>
                                                    <span class="question-comment"><a><i class="icon-comment"></i>{{ $question->answers()->count() }} Answers</a></span>
                                                    <span class="question-view"><i class="icon-user"></i>{{ $question->views }} views</span>
                                                    <div class="clearfix"></div>
                                                    <div class="float-right mb-4">
                                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-info font18">Edit</a>
                                                        <form id="delete-form" action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a  class="btn btn-danger font18"
                                                            href="{{ route('questions.destroy', $question->id) }}" onclick="event.preventDefault();
                                                 document.getElementById('delete-form').submit();"
                                                        >Delete
                                                        </a>

                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="share-tags page-content">
                                                        <div class="question-tags"><i class="icon-tags"></i>
                                                            @foreach(explode(',', $question->tags) as $tag)
                                                                <a href="{{ route('tag', $tag) }}">{{ $tag }}</a>
                                                            @endforeach
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div><!-- End share-tags -->
                                                </div>
                                            </article>
                                        @empty
                                            <p>There is no questions till now..</p>
                                        @endforelse
                                        {{ $questions->links() }}
                                    </div>
                                </div>
                            </div><!-- End page-content -->
                        </div><!-- End main -->
                        @include('partials.aside')
                    </div><!-- End row -->
                </section><!-- End container -->
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
