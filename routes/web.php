<?php

declare(strict_types=1);

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
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

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::post('/uploads', [UploadController::class, 'upload'])->name('upload');

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/blog', [FrontController::class, 'blog'])->name('front.blog');
Route::get('/blog/{slug}', [FrontController::class, 'blogPage'])->name('front.blogPage');
Route::get('/page/{slug}', [FrontController::class, 'dynamicPage'])->name('front.dynamicPage');
Route::get('/generate-sitemap', [FrontController::class, 'generateSitemaps'])->name('generate-sitemaps');

Route::middleware('auth')->group(function () {
    Route::get('/mon-compte', [FrontController::class, 'myaccount'])->name('front.myaccount');
});

Route::fallback(function (Request $request) {
    return app()->make(ErrorController::class)->notFound($request);
});
