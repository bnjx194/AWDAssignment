@extends('layouts.app')

@section('content')
    <main class="admin-page">
        <section class="admin-hero">
            <h1>Admin Dashboard</h1>
            <p>Manage user roles, listing statuses, and monitor platform activity.</p>
        </section>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <section class="stats-grid">
            <article>
                <h2>{{ $stats['users'] }}</h2>
                <p>Total users</p>
            </article>
            <article>
                <h2>{{ $stats['sellers'] }}</h2>
                <p>Sellers</p>
            </article>
            <article>
                <h2>{{ $stats['buyers'] }}</h2>
                <p>Buyers</p>
            </article>
            <article>
                <h2>{{ $stats['properties_for_sale'] }}</h2>
                <p>Active listings</p>
            </article>
            <article>
                <h2>{{ $stats['transactions'] }}</h2>
                <p>Total transactions</p>
            </article>
        </section>

        <section class="panel">
            <h3>Manage Users (Role Update)</h3>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Current Role</th>
                            <th>Change Role</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge">{{ $user->role }}</span></td>
                                <td>
                                    <form method="POST" action="{{ route('admin.users.role', $user->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" required>
                                            <option value="seller" {{ $user->role === 'seller' ? 'selected' : '' }}>Seller
                                            </option>
                                            <option value="buyer" {{ $user->role === 'buyer' ? 'selected' : '' }}>Buyer</option>
                                        </select>
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                                <td>
                                    @if(Auth::id() !== $user->id && $user->role !== 'admin')
                                        <form method="POST" action="{{ route('admin.users.delete', $user->id) }}"
                                            class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="danger-btn"
                                                onclick="return confirm('Delete this user permanently?')">Delete</button>
                                        </form>
                                    @else
                                        <span class="muted-text">Locked</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel">
            <h3>Manage Listings (Status Update)</h3>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property</th>
                            <th>Seller</th>
                            <th>Price</th>
                            <th>Current Status</th>
                            <th>Change Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listings as $listing)
                            <tr>
                                <td>#{{ $listing->id }}</td>
                                <td>{{ optional($listing->property)->description }}</td>
                                <td>{{ optional($listing->seller)->name }}</td>
                                <td>${{ number_format($listing->price, 2) }}</td>
                                <td><span class="badge">{{ $listing->status }}</span></td>
                                <td>
                                    <form method="POST" action="{{ route('admin.listings.status', $listing->id) }}"
                                        class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" required>
                                            <option value="active" {{ $listing->status === 'active' ? 'selected' : '' }}>active
                                            </option>
                                            <option value="pending" {{ $listing->status === 'pending' ? 'selected' : '' }}>pending
                                            </option>
                                            <option value="sold" {{ $listing->status === 'sold' ? 'selected' : '' }}>sold</option>
                                            <option value="closed" {{ $listing->status === 'closed' ? 'selected' : '' }}>closed
                                            </option>
                                        </select>
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.listings.delete', $listing->id) }}"
                                        class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="danger-btn"
                                            onclick="return confirm('Delete this listing permanently?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel">
            <h3>Recent Transactions</h3>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Buyer</th>
                            <th>Seller</th>
                            <th>Final Price</th>
                            <th>Status</th>
                            <th>Completed At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>#{{ $transaction->id }}</td>
                                <td>{{ optional($transaction->buyer)->name }}</td>
                                <td>{{ optional($transaction->seller)->name }}</td>
                                <td>${{ number_format($transaction->final_price, 2) }}</td>
                                <td><span class="badge">{{ $transaction->status }}</span></td>
                                <td>{{ optional($transaction->completed_at)->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <style>
        .admin-page {
            max-width: 1150px;
            margin: 0 auto;
            padding: 1rem 1.2rem 2rem;
            color: #1d2f3f;
        }

        .admin-hero {
            background: linear-gradient(130deg, #12355b 0%, #1f6f8b 100%);
            border-radius: 12px;
            color: #fff;
            padding: 1.4rem;
            margin-bottom: 1rem;
        }

        .admin-hero h1 {
            margin: 0;
        }

        .admin-hero p {
            margin: 0.5rem 0 0;
        }

        .alert-success {
            border: 1px solid #bcead0;
            background: #edfdf3;
            color: #1f7042;
            border-radius: 8px;
            padding: 0.7rem 0.9rem;
            margin-bottom: 1rem;
        }

        .alert-error {
            border: 1px solid #f0c2c2;
            background: #fff1f1;
            color: #a53b3b;
            border-radius: 8px;
            padding: 0.7rem 0.9rem;
            margin-bottom: 1rem;
        }

        .stats-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            margin-bottom: 1rem;
        }

        .stats-grid article {
            border: 1px solid #dbe6f1;
            border-radius: 10px;
            background: #f9fcff;
            padding: 0.9rem;
        }

        .stats-grid h2 {
            margin: 0;
            color: #12355b;
        }

        .stats-grid p {
            margin: 0.3rem 0 0;
            color: #5f7285;
        }

        .panel {
            border: 1px solid #dbe6f1;
            border-radius: 12px;
            background: #fff;
            padding: 0.9rem;
            margin-bottom: 1rem;
        }

        .panel h3 {
            margin: 0 0 0.8rem;
            color: #12355b;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        th,
        td {
            border-bottom: 1px solid #e8eef5;
            padding: 0.65rem;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f6f9fc;
            color: #2c4359;
        }

        .badge {
            background: #edf2f8;
            border: 1px solid #d4e0ed;
            border-radius: 999px;
            padding: 0.15rem 0.55rem;
            font-size: 0.84rem;
        }

        .inline-form {
            display: flex;
            gap: 8px;
        }

        .inline-form select,
        .inline-form button {
            border: 1px solid #cfdceb;
            border-radius: 7px;
            padding: 0.35rem 0.5rem;
        }

        .inline-form button {
            background: #12355b;
            color: #fff;
            cursor: pointer;
        }

        .danger-btn {
            background: #a53434 !important;
            border-color: #a53434 !important;
        }

        .muted-text {
            color: #8b97a4;
            font-size: 0.9rem;
        }

        @media (max-width: 760px) {
            .admin-page {
                padding: 0.8rem;
            }
        }
    </style>
@endsection