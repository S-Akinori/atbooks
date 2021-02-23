<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchingController;
use App\Http\Controllers\UpdateProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;

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
    return view('welcome');
});

Route::resource('/book', BookController::class);
Route::get('home', function() {
    return redirect()->route('home.index', Auth::user()->id);
});
Route::get('/home/{id}', [HomeController::class, 'index'])->name('home.index');
Route::get('/home/{id}/following', [FollowingController::class, 'followingIndex'])->name('follow.followingIndex');
Route::get('/home/{id}/followed', [FollowingController::class, 'FollowedIndex'])->name('follow.followedIndex');
Route::post('/home/{id}/following', [FollowingController::class, 'store'])->name('follow.store');
Route::delete('/home/{id}/following', [FollowingController::class, 'destroy'])->name('follow.destroy');

Route::get('/search', [SearchingController::class, 'index'])->name('search.index');
Route::patch('/user/profile/{id}', [UpdateProfileController::class, 'update'])->name('profile.update');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('home.index', Auth::user()->id);
})->name('dashboard');
