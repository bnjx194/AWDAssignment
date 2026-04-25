@extends('layouts.app')

@section('content')
<main class="receipt-wrap">
    <section class="receipt-card">
        <p class="receipt-kicker">Payment Success</p>
        <h1>Receipt</h1>
        <p class="receipt-subtext">Your payment has been completed successfully.</p>

        <div class="receipt-grid">
            <div>
                <span class="receipt-label">Receipt No.</span>
                <strong>#REM-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</strong>
            </div>
            <div>
                <span class="receipt-label">Paid On</span>
                <strong>{{ optional($transaction->completed_at)->format('d M Y, h:i A') }}</strong>
            </div>
            <div>
                <span class="receipt-label">Buyer</span>
                <strong>{{ optional($transaction->buyer)->name ?? 'N/A' }}</strong>
            </div>
            <div>
                <span class="receipt-label">Seller</span>
                <strong>{{ optional($transaction->seller)->name ?? 'N/A' }}</strong>
            </div>
        </div>

        <div class="receipt-property">
            <h2>Property Summary</h2>
            <p>{{ Str::limit(optional(optional($transaction->listing)->property)->description ?? 'Property description unavailable', 90) }}</p>
            <p>{{ optional(optional(optional($transaction->listing)->property)->address)->address ?? 'Address unavailable' }}</p>
            <div class="receipt-total">Total Paid: RM {{ number_format($transaction->final_price, 2) }}</div>
        </div>

        <div class="receipt-actions">
            <a href="{{ route('buy') }}" class="receipt-btn receipt-btn-primary">Back to Listings</a>
            <a href="{{ route('home') }}" class="receipt-btn receipt-btn-secondary">Go to Home</a>
        </div>
    </section>
</main>

<style>
.receipt-wrap {
    min-height: calc(100vh - 200px);
    background: linear-gradient(180deg, #f2f8ff 0%, #ffffff 60%);
    padding: 2rem 1.25rem 3rem;
}

.receipt-card {
    max-width: 760px;
    margin: 0 auto;
    background: #fff;
    border: 1px solid #dce7f4;
    border-radius: 14px;
    padding: 1.3rem;
    box-shadow: 0 10px 22px rgba(15, 36, 58, 0.08);
}

.receipt-kicker {
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.75rem;
    color: #4f6072;
}

.receipt-card h1 {
    margin: 0.35rem 0 0;
    color: #102a44;
}

.receipt-subtext {
    margin: 0.55rem 0 1rem;
    color: #5b6d7e;
}

.receipt-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.75rem;
}

.receipt-grid > div {
    border: 1px solid #dce7f4;
    border-radius: 10px;
    padding: 0.7rem;
    background: #fbfdff;
}

.receipt-label {
    display: block;
    font-size: 0.76rem;
    color: #637484;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

.receipt-grid strong {
    color: #102a44;
    font-size: 0.95rem;
}

.receipt-property {
    margin-top: 0.9rem;
    border: 1px solid #dce7f4;
    border-radius: 10px;
    padding: 0.85rem;
}

.receipt-property h2 {
    margin: 0;
    color: #102a44;
    font-size: 1rem;
}

.receipt-property p {
    margin: 0.45rem 0 0;
    color: #5b6d7e;
    line-height: 1.6;
}

.receipt-total {
    margin-top: 0.8rem;
    font-size: 1.1rem;
    color: #0e223a;
    font-weight: 700;
}

.receipt-actions {
    margin-top: 1rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
}

.receipt-btn {
    text-decoration: none;
    border-radius: 9px;
    padding: 0.58rem 0.9rem;
    font-size: 0.86rem;
    font-weight: 600;
}

.receipt-btn-primary {
    background: #0b2240;
    color: #fff;
}

.receipt-btn-secondary {
    background: #fff;
    color: #0b2240;
    border: 1px solid #c7d6e6;
}

@media (max-width: 760px) {
    .receipt-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
