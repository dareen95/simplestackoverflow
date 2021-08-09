<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $questions = Question::where('title', 'LIKE', "%" .$request->search ."%")->paginate();
        return view('pages.search', ['questions' => $questions]);
    }

    public function searchByTag(string $tag) {
        $questions = Question::where('tags', 'LIKE', "%" .$tag ."%")->paginate();
        return view('pages.search', ['questions' => $questions]);
    }
}
