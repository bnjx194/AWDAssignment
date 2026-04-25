
@extends('layouts.app')

@section('content')
<main class="home-page">
    <section class="hero">
        <h1>Welcome back, {{ Auth::user()->name }}!</h1>
        <p>Manage your property journey from one place. Browse listings, publish your property, and stay connected with REM.</p>
        <div class="hero-actions">
            <a href="{{ route('buy') }}" class="btn-primary">Browse Listings</a>
            <a href="/sell" class="btn-secondary">Create Listing</a>
        </div>
    </section>

    @if (session('status'))
        <div class="status-box">{{ session('status') }}</div>
    @endif

    <section class="section">
        <h2>Quick Actions</h2>
        <div class="grid">
            <a href="{{ route('buy') }}" class="card">
                <h3>Buy Properties</h3>
                <p>Explore active listings and open complete property details.</p>
            </a>
            <a href="/sell" class="card">
                <h3>Sell Property</h3>
                <p>Create a new listing and reach potential buyers faster.</p>
            </a>
            <a href="{{ route('buy') }}" class="card">
                <h3>Buy Now</h3>
                <p>Proceed to available listings and start your payment checkout.</p>
            </a>
            <a href="{{ route('contact') }}" class="card">
                <h3>Contact Support</h3>
                <p>Need help? Send us a message and our team will reply.</p>
            </a>
        </div>
    </section>

    <section class="section">
        <h2>Platform Highlights</h2>
        <div class="stats">
            <div><h3>24/7</h3><p>Access to your account</p></div>
            <div><h3>Secure</h3><p>Protected user sessions</p></div>
            <div><h3>Fast</h3><p>Simple listing workflow</p></div>
            <div><h3>Trusted</h3><p>Growing REM community</p></div>
        </div>
    </section>
</main>

<style>
.home-page {
    font-family: sans-serif;
    color: #1b2a3a;
    max-width: 1100px;
    margin: 0 auto;
    padding: 1rem 2rem 2.5rem;
}

.hero {
    background: linear-gradient(120deg, #09203f 0%, #537895 100%);
    border: 1px solid #0f2d4d;
    border-radius: 12px;
    padding: 2.2rem 1.5rem;
    margin-bottom: 1rem;
}

.kicker {
    margin: 0;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: rgba(255, 255, 255, 0.9);
}

.hero h1 {
    margin: 0.4rem 0 0;
    color: #fff;
    font-size: clamp(1.5rem, 3vw, 2.1rem);
}

.hero p {
    margin: 0.7rem 0 0;
    color: rgba(255, 255, 255, 0.92);
    line-height: 1.7;
    max-width: 700px;
}

.hero-actions {
    margin-top: 1rem;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-primary,
.btn-secondary {
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
}

.btn-primary {
    background: #0b2240;
    color: #fff;
}

.btn-secondary {
    background: #fff;
    color: #0b2240;
    border: 2px solid #c7d6e6;
}

.status-box {
    background: #ecfdf3;
    color: #1f6b3a;
    border: 1px solid #b5eccb;
    border-radius: 10px;
    padding: 0.75rem;
    margin-bottom: 1rem;
}

.section {
    margin-bottom: 1rem;
}

.section h2 {
    color: #122c46;
    margin: 0 0 0.8rem;
    font-size: 1.4rem;
}

.grid {
    display: grid;
    gap: 14px;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
}

.card {
    display: block;
    background: #fbfdff;
    border: 1px solid #dce7f4;
    border-radius: 10px;
    padding: 1.2rem;
    text-decoration: none;
}

.card h3 {
    color: #1b344e;
    margin: 0;
    font-size: 1rem;
}

.card p {
    color: #556676;
    margin: 0.55rem 0 0;
    line-height: 1.6;
    font-size: 0.92rem;
}

.stats {
    display: grid;
    gap: 14px;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
}

.stats div {
    background: #ffffff;
    border: 1px solid #dce7f4;
    border-radius: 10px;
    padding: 1rem;
    text-align: center;
}

.stats h3 {
    margin: 0;
    color: #122c46;
    font-size: 1.35rem;
}

.stats p {
    margin: 0.45rem 0 0;
    color: #556676;
    font-size: 0.9rem;
}

@media (max-width: 760px) {
    .home-page {
        padding: 1rem 1rem 2rem;
    }
}
</style>
@endsection
