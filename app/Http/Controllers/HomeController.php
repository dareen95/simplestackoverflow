<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('welcome');
        }
    }
}
