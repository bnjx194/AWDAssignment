<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

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
Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/sell', function () {
        return view('sellPage');
    });

    Route::post('/sell', [PropertyController::class, 'store'])->name('property.store');

    Route::get('/buy/{listing}/payment', [TransactionController::class, 'showPayment'])->name('payment.show');
    Route::post('/buy/{listing}/payment', [TransactionController::class, 'processPayment'])->name('payment.process');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/payment/receipt/{id}', [TransactionController::class, 'showReceipt'])->name('payment.receipt');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::put('/listings/{listing}/status', [AdminController::class, 'updateListingStatus'])->name('admin.listings.status');
    Route::delete('/listings/{listing}', [AdminController::class, 'deleteListing'])->name('admin.listings.delete');
});
