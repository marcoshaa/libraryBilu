<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
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

Route::get('/', function () {
    return view('login');
});

Route::prefix('/ADM')->group(function(){
    
});

Route::get('/inicio', function() {
    return view('home');
});

Route::prefix('/livros')->group(function(){
    Route::get('/', [BookController::class, 'index'])->name('getBooks');
    Route::post('/criar', [BookController::class, 'create'])->name('createBook');
    Route::put('/editar/{id}', [BookController::class, 'update'])->name('updateBook');
});