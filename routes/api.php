<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MembersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function(){
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('Author' , AuthorController::class);
    Route::apiResource('Book' , BookController::class);
    Route::post('logout', [AuthController::class , 'logout']);
    
    Route::apiResource('Members', MembersController::class);
    Route::apiResource('Borrow', BorrowingController::class)->only(['index', 'store', 'show']);
    
    Route::post('/Borrowing/{borrowing}/return', [BorrowingController::class , 'returnBook']);
    Route::get('/Borrowing/overdue',[BorrowingController::class, 'overdue']);
});
});



// Authentication Route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/Login' , [AuthController::class , 'login']);
