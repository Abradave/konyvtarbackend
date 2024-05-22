<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::apiResource("/books", BookController::class);
Route::post("/books/{id}/rent", [BookController::class, "renting"]);
