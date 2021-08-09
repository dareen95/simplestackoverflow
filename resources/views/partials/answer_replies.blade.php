
    <ul class="children">
        @foreach($comments as $comment)
        <li class="comment">
            <div class="comment-body clearfix">
                <div class="avatar"><img alt="{{ $comment->user->name }}" src="{{ asset($comment->user->image) }}"></div>
                <div class="comment-text">
                    <div class="author clearfix">
                        <div class="comment-author"><a>{{$comment->user->name }}</a></div>
                        @auth
                            @if($comment->user_id != \Illuminate\Support\Facades\Auth::id())
                                <div class="comment-vote">
                                    <ul class="question-vote">
                                        <li><a href="{{ route('comment.upvote', $comment->id) }}" class="question-vote-up" title="Upvote"></a></li>
                                        <li><a href="{{ route('comment.downvote', $comment->id) }}" class="question-vote-down" title="Downvote"></a></li>
                                        @endauth
                                    </ul>
                                </div>
                            @endif


                        <span class="question-vote-result">{{ $comment->votes }} votes</span>
                        <div class="comment-meta">
                            <div class="date"><i class="icon-time"></i>{{ \Carbon\Carbon::make($comment->created_at)->diffForHumans() }}</div>
                        </div>

                    </div>
                    <div class="text"><p>{{ $comment->content }}</p>
                    </div>
                </div>
            </div>

        </li>

    </ul><!-- End children -->
@endforeach


