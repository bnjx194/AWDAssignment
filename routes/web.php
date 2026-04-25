<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProfileController;

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

Route::get('/about', function () {
    return view('aboutPage');
})->name('about');

Route::get('/contact', function () {
    return view('contactPage');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:30',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:2000',
    ]);

    return back()->with('success', 'Thank you for contacting REM. We will reply soon.');
})->name('contact.submit');

Route::get('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/buy', [App\Http\Controllers\ListingController::class, 'buy'])->name('buy');
    Route::get('/buy/{search}', [App\Http\Controllers\ListingController::class, 'search'])->name('search');
});

Route::get('/property', [PropertyController::class, 'index'])->name('property.index');
Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show'); //search

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/sell', function () {
        return view('sellPage');
    });
    Route::post('/sell', [PropertyController::class, 'store'])->name('property.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/sell', function () {
        return view('sellPage');
    });
    Route::post('/sell', [PropertyController::class, 'store']);
});

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
Route::post('/sell', [PropertyController::class, 'store']);
