<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;

Route::prefix('/')->group(function () {        
    Route::get('/', [LoginController::class, 'index'])->name('index');
    Route::post('/entrar', [LoginController::class, 'login'])->name('login');
    Route::post('/sair', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('/ADM')->middleware('auth')->group(function(){
    
});

Route::get('/inicio',[HomeController::class, 'index'])->middleware('auth')->name('inicio');

Route::prefix('/livros')->middleware('auth')->group(function(){
    Route::get('/', [BookController::class, 'index'])->name('getBooks');
    Route::post('/criar', [BookController::class, 'create'])->name('createBook');
    Route::put('/editar/{id}', [BookController::class, 'update'])->name('updateBook');
});