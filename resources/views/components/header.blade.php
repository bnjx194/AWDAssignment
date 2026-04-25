<header class="site-header">
    <div class="header-container">
        <a href="/" class="logo">REM</a>
        <nav class="header-nav">
            <a href="/buy" class="nav-link">Buy</a>
            <a href="/sell" class="nav-link">Sell</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
            @auth
                <a href="{{ route('logout') }}" class="nav-link">Logout</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            @endauth
        </nav>
    </div>
</header>

<style>
.site-header {
    position: sticky;
    top: 0;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    width: 100vw;
    margin-left: calc(50% - 50vw);
    left: 0;
    box-sizing: border-box;
}
html, body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem 2rem;
}

.logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    text-decoration: none;
}

.header-nav {
    display: flex;
    gap: 1.5rem;
}

.nav-link {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.nav-link:hover {
    color: #007bff;
}

.logout-btn {
    background: none;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    color: #333;
    font-weight: 500;
    transition: color 0.2s ease;
}

.logout-btn:hover {
    color: #007bff;
}
</style>