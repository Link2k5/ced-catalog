<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GenreController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
        'categories' => CategoryController::class,
        'genres' => GenreController::class
    ]
);
