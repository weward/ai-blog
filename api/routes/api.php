<?php

use App\Http\Controllers\AIArticleController;
use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('documents')->group(function() {
    Route::get('/', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('/', [DocumentController::class, 'store'])->name('documents.store');

    Route::post('/article-plot', [AIArticleController::class, 'generatePlot'])->name('documents.article-plot');
    Route::post('/article-result', [AIArticleController::class, 'generateResult'])->name('documents.article-result');

});
