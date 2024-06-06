<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{ApiBookController, ApiAuthorController};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::prefix('/api-book')->name('api-book.')->group(function () {
    Route::get('/', [ApiBookController::class, 'index'])->name('index');
    Route::post('/', [ApiBookController::class, 'store'])->name('store');
    Route::get('/{id}/show', [ApiBookController::class, 'show'])->name('show');
    Route::put('/{id}', [ApiBookController::class, 'update'])->name('update');
    Route::post('/update/image', [ApiBookController::class, 'updateImage']);
    Route::get('/search-by-author', [ApiBookController::class, 'searchByAuthorLastName'])->name('search.books.by_author_lastname');
});

Route::prefix('/api-author')->name('api-author.')->group(function () {
    Route::get('/', [ApiAuthorController::class, 'index'])->name('index');
    Route::post('/', [ApiAuthorController::class, 'store'])->name('store');
    Route::get('/{id}', [ApiAuthorController::class, 'show'])->name('show');
    Route::put('/{id}', [ApiAuthorController::class, 'update'])->name('update');
});

//Route::get('/authors', [AuthorController::class, 'index']);
//Route::post('/authors', [AuthorController::class, 'store']);
//Route::get('/authors/{author}', [AuthorController::class, 'show']);
//Route::put('/authors/{author}', [AuthorController::class, 'update']);
//Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);
