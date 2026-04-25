@extends('layouts.app')

@section('content')
<main class="payment-wrap">
    <section class="payment-panel">
        <div class="payment-summary">
            <p class="payment-kicker">Checkout</p>
            <h1>Complete Your Payment</h1>
            <p class="payment-subtext">Review your selected property and enter payment details to confirm this purchase.</p>

            <div class="payment-card">
                <div class="payment-image">
                    @if($listing->property->image)
                        <img src="{{ asset('storage/' . $listing->property->image) }}" alt="Property image">
                    @else
                        <div class="payment-image-placeholder">No Image</div>
                    @endif
                </div>

                <div class="payment-info">
                    <h2>{{ Str::limit($listing->property->description, 70) }}</h2>
                    <p>{{ $listing->property->address->address ?? 'Address unavailable' }}</p>
                    <div class="payment-tags">
                        <span>{{ $listing->property->bedrooms ?? 0 }} Beds</span>
                        <span>{{ $listing->property->bathrooms ?? 0 }} Baths</span>
                        <span>{{ $listing->property->sqft ?? 0 }} sqft</span>
                    </div>
                    <div class="payment-price">RM {{ number_format($listing->price, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="payment-form-wrap">
            <h2>Payment Details</h2>
            <form method="POST" action="{{ route('payment.process', $listing->id) }}" class="payment-form">
                @csrf

                <div class="payment-field">
                    <label for="card_name">Card Holder Name</label>
                    <input id="card_name" type="text" name="card_name" value="{{ old('card_name') }}" required>
                    @error('card_name')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="payment-field">
                    <label for="card_number">Card Number</label>
                    <input id="card_number" type="text" name="card_number" value="{{ old('card_number') }}" maxlength="19" required>
                    @error('card_number')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="payment-row">
                    <div class="payment-field">
                        <label for="expiry">Expiry (MM/YY)</label>
                        <input id="expiry" type="text" name="expiry" value="{{ old('expiry') }}" placeholder="MM/YY" required>
                        @error('expiry')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="payment-field">
                        <label for="cvv">CVV</label>
                        <input id="cvv" type="password" name="cvv" maxlength="4" required>
                        @error('cvv')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="pay-btn">Pay RM {{ number_format($listing->price, 2) }}</button>
                <a href="{{ route('buy') }}" class="back-link">Cancel and return to listings</a>
            </form>
        </div>
    </section>
</main>

<style>
.payment-wrap {
    min-height: calc(100vh - 200px);
    background: linear-gradient(180deg, #f2f8ff 0%, #ffffff 60%);
    padding: 2rem 1.25rem 3rem;
}

.payment-panel {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 1rem;
}

.payment-summary,
.payment-form-wrap {
    background: #fff;
    border: 1px solid #dce7f4;
    border-radius: 14px;
    padding: 1.2rem;
    box-shadow: 0 10px 22px rgba(15, 36, 58, 0.08);
}

.payment-kicker {
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.75rem;
    color: #4f6072;
}

.payment-summary h1 {
    margin: 0.4rem 0 0;
    color: #102a44;
}

.payment-subtext {
    margin: 0.6rem 0 1rem;
    color: #5b6d7e;
    line-height: 1.6;
}

.payment-card {
    border: 1px solid #dce7f4;
    border-radius: 12px;
    overflow: hidden;
}

.payment-image {
    height: 220px;
    background: #e8edf4;
}

.payment-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.payment-image-placeholder {
    width: 100%;
    height: 100%;
    display: grid;
    place-items: center;
    color: #667585;
    font-weight: 600;
}

.payment-info {
    padding: 1rem;
}

.payment-info h2 {
    margin: 0;
    color: #102a44;
    font-size: 1.02rem;
}

.payment-info p {
    margin: 0.45rem 0 0;
    color: #5b6d7e;
}

.payment-tags {
    margin-top: 0.7rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.45rem;
}

.payment-tags span {
    font-size: 0.78rem;
    padding: 0.25rem 0.55rem;
    border-radius: 999px;
    background: #eef4fa;
    color: #3d4c5b;
}

.payment-price {
    margin-top: 0.85rem;
    font-size: 1.2rem;
    font-weight: 700;
    color: #0e223a;
}

.payment-form-wrap h2 {
    margin: 0;
    color: #102a44;
}

.payment-form {
    margin-top: 0.9rem;
}

.payment-field {
    display: grid;
    gap: 0.4rem;
    margin-bottom: 0.8rem;
}

.payment-field label {
    color: #2b3b4b;
    font-weight: 600;
    font-size: 0.9rem;
}

.payment-field input {
    border: 1px solid #cbd9e7;
    border-radius: 9px;
    padding: 0.62rem 0.72rem;
    outline: none;
    font-size: 0.93rem;
}

.payment-field input:focus {
    border-color: #5a8bb6;
    box-shadow: 0 0 0 3px rgba(90, 139, 182, 0.16);
}

.payment-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.field-error {
    margin: 0;
    color: #a12626;
    font-size: 0.82rem;
}

.pay-btn {
    width: 100%;
    border: none;
    border-radius: 9px;
    background: #0b2240;
    color: #fff;
    font-weight: 700;
    padding: 0.72rem 1rem;
    cursor: pointer;
    margin-top: 0.2rem;
}

.back-link {
    display: inline-block;
    margin-top: 0.75rem;
    color: #244667;
    text-decoration: none;
    font-weight: 600;
}

@media (max-width: 900px) {
    .payment-panel {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
