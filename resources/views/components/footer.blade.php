<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4 class="footer-logo">REM</h4>
            <p class="footer-tagline">Your trusted real estate partner</p>
        </div>
        <div class="footer-section">
            <h5>Quick Links</h5>
            <nav class="footer-nav">
                <a href="/buy">Buy</a>
                <a href="/sell">Sell</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('contact') }}">Contact</a>
            </nav>
        </div>
        <div class="footer-section">
            <h5>Contact</h5>
            <p>info@rem.com</p>
            <p>(555) 123-4567</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} REM. All rights reserved.</p>
    </div>
</footer>

<style>
.site-footer {
    background-color: #333;
    color: #fff;
    padding: 2rem 0 0;
    width: 100vw;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem 2rem;
    flex-wrap: wrap;
    gap: 2rem;
}

.footer-section {
    flex: 1;
    min-width: 200px;
}

.footer-logo {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.footer-tagline {
    color: #aaa;
    font-size: 0.9rem;
}

.footer-section h5 {
    font-size: 1rem;
    margin-bottom: 1rem;
    color: #fff;
}

.footer-nav {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.footer-nav a {
    color: #aaa;
    text-decoration: none;
    transition: color 0.2s ease;
}

.footer-nav a:hover {
    color: #fff;
}

.footer-section p {
    color: #aaa;
    font-size: 0.9rem;
    margin: 0.25rem 0;
}

.footer-bottom {
    background-color: #222;
    text-align: center;
    padding: 1rem;
}

.footer-bottom p {
    margin: 0;
    color: #888;
    font-size: 0.85rem;
}
</style>