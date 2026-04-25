<x-header/>

<main class="contact-page">
	<!-- Hero Section -->
	<section class="hero">
		<div class="hero-content">
			<p class="hero-kicker">Get in Touch</p>
			<h1>Contact REM</h1>
			<p class="hero-text">
				Have questions or feedback? We'd love to hear from you. Reach out to our team 
				and we'll respond as quickly as possible.
			</p>
		</div>
	</section>

	<!-- Contact Content Section -->
	<section class="contact-section">
		<div class="section-container">
			<div class="contact-wrapper">
				<!-- Contact Form -->
				<div class="contact-form-wrap">
					<h2>Send us a Message</h2>
					
					@if($errors->any())
						<div class="alert alert-error">
							<p><strong>Please fix the following errors:</strong></p>
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif

					<form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
						@csrf
						
						<div class="form-group">
							<label for="name">Full Name</label>
							<input type="text" id="name" name="name" placeholder="Your name" required value="{{ old('name') }}">
						</div>

						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" id="email" name="email" placeholder="your@email.com" required value="{{ old('email') }}">
						</div>

						<div class="form-group">
							<label for="phone">Phone Number</label>
							<input type="tel" id="phone" name="phone" placeholder="+1 (555) 123-4567" value="{{ old('phone') }}">
						</div>

						<div class="form-group">
							<label for="subject">Subject</label>
							<input type="text" id="subject" name="subject" placeholder="How can we help?" required value="{{ old('subject') }}">
						</div>

						<div class="form-group">
							<label for="message">Message</label>
							<textarea id="message" name="message" rows="6" placeholder="Your message here..." required>{{ old('message') }}</textarea>
						</div>

						<button type="submit" class="btn btn-submit">Send Message</button>
					</form>
				</div>

				<!-- Contact Info -->
				<div class="contact-info-wrap">
					<h2>Contact Information</h2>
					
					<div class="info-block">
						<h3>📍 Address</h3>
						<p>123 Real Estate Avenue<br>New York, NY 10001<br>United States</p>
					</div>

					<div class="info-block">
						<h3>📞 Phone</h3>
						<p>(555) 123-4567</p>
					</div>

					<div class="info-block">
						<h3>✉️ Email</h3>
						<p><a href="mailto:info@rem.com">info@rem.com</a></p>
					</div>

					<div class="info-block">
						<h3>🕒 Business Hours</h3>
						<p>Monday - Friday: 9:00 AM - 6:00 PM<br>
						Saturday: 10:00 AM - 4:00 PM<br>
						Sunday: Closed</p>
					</div>

					<div class="info-block social-block">
						<h3>Follow Us</h3>
						<div class="social-links">
							<a href="https://www.facebook.com" class="social-icon">Facebook</a>
							<a href="https://twitter.com" class="social-icon">Twitter</a>
							<a href="https://www.instagram.com" class="social-icon">Instagram</a>
							<a href="https://www.linkedin.com" class="social-icon">LinkedIn</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ Section -->
	<section class="faq-section">
		<div class="section-container">
			<h2>Frequently Asked Questions</h2>
			<p class="section-subtitle">Find answers to common questions</p>
			
			<div class="faq-grid">
				<div class="faq-item">
					<h3>How long does it take to sell my property?</h3>
					<p>On average, properties listed with REM sell within 30-60 days. The timeline depends on market conditions, property location, and pricing.</p>
				</div>

				<div class="faq-item">
					<h3>What are your fees?</h3>
					<p>We charge a transparent 2% commission on successful sales. There are no hidden fees or surprise charges.</p>
				</div>

				<div class="faq-item">
					<h3>Can I list multiple properties?</h3>
					<p>Yes! You can list as many properties as you want. Simply create listings for each property in your account.</p>
				</div>

				<div class="faq-item">
					<h3>How do I get started?</h3>
					<p>Sign up for a free account, complete your profile, and you can start listing or browsing properties immediately.</p>
				</div>

				<div class="faq-item">
					<h3>Is my personal information secure?</h3>
					<p>We use enterprise-grade security to protect your data. Your information is encrypted and never shared with third parties.</p>
				</div>

				<div class="faq-item">
					<h3>How can I contact support?</h3>
					<p>You can reach our support team via email, phone, or by using the contact form above. We respond within 24 hours.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="cta-section">
		<div class="section-container">
			<h2>Ready to Get Started?</h2>
			<p>Join our community of buyers and sellers today.</p>
			<div class="cta-actions">
				<a href="/buy" class="btn btn-primary">Browse Properties</a>
				<a href="/sell" class="btn btn-secondary">List Your Property</a>
			</div>
		</div>
	</section>
</main>

<x-footer/>

<style>
.contact-page {
	font-family: sans-serif;
	color: #1b2a3a;
	max-width: 1100px;
	margin: 0 auto;
	padding: 2rem;
}

.section-container {
	max-width: 100%;
	margin: 0;
}

