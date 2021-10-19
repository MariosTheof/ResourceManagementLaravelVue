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

Route::get('/visitor', function () {
    return view('visitor');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::resource('links', \App\Http\Controllers\LinkController::class);
Route::resource('snippets', \App\Http\Controllers\SnippetController::class);
Route::resource('files', \App\Http\Controllers\FileController::class);
Route::post('/fileUpdate/{id}', [\App\Http\Controllers\FileController::class, 'updateFile']);

