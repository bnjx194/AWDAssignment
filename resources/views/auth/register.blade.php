<x-header/>

<main class="auth-wrap">
    <section class="auth-hero">
        <p class="auth-kicker">Get Started</p>
        <h1>Create Your Account</h1>
        <p>Join REM to buy or sell properties with ease.</p>
    </section>

    <div class="auth-card">
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field-block">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="field-block">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="field-block">
                <label for="role">I am a</label>
                <select id="role" name="role" required>
                    <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
                    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                </select>
            </div>

            <div class="field-block">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="field-block">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="auth-btn">Create Account</button>

            <p class="auth-footer-text">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </p>
        </form>
    </div>
</main>

<x-footer/>

<style>
.auth-wrap {
    min-height: calc(100vh - 200px);
    background: linear-gradient(180deg, #f2f8ff 0%, #ffffff 60%);
    padding: 2rem 1.25rem 3rem;
}

.auth-hero {
    max-width: 540px;
    margin: 0 auto 1.25rem;
    background: linear-gradient(120deg, #09203f 0%, #537895 100%);
    color: #fff;
    border-radius: 18px;
    padding: 2rem 1.4rem;
    box-shadow: 0 14px 30px rgba(9, 32, 63, 0.24);
}

.auth-kicker {
    margin: 0 0 0.4rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.78rem;
    opacity: 0.9;
}

.auth-hero h1 {
    margin: 0;
    font-size: clamp(1.4rem, 3vw, 2rem);
}

.auth-hero p {
    margin: 0.7rem 0 0;
    color: rgba(255,255,255,0.9);
}

.auth-card {
    max-width: 540px;
    margin: 0 auto;
    background: #fff;
    border: 1px solid #dce7f4;
    border-radius: 16px;
    padding: 1.75rem;
    box-shadow: 0 10px 24px rgba(15, 36, 58, 0.08);
}

.field-block {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
    margin-bottom: 1rem;
}

.field-block label {
    font-weight: 600;
    font-size: 0.9rem;
    color: #2f4459;
}

.field-optional {
    font-weight: 400;
    color: #8a9bab;
    font-size: 0.82rem;
}

.field-block input,
.field-block select {
    width: 100%;
    border: 1px solid #c9d8e8;
    border-radius: 10px;
    padding: 0.65rem 0.7rem;
    background: #fff;
    color: #1b2a3a;
    box-sizing: border-box;
    font-size: 0.95rem;
}

.field-block input:focus,
.field-block select:focus {
    outline: none;
    border-color: #7ea6cf;
    box-shadow: 0 0 0 3px rgba(126, 166, 207, 0.2);
}

.auth-btn {
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

.auth-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(11, 34, 64, 0.28);
}

.auth-footer-text {
    margin: 1rem 0 0;
    text-align: center;
    font-size: 0.9rem;
    color: #566574;
}

.auth-footer-text a {
    color: #185fa5;
    text-decoration: none;
    font-weight: 600;
}

.auth-footer-text a:hover {
    text-decoration: underline;
}

.form-errors {
    border: 1px solid #f3c2c5;
    background: #fff0f1;
    color: #7e1f27;
    border-radius: 10px;
    padding: 0.8rem;
    margin-bottom: 1rem;
    font-size: 0.88rem;
}

.form-errors ul {
    margin: 0.4rem 0 0;
    padding-left: 1.2rem;
}
</style>