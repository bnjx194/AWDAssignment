<x-header/>
<main class="sell-wrap">
    <section class="sell-hero">
        <p class="sell-kicker">Seller Portal</p>
        <h1>Create Listing For Your Property</h1>
        <p>Fill in your property details below and publish your listing to reach buyers quickly.</p>
    </section>

    @if (session('error'))
        <div class="sell-alert sell-alert-error">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="sell-alert sell-alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/sell" enctype="multipart/form-data" onsubmit="return confirm('Do you want to list this property now?')" class="sell-form">
        @csrf

        @if ($errors->any())
            <div class="form-errors">
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-section">
            <h2>Property Details</h2>

            <div class="field-block field-full">
                <label for="description">Property Description</label>
                <textarea id="description" name="description" placeholder="Describe your property......" required>{{ old('description') }}</textarea>
            </div>

            <div class="field-grid">
                <div class="field-block">
                    <label for="bedrooms">Bedrooms</label>
                    <input type="number" id="bedrooms" name="bedrooms" placeholder="Number of Bedrooms" value="{{ old('bedrooms') }}" required>
                </div>
                <div class="field-block">
                    <label for="bathrooms">Bathrooms</label>
                    <input type="number" id="bathrooms" name="bathrooms" placeholder="Number of Bathrooms" value="{{ old('bathrooms') }}" required>
                </div>
                <div class="field-block">
                    <label for="sqft">Area (sqft)</label>
                    <input type="number" id="sqft" name="sqft" placeholder="e.g. 1200" value="{{ old('sqft') }}" required>
                </div>
                <div class="field-block">
                    <label for="image">Property Image</label>
                    <input type="file" id="image" name="image" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Address</h2>
            <div class="field-grid">
                <div class="field-block field-full">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Street Address" value="{{ old('address') }}" required>
                </div>
                <div class="field-block">
                    <label for="postal_code">Postal Code</label>
                    <input type="number" id="postal_code" name="postal_code" placeholder="e.g. 43200" value="{{ old('postal_code') }}" required>
                </div>
                <div class="field-block">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" placeholder="e.g. Malaysia" value="{{ old('country') }}" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Listing Info</h2>
            <div class="field-grid">
                <div class="field-block">
                    <label for="price">Price (RM)</label>
                    <input type="number" id="price" name="price" placeholder="e.g. 1200000" value="{{ old('price') }}" required>
                </div>
            </div>
        </div>

        <button type="submit" class="submit-btn">Save Property</button>
    </form>
</main>

<x-footer/>

<style>
    .sell-wrap {
        min-height: calc(100vh - 200px);
        background: linear-gradient(180deg, #f2f8ff 0%, #ffffff 62%);
        padding: 2rem 1.2rem 3rem;
    }

    .sell-hero {
        max-width: 980px;
        margin: 0 auto 1.2rem;
        background: linear-gradient(120deg, #09203f 0%, #537895 100%);
        color: #fff;
        border-radius: 18px;
        padding: 2rem 1.3rem;
        box-shadow: 0 14px 30px rgba(9, 32, 63, 0.24);
    }

    .sell-kicker {
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 0.78rem;
        opacity: 0.92;
    }

    .sell-hero h1 {
        margin: 0.45rem 0 0;
        font-size: clamp(1.4rem, 3.3vw, 2.2rem);
    }

    .sell-hero p {
        margin: 0.7rem 0 0;
        color: rgba(255, 255, 255, 0.92);
        line-height: 1.6;
    }

    .sell-form {
        max-width: 980px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #dce7f4;
        border-radius: 16px;
        box-shadow: 0 10px 24px rgba(15, 36, 58, 0.1);
        padding: 1rem;
    }

    .sell-alert {
        max-width: 980px;
        margin: 0 auto 0.9rem;
        border-radius: 10px;
        padding: 0.8rem 1rem;
        font-size: 0.93rem;
    }

    .sell-alert-error {
        border: 1px solid #f3c2c5;
        background: #fff0f1;
        color: #7e1f27;
    }

    .sell-alert-success {
        border: 1px solid #bcead0;
        background: #edfdf3;
        color: #1f7042;
    }

    .form-errors {
        border: 1px solid #f3c2c5;
        background: #fff0f1;
        color: #7e1f27;
        border-radius: 10px;
        padding: 0.8rem;
        margin-bottom: 0.9rem;
    }

    .form-errors ul {
        margin: 0.45rem 0 0;
        padding-left: 1.2rem;
    }

    .form-section {
        border: 1px solid #dce7f4;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.85rem;
        background: #fbfdff;
    }

    .form-section h2 {
        margin: 0;
        color: #122c46;
        font-size: 1.05rem;
    }

    .field-grid {
        margin-top: 0.8rem;
        display: grid;
        gap: 0.8rem;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .field-block {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .field-full {
        grid-column: 1 / -1;
    }

    .field-block label {
        font-weight: 600;
        color: #2f4459;
    }

    .field-block input[type="text"],
    .field-block input[type="number"],
    .field-block input[type="file"],
    .field-block textarea {
        width: 100%;
        border: 1px solid #c9d8e8;
        border-radius: 10px;
        padding: 0.65rem 0.7rem;
        background: #fff;
        color: #1b2a3a;
        box-sizing: border-box;
    }

    .field-block textarea {
        min-height: 115px;
        resize: vertical;
    }

    .field-block input:focus,
    .field-block textarea:focus {
        outline: none;
        border-color: #7ea6cf;
        box-shadow: 0 0 0 3px rgba(126, 166, 207, 0.2);
    }

    .submit-btn {
        width: 100%;
        border: none;
        border-radius: 11px;
        padding: 0.78rem 1rem;
        background: #0b2240;
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(11, 34, 64, 0.28);
    }

    @media (max-width: 720px) {
        .field-grid {
            grid-template-columns: 1fr;
        }
    }
</style>