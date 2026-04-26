<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

//Public Routes
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

//Authentication Routes
Auth::routes();

Route::get('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

//Authenticated User Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Properties
    Route::get('/property', function () {
        $user = auth()->user();

        if ($user->role === 'seller') {
            return redirect()->route('sell');
        }

        return redirect()->route('buy');
    })->name('property.index');
    
    Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show');
    Route::get('/sell', function () {
        return view('sellPage');
    })->middleware('role:seller,admin')->name('sell');
    Route::post('/sell', [PropertyController::class, 'store'])->middleware('role:seller,admin')->name('property.store');

    // Listings & Search
    Route::get('/buy', [ListingController::class, 'buy'])->middleware('role:buyer,admin')->name('buy');
    Route::get('/buy/{search}', [ListingController::class, 'search'])->middleware('role:buyer,admin')->name('search');

    // Transactions & Payment
    Route::get('/buy/{listing}/payment', [TransactionController::class, 'showPayment'])->middleware('role:buyer,admin')->name('payment.show');
    Route::post('/buy/{listing}/payment', [TransactionController::class, 'processPayment'])->middleware('role:buyer,admin')->name('payment.process');
    Route::get('/payment/receipt/{id}', [TransactionController::class, 'showReceipt'])->middleware('role:buyer,admin')->name('payment.receipt');

});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Management
    Route::put('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Listing Management
    Route::put('/listings/{listing}/status', [AdminController::class, 'updateListingStatus'])->name('admin.listings.status');
    Route::delete('/listings/{listing}', [AdminController::class, 'deleteListing'])->name('admin.listings.delete');

});