.hero {
	background: linear-gradient(120deg, #09203f 0%, #537895 100%);
	border: 1px solid #0f2d4d;
	border-radius: 12px;
	padding: 3rem 2rem;
	text-align: center;
	margin-bottom: 2rem;
}

.hero-content {
	background: transparent;
	color: #fff;
	border-radius: 0;
	padding: 0;
	box-shadow: none;
}

.hero-kicker {
	margin: 0;
	text-transform: uppercase;
	letter-spacing: 0.08em;
	font-size: 0.78rem;
	color: rgba(255, 255, 255, 0.9);
	opacity: 0.9;
}

.hero-content h1 {
	margin: 0.45rem 0 0;
	font-size: 2rem;
	color: #ffffff;
}

.hero-text {
	margin: 0.8rem 0 0;
	max-width: 600px;
	line-height: 1.7;
	color: rgba(255, 255, 255, 0.92);
	margin-left: auto;
	margin-right: auto;
}

.contact-section,
.faq-section,
.cta-section {
	margin-bottom: 2rem;
}

.contact-section .section-container,
.faq-section .section-container,
.cta-section .section-container {
	background: transparent;
	border: 0;
	border-radius: 0;
	padding: 0;
	box-shadow: none;
}

.contact-wrapper {
	display: grid;
	grid-template-columns: 1.2fr 0.8fr;
	gap: 1rem;
}

.contact-page h2 {
	margin: 0;
	color: #122c46;
	font-size: clamp(1.2rem, 2.1vw, 1.6rem);
}

.contact-section p,
.faq-section p,
.cta-section p {
	color: #556676;
	line-height: 1.65;
}

.contact-form-wrap,
.contact-info-wrap {
	border: 1px solid #dce7f4;
	border-radius: 10px;
	padding: 1.25rem;
	background: #fbfdff;
}

.contact-form {
	margin-top: 0.9rem;
	display: grid;
	gap: 0.7rem;
}

.form-group {
	display: flex;
	flex-direction: column;
	gap: 0.35rem;
}

.form-group label {
	font-weight: 600;
	color: #2f4459;
}

.form-group input,
.form-group textarea {
	width: 100%;
	box-sizing: border-box;
	border: 1px solid #c9d8e8;
	border-radius: 10px;
	padding: 0.65rem 0.7rem;
	background: #fff;
	color: #1b2a3a;
}

.form-group input:focus,
.form-group textarea:focus {
	outline: none;
	border-color: #7ea6cf;
	box-shadow: 0 0 0 3px rgba(126, 166, 207, 0.2);
}

.btn {
	text-decoration: none;
	border-radius: 8px;
	font-weight: 600;
	padding: 10px 24px;
	border: 1px solid transparent;
	display: inline-block;
}

.btn-submit {
	background: #0b2240;
	color: #fff;
	cursor: pointer;
	width: fit-content;
	border: none;
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

.alert {
	border-radius: 10px;
	padding: 0.75rem;
	margin-top: 0.8rem;
}

.alert-error {
	background: #fff0f1;
	border: 1px solid #f3c2c5;
	color: #7e1f27;
}

.alert-success {
	background: #ecfdf3;
	border: 1px solid #b5eccb;
	color: #1f6b3a;
}

.alert ul {
	margin: 0.45rem 0 0;
	padding-left: 1.1rem;
}

.info-block {
	margin-top: 0.85rem;
	padding-top: 0.7rem;
	border-top: 1px solid #e4edf7;
}

.info-block:first-of-type {
	margin-top: 0.6rem;
}

.info-block h3 {
	margin: 0;
	font-size: 1rem;
	color: #1b344e;
}

.info-block p {
	margin: 0.45rem 0 0;
	font-size: 0.95rem;
}

.info-block a {
	color: #204a73;
	text-decoration: none;
}

.social-links {
	margin-top: 0.5rem;
	display: flex;
	flex-wrap: wrap;
	gap: 0.45rem;
}

.social-icon {
	font-size: 0.82rem;
	padding: 0.3rem 0.55rem;
	background: #eef4fa;
	border-radius: 999px;
	border: 1px solid #d6e4f3;
}

.section-subtitle {
	margin: 0.55rem 0 0;
}

.faq-grid {
	margin-top: 0.9rem;
	display: grid;
	gap: 0.9rem;
	grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
}

.faq-item {
	border: 1px solid #dce7f4;
	border-radius: 10px;
	padding: 1.25rem;
	background: #fbfdff;
}

.faq-item h3 {
	margin: 0;
	font-size: 1rem;
	color: #1b344e;
}

.faq-item p {
	margin: 0.55rem 0 0;
	font-size: 0.95rem;
}

.cta-section .section-container {
	background: #ffffff;
	border: 1px solid #dce7f4;
	border-radius: 12px;
	padding: 2.5rem;
	text-align: center;
}

.cta-section p {
	margin: 0.65rem auto 0;
	max-width: 680px;
}

.cta-actions {
	margin-top: 1rem;
	display: flex;
	justify-content: center;
	flex-wrap: wrap;
	gap: 0.65rem;
}

@media (max-width: 900px) {
	.contact-wrapper {
		grid-template-columns: 1fr;
	}
}

@media (max-width: 760px) {
	.contact-page {
		padding: 1.5rem 1rem 2rem;
	}

	.hero-content,
	.contact-section .section-container,
	.faq-section .section-container,
	.cta-section .section-container {
		padding: 1rem;
	}
}
</style>