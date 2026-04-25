<x-header/>
<main class="detail-wrap">
    <section class="detail-panel">
        <div class="detail-media">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" alt="Property image">
            @else
                <div class="detail-media-placeholder">No Property Image</div>
            @endif
        </div>

        <div class="detail-content">
            <p class="detail-kicker">Property Details</p>
            <h1>{{ Str::limit($property->description, 80) }}</h1>

            <p class="detail-address">
                {{ $property->address->address ?? 'Address unavailable' }}
                @if($property->address && $property->address->postal_code)
                    , {{ $property->address->postal_code }}
                @endif
                @if($property->address && $property->address->country)
                    , {{ $property->address->country }}
                @endif
            </p>

            <div class="detail-stat-grid">
                <div class="detail-stat"><strong>{{ $property->bedrooms ?? 0 }}</strong><span>Bedrooms</span></div>
                <div class="detail-stat"><strong>{{ $property->bathrooms ?? 0 }}</strong><span>Bathrooms</span></div>
                <div class="detail-stat"><strong>{{ $property->sqft ?? 0 }}</strong><span>sqft</span></div>
                <div class="detail-stat">
                    <strong>
                        @if($listing && $listing->price)
                            RM {{ number_format($listing->price) }}
                        @else
                            N/A
                        @endif
                    </strong>
                    <span>Price</span>
                </div>
            </div>

            <div class="detail-actions">
                <a href="{{ route('buy') }}" class="detail-btn detail-btn-primary">Back to Listings</a>
                <a href="{{ route('property.index') }}" class="detail-btn detail-btn-secondary">All Properties</a>
            </div>
        </div>
    </section>
</main>
<x-footer/>

<style>
.detail-wrap {
    min-height: calc(100vh - 200px);
    background: linear-gradient(180deg, #f2f8ff 0%, #ffffff 60%);
    padding: 2rem 1.25rem 3rem;
}

.detail-panel {
    max-width: 1100px;
    margin: 0 auto;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid #dce7f4;
    box-shadow: 0 16px 30px rgba(15, 36, 58, 0.12);
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.detail-media {
    min-height: 340px;
    background: #e8edf4;
}

.detail-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.detail-media-placeholder {
    width: 100%;
    height: 100%;
    display: grid;
    place-items: center;
    color: #667585;
    font-weight: 600;
}

.detail-content {
    padding: 1.5rem;
}

.detail-kicker {
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.76rem;
    color: #4f6072;
}

.detail-content h1 {
    margin: 0.5rem 0 0;
    font-size: clamp(1.3rem, 2.4vw, 2rem);
    line-height: 1.28;
    color: #0e223a;
}

.detail-address {
    margin: 0.95rem 0 0;
    color: #576879;
    line-height: 1.6;
}

.detail-stat-grid {
    margin-top: 1.2rem;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.65rem;
}

.detail-stat {
    background: #f3f8ff;
    border: 1px solid #d8e6f6;
    border-radius: 12px;
    padding: 0.8rem;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.detail-stat strong {
    color: #0e223a;
    font-size: 1rem;
}

.detail-stat span {
    color: #576879;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

.detail-actions {
    margin-top: 1.25rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.65rem;
}

.detail-btn {
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    padding: 0.65rem 1rem;
}

.detail-btn-primary {
    background: #0b2240;
    color: #fff;
}

.detail-btn-secondary {
    background: #fff;
    color: #0b2240;
    border: 1px solid #c7d6e6;
}

@media (max-width: 860px) {
    .detail-panel {
        grid-template-columns: 1fr;
    }

    .detail-media {
        min-height: 250px;
    }
}
</style>