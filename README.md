# REM (Real Estate Manager)

A Laravel-based real estate property listing platform where users can browse, list, and manage property listings.

---

## Prerequisites

- **PHP** (>= 8.0)
- **Composer** (PHP dependency manager)
- **MySQL** or **SQLite** (database)
- **Node.js** & **npm** (for frontend assets)

---

## Installation Guide

### 1. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install frontend dependencies
npm install
```

### 2. Configure Environment

Copy the example environment file and update the database credentials:

```bash
cp .env.example .env

```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Set Up Database

```bash
# Run migrations to create tables
php artisan migrate

# Seed the database with sample data (8 users, 12 property listings)
php artisan db:seed
```

### 5. Link Storage for Images

```bash
php artisan storage:link
```

This makes uploaded property images accessible at `/storage/properties/`.

### 6. Build Frontend Assets (Optional)

```bash
npm run dev
```

---

## Running the Application

### Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`

---

## Default Login Credentials

After seeding, you can log in with these accounts:

| Role     | Email              | Password   |
|----------|--------------------|------------|
| Admin    | admin@awd.com      | password   |
| Seller   | seller1@awd.com    | password   |
| Buyer    | buyer1@awd.com     | password   |

---

## Key Features

- **Buy Page** (`/buy`) — Browse active property listings (8 per page, 4×2 grid)
- **Sell Page** (`/sell`) — List a new property for sale
- **Property Details** (`/property/{id}`) — View full property information
- **User Authentication** — Login/Register for buyers and sellers

---

## Project Structure

```
AWDAssignment/
├── app/                  # Application code (Models, Controllers)
├── database/
│   ├── migrations/       # Database schema
│   └── seeders/          # Sample data (8 users, 12 listings)
├── resources/views/       # Blade templates
│   ├── buyPage.blade.php # Property listings page
│   └── components/       # Reusable UI components
├── routes/web.php         # Web routes
└── storage/app/public/   # Stored property images
```

---

## Troubleshooting

**Images not displaying?**
```bash
php artisan storage:link
```

**Database issues?**
```bash
php artisan migrate:fresh --seed
```

---

## License

MIT License
