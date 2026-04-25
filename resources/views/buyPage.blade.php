<x-header />

<main class="property-page-wrap">
    <section class="property-page-head">
        <p class="property-page-kicker">Property Directory</p>
        <h1>All Registered Properties</h1>
        <p class="property-page-subtext">Browse properties uploaded by users and open each profile for full details.</p>
    </section>

    @if (session('success'))
        <div class="property-alert property-alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="property-alert property-alert-error">{{ session('error') }}</div>
    @endif

    <section class="property-grid">
        @forelse ($listings as $listing)
            <article class="property-card">
                <div class="property-card-image-wrap">
                    @if($listing->property->image)
                        <img src="{{ asset('storage/' . $listing->property->image) }}" alt="Property image">
                    @else
                        <div class="property-card-image-placeholder">No Image</div>
                    @endif
                </div>

                <div class="property-card-content">
                    <h3>{{ $listing->property->name ?? Str::limit($listing->property->description, 52) }}</h3>
                    <p>{{ $listing->property->address->address ?? 'Address unavailable' }}</p>
                    <div class="property-card-meta">
                        <span>{{ $listing->property->bedrooms ?? 0 }} Beds</span>
                        <span>{{ $listing->property->bathrooms ?? 0 }} Baths</span>
                        <span>{{ $listing->property->sqft ?? 0 }} sqft</span>
                    </div>

                    <div class="property-card-price">RM {{ number_format($listing->price, 2) }}</div>

                    <div class="property-card-actions">
                        <a href="{{ route('property.show', $listing->property->id) }}"
                            class="property-card-btn property-card-btn-secondary">View Details</a>
                    </div>
                </div>
            </article>
        @empty
            <div class="property-empty-state">
                No properties found yet.
            </div>
        @endforelse
    </section>

    <div class="property-pagination-wrap">
        {{ $listings->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</main>

<x-footer />

<style>
    .property-page-wrap {
        min-height: calc(100vh - 200px);
        background: linear-gradient(180deg, #f2f8ff 0%, #ffffff 60%);
        padding: 2rem 1.25rem 3rem;
    }

    .property-page-head {
        max-width: 1100px;
        margin: 0 auto 1.25rem;
        background: linear-gradient(120deg, #09203f 0%, #537895 100%);
        color: #fff;
        border-radius: 18px;
        padding: 2rem 1.4rem;
        box-shadow: 0 14px 30px rgba(9, 32, 63, 0.24);
    }

    .property-page-kicker {
        margin: 0 0 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 0.78rem;
        opacity: 0.9;
    }

    .property-page-head h1 {
        margin: 0;
        font-size: clamp(1.45rem, 3.2vw, 2.2rem);
    }

    .property-page-subtext {
        margin: 0.8rem 0 0;
        color: rgba(255, 255, 255, 0.9);
        max-width: 620px;
    }

    .property-page-btn {
        text-decoration: none;
        padding: 0.65rem 1rem;
        border-radius: 10px;
        font-weight: 600;
    }

    .property-page-btn-primary {
        background: #fff;
        color: #0b2240;
    }

    .property-page-btn-secondary {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .property-grid {
        max-width: 1100px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1rem;
    }

    .property-card {
        background: #fff;
        border: 1px solid #dce7f4;
        border-radius: 14px;
        overflow: hidden;
        text-decoration: none;
        color: #1d2a38;
        box-shadow: 0 10px 22px rgba(15, 36, 58, 0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .property-card:hover {
        transform: translateY(-2px);
        border-color: #b8cde0;
        box-shadow: 0 16px 28px rgba(15, 36, 58, 0.14);
    }

    .property-alert {
        max-width: 1100px;
        margin: 0 auto 1rem;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-weight: 600;
    }

    .property-alert-success {
        background: #ecfdf3;
        color: #1f6b3a;
        border: 1px solid #b5eccb;
    }

    .property-alert-error {
        background: #fff2f2;
        color: #a12626;
        border: 1px solid #f2c7c7;
    }

    .property-card-image-wrap {
        height: 180px;
        background: #e8edf4;
    }

    .property-card-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .property-card-image-placeholder {
        width: 100%;
        height: 100%;
        display: grid;
        place-items: center;
        color: #6e7b88;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .property-card-content {
        padding: 1rem;
    }

    .property-card-content h3 {
        margin: 0;
        font-size: 1rem;
        line-height: 1.4;
    }

    .property-card-content p {
        margin: 0.45rem 0 0;
        color: #566574;
        font-size: 0.92rem;
    }

    .property-card-price {
        margin-top: 0.9rem;
        color: #0e223a;
        font-size: 1.1rem;
        font-weight: 700;
    }

    .property-card-meta {
        margin-top: 0.8rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .property-card-meta span {
        font-size: 0.78rem;
        padding: 0.25rem 0.55rem;
        border-radius: 999px;
        background: #eef4fa;
        color: #3d4c5b;
    }

    .property-card-actions {
        margin-top: 0.9rem;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .property-card-btn {
        text-decoration: none;
        border-radius: 9px;
        padding: 0.52rem 0.9rem;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .property-card-btn-secondary {
        background: #fff;
        color: #0b2240;
        border: 1px solid #c7d6e6;
    }

    .property-empty-state {
        grid-column: 1 / -1;
        text-align: center;
        background: #fff;
        border: 1px dashed #c7d6e6;
        border-radius: 12px;
        color: #637484;
        padding: 1.25rem;
    }

    .property-pagination-wrap {
        max-width: 1100px;
        margin: 2rem auto 0;
        display: flex;
        justify-content: center;
    }

    .property-pagination-wrap .pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 6px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .property-pagination-wrap .pagination li {
        margin: 0;
    }

    .property-pagination-wrap .pagination li a,
    .property-pagination-wrap .pagination li span {
        display: block;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 500;
        color: #444;
        background: #f3f3f3;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
        min-width: 44px;
        text-align: center;
    }

    .property-pagination-wrap .pagination li a:hover {
        background: #2563eb;
        color: #fff;
    }

    .property-pagination-wrap .pagination li.active span {
        background: #2563eb;
        color: #fff;
    }

    .property-pagination-wrap .pagination li.disabled span {
        background: #e5e5e5;
        color: #888;
        cursor: not-allowed;
    }

    .property-pagination-wrap .pagination li:first-child a,
    .property-pagination-wrap .pagination li:last-child a {
        font-weight: 600;
    }

    .property-pagination-wrap .w-5 {
        display: none;
    }
</style>