<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','WelcomeController@index')->name('welcome');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile/{id}', 'ProfileController@update')->name('profile.update');

    // Questions
    Route::resource('questions', 'QuestionController')->except('show');
    // Questions vote
    Route::get('question/{id}/upvote', 'QuestionController@upvote')->name('questions.upvote');
    Route::get('question/{id}/downvote', 'QuestionController@downvote')->name('questions.downvote');

    // Answer
    Route::post('answer/store', 'AnswerController@store')->name('answer.store');
    // Answers vote
    Route::get('answer/{id}/upvote', 'AnswerController@upvote')->name('answer.upvote');
    Route::get('answer/{id}/downvote', 'AnswerController@downvote')->name('answer.downvote');

    // Comment vote
    Route::get('comment/{id}/upvote', 'AnswerController@upvoteReply')->name('comment.upvote');
    Route::get('comment/{id}/downvote', 'AnswerController@downvoteReply')->name('comment.downvote');

    // Answers best answer
    Route::get('answer/{id}/best', 'AnswerController@markAsBestAnswer')->name('answer.best');
    Route::get('answer/{id}/not-best', 'AnswerController@unmarkAsBestAnswer')->name('answer.not-best');

    // Answers Replies
    Route::post('answer/reply', 'AnswerController@replyStore')->name('answer.reply');

});
Route::get('questions/{id}', 'QuestionController@show')->name('questions.show');
// Search
Route::get('search', 'SearchController@search')->name('search');
Route::get('tags/{tag}', 'SearchController@searchByTag')->name('tag');


