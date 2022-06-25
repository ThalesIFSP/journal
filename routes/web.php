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
use App\Http\Controllers\JournalController;

Route::get('/', [JournalController::class, 'index']);
Route::get('/journals/create', [JournalController::class, 'create'])->middleware('auth');
Route::get('/journals/{id}', [JournalController::class, 'show']);
Route::post('/journals', [JournalController::class, 'store']);
Route::delete('/journals/{id}', [JournalController::class, 'destroy'])->middleware('auth');
Route::get('/journals/edit/{id}', [JournalController::class, 'edit'])->middleware('auth');
Route::put('/journals/update/{id}', [JournalController::class, 'update'])->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', [JournalController::class, 'dashboard'])->middleware('auth');
Route::post('/journals/join/{id}', [JournalController::class, 'joinEvent'])->middleware('auth');
Route::delete('/journals/leave/{id}', [JournalController::class, 'leaveEvent'])->middleware('auth');
