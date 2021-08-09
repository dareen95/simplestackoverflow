<aside class="col-md-3 sidebar">
    <div class="widget widget_stats">
        <h3 class="widget_title">Stats</h3>
        <div class="ul_list ul_list-icon-ok">
            <ul>
                <li><i class="icon-question-sign"></i>Questions ( <span>{{ \App\Models\Question::count() }}</span> )</li>
                <li><i class="icon-comment"></i>Answers ( <span>{{ \App\Models\Answer::count() }}</span> )</li>
            </ul>
        </div>
    </div>

    <div class="widget">
        <h3 class="widget_title">Recent Questions</h3>
        @php
        $recent_questions = \App\Models\Question::latest()->take(2)->get();
        @endphp
        <ul class="related-posts">
            @foreach($recent_questions as $question)
            <li class="related-item">
                <h3><a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a></h3>
                <p>{{ $question->content }}</p>
                <div class="clear"></div><span>{{ \Carbon\Carbon::make($question->created_at) }}</span>
            </li>
            @endforeach
        </ul>
    </div>

</aside><!-- End sidebar -->
