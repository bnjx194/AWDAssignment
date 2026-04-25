<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function showPayment(Listing $listing)
    {
        if ($listing->status !== 'active') {
            return redirect()->route('buy')->with('error', 'This listing is no longer available.');
        }

        return view('paymentPage', compact('listing'));
    }

    public function processPayment(Request $request, Listing $listing)
    {
        $request->validate([
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|digits_between:12,19',
            'expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/'],
            'cvv' => 'required|digits_between:3,4',
        ]);

        if ($listing->status !== 'active') {
            return redirect()->route('buy')->with('error', 'This listing has already been purchased.');
        }

        if (Auth::id() === $listing->seller_id) {
            return back()->withErrors(['card_name' => 'You cannot purchase your own listing.'])->withInput();
        }

        // Capture the transaction object returned from the DB closure
        $transaction = DB::transaction(function () use ($listing) {
            $listing->update(['status' => 'sold']);

            return Transaction::create([
                'listing_id' => $listing->id,
                'buyer_id' => Auth::id(),
                'seller_id' => $listing->seller_id,
                'final_price' => $listing->price,
                'status' => 'completed',
                'completed_at' => now(),
            ]);
        });

        // Redirect to the new receipt route, passing the transaction ID
        return redirect()->route('payment.receipt', $transaction->id)
                         ->with('success', 'Payment successful. Your property purchase is completed.');
    }

    // Add this new method to handle the receipt view
    public function showReceipt($id)
    {
        // Eager load the relationships used in your receipt blade file
        $transaction = Transaction::with(['buyer', 'seller', 'listing.property.address'])->findOrFail($id);

        // Security check: Only allow the buyer (or seller) to view this specific receipt
        if (Auth::id() !== $transaction->buyer_id && Auth::id() !== $transaction->seller_id) {
            abort(403, 'Unauthorized access to this receipt.');
        }

        // Make sure the view name matches the name of your receipt blade file (e.g., 'receipt')
        return view('paymentReceiptPage', compact('transaction')); 
    }
}