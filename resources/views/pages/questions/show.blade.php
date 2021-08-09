@extends('layouts.app')

@section('meta_title', 'Stackoverflow | ' . $question->title)

@section('content')

    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Ask Question</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('welcome') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">{{ $question->title }}</span>
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
                <article class="question single-question question-type-normal">
                    <h2>
                        <a>{{ $question->title }}</a>
                    </h2>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">{{ $question->description }}</p>
                        <div class="mb-5">
                            @if($question->images != null)
                                @foreach(json_decode($question->images) as $image)
                                    <a href="{{ asset($image) }}" target="_blank"><img src="{{ asset($image) }}" alt="" width="200" height="200"></a>
                                @endforeach
                            @endif
                        </div>
                        <div class="question-details">
                            <span class="question-answered @if($question->solved) question-answered-done @endif"><i class="icon-ok"></i>{{ $question->getSolved() }}</span>
                        </div>
                        <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::make($question->created_at)->diffForHumans()}}</span>
                        <span class="question-comment"><a><i class="icon-comment"></i>{{ $numOfAnswers }} Answers</a></span>
                        <span class="question-view"><i class="icon-user"></i>{{ $question->views }} views</span>
                        <span class="single-question-vote-result font18">{{ $question->votes }} votes</span>
                        @auth
                            @if($question->user_id !== \Illuminate\Support\Facades\Auth::id())
                                <ul class="single-question-vote">
                                    <li><a href="{{ route('questions.downvote', $question->id) }}" class="single-question-vote-down" title="Down vote"><i class="icon-thumbs-down"></i></a></li>
                                    <li><a href="{{ route('questions.upvote', $question->id) }}" class="single-question-vote-up" title="Upvote"><i class="icon-thumbs-up"></i></a></li>
                                </ul>
                            @endif
                        @endauth

                        <div class="clearfix"></div>
                    </div>
                </article>

                <div class="share-tags page-content">
                    <div class="question-tags"><i class="icon-tags"></i>
                        @foreach(explode(',', $question->tags) as $tag)
                            <a href="{{ route('tag', $tag) }}">{{ $tag }}</a>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div><!-- End share-tags -->

                <div class="about-author clearfix">
                    <div class="author-image">
                        <a href="{{ asset($question->user->image) }}" original-title="admin" class="tooltip-n">
                            <img alt="{{ $question->user->name }}"
                                 title="{{ $question->user->name }}"
                                 src="{{ asset($question->user->image) }}"></a>
                    </div>
                    <div class="author-bio">
                        <h4>{{ $question->user->name }}</h4>
                        {{ $question->user->bio }}
                    </div>
                </div><!-- End about-author -->

                <div id="commentlist" class="page-content">
                    <div class="boxedtitle page-title"><h2>Answers ( <span class="color">{{ $numOfAnswers }}</span> )</h2></div>
                    <ol class="commentlist clearfix">
                        @foreach($question->answers as $answer)
                            @php
                                $answer_user = $answer->user;
                            @endphp
                        <li class="comment">
                            <div class="comment-body comment-body-answered clearfix">
                                <div class="avatar"><img alt="{{ $answer_user->name }}" src="{{ asset($answer_user->image) }}"></div>
                                <div class="comment-text">
                                    <div class="author clearfix">
                                        <div class="comment-author"><a>{{$answer_user->name }}</a></div>
                                        @auth
                                            @if($answer->user_id != \Illuminate\Support\Facades\Auth::id())
                                                <div class="comment-vote">
                                                    <ul class="question-vote">
                                                        <li><a href="{{ route('answer.upvote', $answer->id) }}" class="question-vote-up" title="Upvote"></a></li>
                                                        <li><a href="{{ route('answer.downvote', $answer->id) }}" class="question-vote-down" title="Downvote"></a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        @endauth

                                        <span class="question-vote-result">{{ $answer->votes }} votes</span>
                                        <div class="comment-meta">
                                            <div class="date"><i class="icon-time"></i>{{ \Carbon\Carbon::make($answer->created_at)->diffForHumans() }}</div>
                                        </div>
                                        @auth
                                            @if($question->user_id == \Illuminate\Support\Facades\Auth::id())
                                                @if($answer->accepted)
                                                    <a class="comment-reply" href="{{ route('answer.not-best', $answer->id) }}">Unmark As Best Answer</a>
                                                @else
                                                    <a class="comment-reply" href="{{ route('answer.best', $answer->id) }}">Mark As Best Answer</a>
                                                @endif
                                            @endif
                                        @endauth
                                    </div>
                                    <div class="text"><p>{{ $answer->content }}</p>
                                    </div>
                                    @if($answer->accepted)
                                        <div class="question-answered question-answered-done"><i class="icon-ok"></i>Best Answer</div>
                                    @endif
                                </div>
                            </div>


                            @include('partials.answer_replies', ['comments' => $answer->comments])


                            <div id="respond" class="comment-respond page-content clearfix">
                                <form action="{{ route('answer.reply') }}" method="post" id="commentform" class="comment-form">
                                    @csrf
                                    <p>
                                        <label class="required" for="content">Reply<span>*</span></label>
                                        <input type="text" name="comment_content" class="form-control" />
                                        <input type="hidden" name="answer_id" value="{{ $answer->id }}" />
                                        @if(isset($comment))
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                                        @endif
                                    </p>
                                    <p class="form-submit">
                                        <input name="submit" type="submit" id="submit" value="Post your reply" class="button small color">
                                    </p>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ol><!-- End commentlist -->
                </div><!-- End page-content -->

                <div id="respond" class="comment-respond page-content clearfix">
                    @auth
                        @if($question->user_id == \Illuminate\Support\Facades\Auth::id())
                            <div class="boxedtitle page-title"><h2>You cannot answer your question</h2></div>
                        @else
                            <div class="boxedtitle page-title"><h2>Leave an answer</h2></div>
                            <form action="{{ route('answer.store') }}" method="post" id="commentform" class="comment-form">
                                @csrf
                                <input type="hidden" readonly name="question_id" value="{{ $question->id }}">
                                <div id="respond-textarea">
                                    <p>
                                        <label class="required" for="content">Answer<span>*</span></label>
                                        <textarea id="content" name="answer_content" aria-required="true" cols="58" rows="8"></textarea>
                                    </p>
                                </div>
                                <p class="form-submit">
                                    <input name="submit" type="submit" id="submit" value="Post your answer" class="button small color">
                                </p>
                            </form>
                        @endif
                    @else
                        <div class="boxedtitle page-title"><h2><a href="{{ route('login') }}">Login</a> to reply</h2></div>
                    @endauth
                </div>
            </div><!-- End main -->
            @include('partials.aside')
        </div><!-- End row -->
    </section><!-- End container -->


@endsection
