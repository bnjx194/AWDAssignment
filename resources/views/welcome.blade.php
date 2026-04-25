<x-header/>

<main class="welcome-page">
	<section class="hero">
		<div class="hero-content">
			<p class="hero-kicker">Find Your Next Home</p>
			<h1>Real Estate Made Simple</h1>
			<p class="hero-text">
				Explore verified listings, compare options, and move with confidence.
				Start browsing properties or list your own in just a few clicks.
			</p>
			<div class="hero-actions">
				<a href="{{ route('buy') }}" class="btn btn-primary">Browse Properties</a>
				@auth
					<a href="/sell" class="btn btn-secondary">List a Property</a>
				@else
					<a href="{{ route('login') }}" class="btn btn-secondary">Login to Sell</a>
				@endauth
			</div>
		</div>
	</section>

	<section class="quick-links">
		<a href="{{ route('buy') }}" class="card-link">
			<h3>Buy</h3>
			<p>View current market listings and find your ideal property.</p>
		</a>
		@auth
			<a href="/sell" class="card-link">
				<h3>Sell</h3>
				<p>Create a listing and reach interested buyers faster.</p>
			</a>
		@else
			<a href="{{ route('register') }}" class="card-link">
				<h3>Get Started</h3>
				<p>Create an account to list your property for sale.</p>
			</a>
		@endauth
	</section>
</main>

<x-footer/>

<style>
.welcome-page {
	min-height: calc(100vh - 200px);
	background: linear-gradient(180deg, #f3f8ff 0%, #ffffff 55%);
	padding: 2rem 1.25rem 3rem;
}

.hero {
	max-width: 1100px;
	margin: 0 auto;
	background: linear-gradient(120deg, #09203f 0%, #537895 100%);
	border-radius: 18px;
	color: #fff;
	padding: 3rem 2rem;
	box-shadow: 0 14px 30px rgba(9, 32, 63, 0.25);
}

.hero-content {
	max-width: 720px;
}

.hero-kicker {
	letter-spacing: 0.1em;
	text-transform: uppercase;
	font-size: 0.8rem;
	margin-bottom: 0.75rem;
	opacity: 0.9;
}

.hero h1 {
	margin: 0 0 1rem;
	font-size: clamp(1.8rem, 4vw, 3rem);
	line-height: 1.2;
}

.hero-text {
	margin: 0;
	font-size: 1.05rem;
	line-height: 1.7;
	color: rgba(255, 255, 255, 0.92);
}

.hero-actions {
	display: flex;
	flex-wrap: wrap;
	gap: 0.75rem;
	margin-top: 1.5rem;
}

.btn {
	display: inline-block;
	text-decoration: none;
	font-weight: 600;
	padding: 0.75rem 1.1rem;
	border-radius: 10px;
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn:hover {
	transform: translateY(-1px);
}

.btn-primary {
	color: #09203f;
	background: #ffffff;
	box-shadow: 0 10px 18px rgba(0, 0, 0, 0.15);
}

.btn-secondary {
	color: #ffffff;
	border: 1px solid rgba(255, 255, 255, 0.6);
	background: rgba(255, 255, 255, 0.08);
}

.quick-links {
	max-width: 1100px;
	margin: 1.5rem auto 0;
	display: grid;
	gap: 1rem;
	grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
}

.card-link {
	display: block;
	background: #ffffff;
	border: 1px solid #dce7f4;
	border-radius: 14px;
	padding: 1.2rem;
	text-decoration: none;
	color: #1c2735;
	box-shadow: 0 10px 24px rgba(15, 36, 58, 0.08);
	transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.card-link:hover {
	transform: translateY(-2px);
	border-color: #b7ccdf;
	box-shadow: 0 14px 30px rgba(15, 36, 58, 0.14);
}

.card-link h3 {
	margin: 0 0 0.4rem;
	font-size: 1.1rem;
}

.card-link p {
	margin: 0;
	color: #4e5e6e;
	line-height: 1.55;
	font-size: 0.95rem;
}

@media (max-width: 640px) {
	.hero {
		padding: 2rem 1.2rem;
	}
}
</style>