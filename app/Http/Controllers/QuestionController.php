<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Traits\ImageUpload;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuestionController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        $questions = Question::where('user_id', Auth::id())->latest()->paginate(10);
        return view('pages.questions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required|string|max:225|unique:questions',
           'description' => 'required|string'
        ]);


        $data = $request->all();
        unset($data['images']);
        if($request->has('images')) {
            $images = [];
            foreach ($request->images as $image) {
                $stored_image = $this->uploadImage($image, 'uploaded/questions', 60);
                // $stored_image = 'uploaded/questions/image3.png'
                $images[] = $stored_image;
                // $images = ['uploaded/questions/image1.png', 'uploaded/questions/image2.png', 'uploaded/questions/image3.png']
            }
            $images = json_encode($images);
            // $images =  "['uploaded/questions/image1.png', 'uploaded/questions/image2.png', 'uploaded/questions/image3.png']"
            $data['images'] = $images;
        }

        $data['user_id'] = Auth::id();

        Question::create($data);
        return redirect()->route('questions.index')->with('success', 'Question added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $question = Question::findOrFail($id);
        $question->views +=1;
        $question->save();
        $numOfAnswers = $question->answers()->count();
        return view('pages.questions.show', ['question' => $question, 'numOfAnswers' => $numOfAnswers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|Response|View
     */
    public function edit(int $id)
    {
        $question = Question::findOrFail($id);
        return view('pages.questions.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:225|unique:questions,id,' . $id,
            'description' => 'required|string'
        ]);
        $data = $request->all();
        unset($data['images']);
        if($request->has('images')) {
            $images = [];
            foreach ($request->images as $image) {
                $image = $this->uploadImage($image, 'uploaded/questions', 60);
                $images[] = $image;
            }
            $images = json_encode($images);
            $data['images'] = $images;
        }

        $question->update($data);
        return redirect()->route('questions.index')->with('success', 'Question update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }

    public function upvote($id): \Illuminate\Http\RedirectResponse
    {
        $question = Question::findOrFail($id);
        $question->votes +=1;
        $question->save();
        return redirect()->route('questions.show', $id)->with('success', 'Question is upvoted successfully');
    }

    public function downvote($id): \Illuminate\Http\RedirectResponse
    {
        $question = Question::findOrFail($id);
        $question->votes -=1;
        $question->save();
        return redirect()->route('questions.show', $id)->with('success', 'Question is downvoted successfully');
    }
}
