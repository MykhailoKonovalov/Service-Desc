<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerProblems;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'ControllerProblems@create');
Route::post('/problems', 'ControllerProblems@store');

//Route::resource('/problems', 'ControllerProblems')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/problems', 'ControllerProblems@index');
    Route::get('/problems/{id}/edit', 'ControllerProblems@edit');
    Route::put('/problems/sendToExperts/{id}', 'ControllerProblems@sendToExperts');
    Route::post('/problems/answer/{id}/{theme}/{product}', 'ControllerProblems@answer');
    Route::put('/problems/addAnswer/{solution_id}/{product_id}', 'ControllerProblems@addAnswer');
});


Route::get('/feedback', function () {
    return view('containers.problems.feedback');
});

Route::get('/solutions/feedback', function () {
    return view('containers.solutions.feedback');
});

Route::resource('/solutions', 'ControllerSolutions')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@update');

Route::get('/send-email', 'ControllerMail@send');
