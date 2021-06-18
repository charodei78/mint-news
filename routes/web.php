<?php

use App\Http\Controllers\PostController;
use App\Http\Livewire\Index;
use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManager;
use \Illuminate\Http\Request;
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

Route::any('/test',function (Request $request) {

})->name('test');

//Route::get('/livewire/preview-file/{file}', function (Request $request, string $file) {
//    return Storage::download('livewire-tmp/' + $file);
//});

Route::resource('posts', PostController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/{type?}', Index::class)->name('index');

