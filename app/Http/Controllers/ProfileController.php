<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();

        $listedProperties = collect();
        $purchasedTransactions = collect();

        if ($user->role === 'seller') {
            $listedProperties = $user->properties()
                ->with(['address', 'listing'])
                ->latest()
                ->get();
        }

        if ($user->role === 'buyer') {
            $purchasedTransactions = $user->purchases()
                ->with(['listing.property.address'])
                ->latest()
                ->get();
        }

        return view('profile', compact('user', 'listedProperties', 'purchasedTransactions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
        ]);

        $user = Auth::user();
        $user->name  = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password changed successfully.');
    }
}