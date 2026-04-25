<x-header/>

<main class="profile-wrap">
    <section class="profile-hero">
        <p class="profile-kicker">Account</p>
        <h1>My Profile</h1>
        <p>Manage your personal information and account settings.</p>
    </section>

    @if (session('success'))
        <div class="profile-alert">{{ session('success') }}</div>
    @endif

    <div class="profile-grid">

        {{-- Info Card --}}
        <div class="profile-card">
            <h2>Personal Information</h2>

            @if ($errors->has('name') || $errors->has('phone'))
                <div class="form-errors">
                    @foreach (['name', 'phone'] as $field)
                        @error($field)<p>{{ $message }}</p>@enderror
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="field-block">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="field-block">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" value="{{ $user->email }}" disabled>
                    <p class="field-hint">Email cannot be changed.</p>
                </div>

                <div class="field-block">
                    <label>Role</label>
                    <div class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</div>
                </div>

                <button type="submit" class="profile-btn">Save Changes</button>
            </form>
        </div>

        {{-- Password Card --}}
        <div class="profile-card">
            <h2>Change Password</h2>

            @if ($errors->has('current_password') || $errors->has('password'))
                <div class="form-errors">
                    @foreach (['current_password', 'password'] as $field)
                        @error($field)<p>{{ $message }}</p>@enderror
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PUT')

                <div class="field-block">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>

                <div class="field-block">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="field-block">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="profile-btn">Update Password</button>
            </form>
        </div>

    </div>
</main>

<x-footer/>

<style>
.profile-wrap {
    min-height: calc(100vh - 200px);
    background: linear-gradient(180deg, #f2f8ff 0%, #ffffff 60%);
    padding: 2rem 1.25rem 3rem;
}

.profile-hero {
    max-width: 980px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(120deg, #09203f 0%, #537895 100%);
    color: #fff;
    border-radius: 18px;
    padding: 2rem 1.4rem;
    box-shadow: 0 14px 30px rgba(9, 32, 63, 0.24);
}

.profile-kicker {
    margin: 0 0 0.4rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.78rem;
    opacity: 0.9;
}

.profile-hero h1 {
    margin: 0;
    font-size: clamp(1.45rem, 3.2vw, 2.2rem);
}

.profile-hero p {
    margin: 0.7rem 0 0;
    color: rgba(255, 255, 255, 0.9);
}

.profile-alert {
    max-width: 980px;
    margin: 0 auto 1rem;
    background: #eaf8f1;
    border: 1px solid #6fcf97;
    color: #1a6640;
    border-radius: 10px;
    padding: 0.8rem 1rem;
    font-size: 0.93rem;
}

.profile-grid {
    max-width: 980px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
}

.profile-card {
    background: #fff;
    border: 1px solid #dce7f4;
    border-radius: 16px;
    padding: 1.4rem;
    box-shadow: 0 10px 24px rgba(15, 36, 58, 0.08);
}

.profile-card h2 {
    margin: 0 0 1.2rem;
    font-size: 1.05rem;
    color: #122c46;
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

.field-block input[type="text"],
.field-block input[type="email"],
.field-block input[type="password"] {
    width: 100%;
    border: 1px solid #c9d8e8;
    border-radius: 10px;
    padding: 0.65rem 0.7rem;
    background: #fff;
    color: #1b2a3a;
    box-sizing: border-box;
    font-size: 0.95rem;
}

.field-block input:disabled {
    background: #f4f7fa;
    color: #7a8b9a;
    cursor: not-allowed;
}

.field-block input:focus {
    outline: none;
    border-color: #7ea6cf;
    box-shadow: 0 0 0 3px rgba(126, 166, 207, 0.2);
}

.field-hint {
    margin: 0;
    font-size: 0.8rem;
    color: #8a9bab;
}

.role-badge {
    display: inline-block;
    padding: 0.3rem 0.75rem;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 600;
    width: fit-content;
}

.role-buyer  { background: #e6f1fb; color: #185fa5; }
.role-seller { background: #e1f5ee; color: #0f6e56; }
.role-admin  { background: #eeedfe; color: #3c3489; }

.profile-btn {
    width: 100%;
    border: none;
    border-radius: 11px;
    padding: 0.75rem 1rem;
    background: #0b2240;
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    margin-top: 0.5rem;
}

.profile-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(11, 34, 64, 0.28);
}

.form-errors {
    background: #fff0f1;
    border: 1px solid #f3c2c5;
    color: #7e1f27;
    border-radius: 10px;
    padding: 0.7rem 0.9rem;
    margin-bottom: 1rem;
    font-size: 0.88rem;
}

.form-errors p { margin: 0.2rem 0; }
</style>