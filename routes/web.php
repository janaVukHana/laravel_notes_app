<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TrashNoteController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Auth::routes();

Route::resource('/notes', NoteController::class)->middleware('auth');

Route::get('/trashed', [TrashNoteController::class, 'index'])->middleware('auth')->name('trashed.index');
Route::get('/trashed/{note}', [TrashNoteController::class, 'show'])->withTrashed()->middleware('auth')->name('trashed.show');
Route::put('/trashed/{note}', [TrashNoteController::class, 'update'])->withTrashed()->middleware('auth')->name('trashed.update');
Route::delete('/trashed/{note}', [TrashNoteController::class, 'destroy'])->withTrashed()->middleware('auth')->name('trashed.destroy');
