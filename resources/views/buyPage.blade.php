<x-header/>

<div class="container mt-5">
    <div class="mb-4">
        <h1 class="listings-title mb-1">Active Property Listings</h1>
        <p class="text-muted">Explore the latest homes for sale in your area.</p>
    </div>

    <div class="row gx-3 gy-3">
        @forelse($listings as $listing)
            <div class="col-12 col-sm-6 col-xl-3">
                <a href="{{ route('property.show', $listing->property->id) }}" class="prop-card d-flex flex-column h-100 text-decoration-none text-dark">

                    <div class="prop-img">
                        @if($listing->property->image)
                            <img src="{{ asset('storage/' . $listing->property->image) }}" alt="Property Image">
                        @else
                            <div class="prop-img-placeholder">No Image Available</div>
                        @endif
                        <div class="prop-fav">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="prop-body flex-grow-1 d-flex flex-column gap-2">
                        <p class="prop-name">{{ $listing->property->name ?? Str::limit($listing->property->description, 50) }}</p>
                        <p class="prop-addr">{{ $listing->property->address->address }}</p>

                        <div class="d-flex align-items-center gap-2">
                            <span class="prop-price">
                                @if($listing->price)
                                    RM {{ number_format($listing->price) }}
                                @else
                                    Price on ask
                                @endif
                            </span>
                            @if($listing->price)
                                <span class="prop-from">Starting From</span>
                            @endif
                        </div>

                        @if($listing->property->bedrooms)
                            <div class="prop-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <polyline points="9,22 9,12 15,12 15,22"/>
                                </svg>
                                {{ $listing->property->bedrooms }}
                            </div>
                        @endif

                        <div class="prop-tags mt-auto pt-1">
                            <span class="prop-tag">{{ $listing->property->tenure ?? 'Leasehold' }}</span>
                            <span class="prop-tag">{{ $listing->property->property_type ?? 'Service Residence' }}</span>
                            @if($listing->property->completion_year)
                                <span class="prop-tag">Completion: {{ $listing->property->completion_year }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No active property listings are available right now.</div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $listings->onEachSide(1)->links() }}
    </div>
</div>

<x-footer/>

<style>
.listings-title {
    font-size: 1.6rem;
    font-weight: 600;
    letter-spacing: -0.02em;
}

.prop-card {
    border-radius: 14px;
    border: 1px solid rgba(0,0,0,0.08);
    overflow: hidden;
    background: #fff;
    transition: transform 0.22s ease, box-shadow 0.22s ease;
}

.prop-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.10);
    color: inherit;
}

.prop-img {
    position: relative;
    height: 190px;
    overflow: hidden;
    background: #e8e8e8;
}

.prop-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.prop-img-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #aaa;
    font-size: 13px;
    font-weight: 500;
}

.prop-fav {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 32px;
    height: 32px;
    background: rgba(255,255,255,0.92);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s ease;
}

.prop-fav svg {
    width: 16px;
    height: 16px;
    color: #666;
}

.prop-fav:hover {
    background: #fff;
}

.prop-fav:hover svg {
    color: #e00;
}

.prop-body {
    padding: 16px;
}

.prop-name {
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.4;
}

.prop-addr {
    font-size: 13px;
    color: #666;
    margin: 0;
}

.prop-price {
    font-size: 18px;
    font-weight: 700;
    color: #2563eb;
}

.prop-from {
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.prop-meta {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #444;
}

.prop-meta svg {
    width: 16px;
    height: 16px;
}

.prop-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.prop-tag {
    font-size: 11px;
    padding: 4px 8px;
    background: #f4f4f4;
    border-radius: 4px;
    color: #555;
}

/* Pagination Styling */
.pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6px;
    padding: 0;
    margin: 0;
    list-style: none;
}

.pagination li {
    margin: 0;
}

.pagination li a,
.pagination li span {
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

.pagination li a:hover {
    background: #2563eb;
    color: #fff;
}

.pagination li.active span {
    background: #2563eb;
    color: #fff;
}

.pagination li.disabled span {
    background: #e5e5e5;
    color: #888;
    cursor: not-allowed;
}

.pagination li:first-child a,
.pagination li:last-child a {
    font-weight: 600;
}

.w-5{
    display: none;
}
</style>

