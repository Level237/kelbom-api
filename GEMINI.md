# kelbom-api

## Project Overview
`kelbom-api` is a Laravel-based backend for a marketplace and seller platform. It provides a robust API for managing sellers (stands), products, and categories. The project also includes features for lead generation credits (`buylead_credits`), subscriptions, and reviews.

### Main Technologies
- **Framework:** Laravel (using PHP 8.3+)
- **Admin Panel:** Filament ^5.6
- **Authentication:** Laravel Sanctum ^4.0
- **Authorization:** Spatie Laravel Permission ^8.0
- **Database:** SQLite (default)
- **Frontend/Build:** Vite with Tailwind CSS 4.0

### Architecture
- **API-First:** Controllers located in `app/Http/Controllers` (with a dedicated `Seller` namespace) return JSON responses using Laravel API Resources (`app/Http/Resources`).
- **Domain Models:** Comprehensive models in `app/Models` including `User`, `Stand` (often referred to as `seller` in code), `Product`, `Category`, `BuyleadCredit`, etc.
- **Roles & Permissions:** Uses Spatie's permission package to manage access, with a primary focus on the `seller` role.

## Building and Running

### Prerequisites
- PHP 8.3 or higher
- Composer
- Node.js & NPM

### Key Commands
- **Initial Setup:**
  ```bash
  composer run setup
  ```
  *This command installs dependencies, creates `.env`, generates keys, runs migrations, and builds assets.*

- **Development Server:**
  ```bash
  composer run dev
  ```
  *Starts the Laravel server, queue listener, Pail (logs), and Vite concurrently.*

- **Running Tests:**
  ```bash
  composer run test
  ```

- **Artisan Commands:**
  Standard Laravel commands are available via `php artisan`.

## Development Conventions

### Routing & Controllers
- API routes are defined in `routes/api.php`.
- Seller-specific routes are prefixed with `/seller` and protected by `auth:sanctum` and `role:seller` middleware.
- Use API Resources for consistent JSON structures.

### Database & Migrations
- Use migrations for all schema changes (`database/migrations`).
- Seeders are available for roles and initial data (`database/seeders`).

### Code Quality
- **Formatting:** Laravel Pint is used for code style. Run it via `./vendor/bin/pint`.
- **Testing:** PHPUnit is configured for feature and unit tests in the `tests/` directory.

### UI / Admin
- Filament is used for the back-office administration.
- Tailwind CSS 4.0 is used for styling.
