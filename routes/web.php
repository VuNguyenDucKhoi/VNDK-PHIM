<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;

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

// -------------Frontend-------------- //
Route::get('/',[IndexController::class, 'home'])->name('home');
Route::get('/search',[IndexController::class, 'search'])->name('search');
Route::get('/danh-muc/{slug}',[IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}',[IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class, 'country'])->name('country');
Route::get('/year/{year}',[IndexController::class, 'year']);
Route::get('/phim/{slug}',[IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}',[IndexController::class, 'watch']);
Route::get('/tag/{tag}',[IndexController::class, 'tag']);
Route::get('/episode',[IndexController::class, 'episode'])->name('episode');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
// -------------End-------------- //

// ---------------Admin-------------- //
Route::namespace('Backend')->prefix('admin')->name('admin.')->group(function (){
    Route::namespace('Auth')->middleware('guest:admin')->group(function (){
        //login route
        Route::get('login','AuthenticatedSessionController@create')->name('login');
        Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
    });
    Route::middleware('admin')->group(function (){
        Route::get('dashboard','HomeController@index')->name('dashboard');
        Route::resource('category', CategoryController::class);
        Route::post('resorting', [\App\Http\Controllers\Backend\CategoryController::class, 'resorting'])->name('resorting');
        Route::resource('genre', GenreController::class);
        Route::resource('country', CountryController::class);
        Route::resource('movie', MovieController::class);
        Route::post('update-year-movie', [\App\Http\Controllers\Backend\MovieController::class, 'update_year'])->name('update-year-movie');
        Route::post('update-season-movie', [\App\Http\Controllers\Backend\MovieController::class, 'update_season'])->name('update-season-movie');
        Route::get('select-movie',[\App\Http\Controllers\Backend\EpisodeController::class, 'select_movie'])->name('select-movie');
        Route::resource('episode', EpisodeController::class);

    });
    Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
});
// -------------End-------------- //
