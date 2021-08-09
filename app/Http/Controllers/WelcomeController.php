<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $questions = Question::paginate(10);
        return view('pages.welcome', ['questions' => $questions]);
    }
}
