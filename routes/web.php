<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books', [App\Http\Controllers\BookController::class, 'index'])->name('books.index');
Route::get('/book/create', [App\Http\Controllers\BookController::class, 'create'])->name('book.create');
Route::get('/book/{book}/edit', [App\Http\Controllers\BookController::class, 'edit'])->name('book.edit');
Route::get('/book/download/{book}', [App\Http\Controllers\BookController::class, 'download'])->name('book.download');
Route::get('/book/{book}', [App\Http\Controllers\BookController::class, 'show'])->name('book.show');


