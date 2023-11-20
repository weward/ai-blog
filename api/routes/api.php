<?php

use App\Http\Controllers\AIArticleController;
use App\Http\Controllers\DocumentController;
use App\Models\Document;
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

Route::bind('document', function($param) {
    return Document::findOrFail($param);
});

Route::prefix('documents')->group(function() {
    Route::get('/', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('/', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('{document}', [DocumentController::class, 'show'])->name('documents.show');

    Route::post('/article-plot', [AIArticleController::class, 'generatePlot'])->name('documents.article-plot');
    Route::post('/article-result', [AIArticleController::class, 'generateResult'])->name('documents.article-result');

});
