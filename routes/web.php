<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

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
    if(!Auth::check()){
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DocumentController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/upload', [DocumentController::class, 'create'])->middleware('auth')-> name('upload-page');
Route::post('/upload', [DocumentController::class, 'store'])->middleware('auth') -> name('upload');
Route::get('/download/{id}',[DocumentController::class, 'download'])->middleware('auth')-> name('download');
Route::get('/delete/{id}',[DocumentController::class, 'destroy'])->middleware('auth')-> name('delete');



require __DIR__.'/auth.php';
