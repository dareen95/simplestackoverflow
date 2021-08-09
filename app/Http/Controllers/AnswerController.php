<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request) {
        $request->validate([
           'answer_content' => 'required|string|min:3',
           'question_id' => 'required'
        ]);

        Answer::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
            'content' => $request->answer_content
        ]);
        return redirect()->route('questions.show', $request->question_id)->with('success', 'Answer added successfully');
    }

    public function upvote($id): \Illuminate\Http\RedirectResponse
    {
        $answer = Answer::findOrFail($id);
        $answer->votes +=1;
        $answer->save();
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Answer is upvoted successfully');
    }

    public function downvote($id): \Illuminate\Http\RedirectResponse
    {
        $answer = Answer::findOrFail($id);
        $answer->votes -=1;
        $answer->save();
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Answer is downvoted successfully');
    }

    public function markAsBestAnswer($id): \Illuminate\Http\RedirectResponse
    {
        $answer = Answer::findOrFail($id);
        $answer->accepted = 1;
        $answer->save();
        $answer->question->solved = 1;
        $answer->question->save();
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Answer is marked as the best answer successfully');
    }

    public function unmarkAsBestAnswer($id): \Illuminate\Http\RedirectResponse
    {
        $answer = Answer::findOrFail($id);
        $answer->accepted = 0;
        $answer->save();
        $answer->question->solved = 0;
        $answer->question->save();
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Answer is unmarked as the best answer successfully');
    }

    public function replyStore(Request $request) {
        $answer = Answer::findOrFail($request->answer_id);
        $request->validate([
            'comment_content' => 'required|string|min:3'
        ]);

        if ($request->has('comment_id')) {
            $comment_id = $request->comment_id;
        } else {
            $comment_id = NULL;
        }

        Comment::create([
            'user_id' => Auth::id(),
            'commentable_type' => 'App\Models\Answer',
            'commentable_id' => $request->answer_id,
            'content' => $request->comment_content,

        ]);

        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Reply is added successfully');
    }

    public function upvoteReply($id): \Illuminate\Http\RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->votes +=1;
        $comment->save();
        return redirect()->route('questions.show', $comment->commentable->question_id)->with('success', 'Reply is upvoted successfully');
    }

    public function downvoteReply($id): \Illuminate\Http\RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->votes -=1;
        $comment->save();
        return redirect()->route('questions.show', $comment->commentable->question_id)->with('success', 'Reply is downvoted successfully');
    }

}
