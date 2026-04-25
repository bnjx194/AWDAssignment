<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'sellers' => User::where('role', 'seller')->count(),
            'buyers' => User::where('role', 'buyer')->count(),
            'properties_for_sale' => Listing::where('status', 'active')->count(),
            'transactions' => Transaction::count(),
        ];

        $users = User::latest()->take(8)->get();
        $listings = Listing::with('property.address', 'seller')->latest()->take(10)->get();
        $transactions = Transaction::with('buyer', 'seller', 'listing')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'users', 'listings', 'transactions'));
    }

    public function updateListingStatus(Request $request, Listing $listing)
    {
        $request->validate([
            'status' => 'required|in:active,pending,sold,closed',
        ]);

        $listing->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Listing status updated successfully.');
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:seller,buyer',
        ]);

        if (Auth::id() === $user->id) {
            return redirect()->route('admin.dashboard')->with('error', 'You cannot change your own role from this page.');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Admin accounts cannot be downgraded or reassigned here.');
        }

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User role updated successfully.');
    }

    public function deleteUser(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.dashboard')->with('error', 'You cannot delete your own account.');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Admin accounts cannot be deleted from this page.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    public function deleteListing(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Listing deleted successfully.');
    }
}
