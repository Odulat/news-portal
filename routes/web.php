<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
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

Route::prefix('admin')
    ->middleware('auth')
    ->group(
        function () {
            Route::get('/', [ArticleController::class, 'index'])
                ->name('admin.index');

            Route::prefix('article')->group(
                function () {
                    Route::post('create', [ArticleController::class, 'store'])
                        ->name('admin.article.store');
                    Route::get('edit/{article}', [ArticleController::class, 'edit'])
                         ->name('admin.article.edit');
                    Route::put('{article}', [ArticleController::class, 'update'])->name('admin.article.update');
                    Route::delete('destroy/{article}', [ArticleController::class, 'destroy'])
                         ->name('admin.article.destroy');
                }
            );

            Route::prefix('category')->group(
                function () {
                    Route::get('create', [CategoryController::class, 'index'])
                        ->name('admin.category.index');

                    Route::post('create', [CategoryController::class, 'store'])
                        ->name('admin.category.create');
                }
            );
        }
    )
;

Route::get('/', [\App\Http\Controllers\ArticleController::class, 'index'])
    ->name('index');

Route::get('article/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])
    ->name('show');

require __DIR__.'/auth.php';
