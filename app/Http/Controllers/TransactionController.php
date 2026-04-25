<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    public function showPayment(Listing $listing)
    {
        $authorization = Gate::inspect('purchase-listing', $listing);

        if ($authorization->denied()) {
            return redirect()->route('buy')->with('error', $authorization->message());
        }

        return view('paymentPage', compact('listing'));
    }

    public function processPayment(Request $request, Listing $listing)
    {
        $request->validate([
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|digits_between:12,19',
            'expiry' => ['required|max:5', 'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/'],
            'cvv' => 'required|digits_between:3,4',
        ]);

        $authorization = Gate::inspect('purchase-listing', $listing);

        if ($authorization->denied()) {
            return redirect()->route('buy')->with('error', $authorization->message());
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

        session(['last_transaction_id' => $transaction->id]);

        // Redirect to the new receipt route, passing the transaction ID
        return redirect()->route('payment.receipt', $transaction->id)
                         ->with('success', 'Payment successful. Your property purchase is completed.')
                         ->cookie('last_transaction_id', (string) $transaction->id, 60 * 24 * 30);
    }

    // Add this new method to handle the receipt view
    public function showReceipt($id)
    {
        // Eager load the relationships used in your receipt blade file
        $transaction = Transaction::with(['buyer', 'seller', 'listing.property.address'])->findOrFail($id);

        $this->authorize('view', $transaction);

        // Make sure the view name matches the name of your receipt blade file (e.g., 'receipt')
        return view('paymentReceiptPage', compact('transaction')); 
    }
}