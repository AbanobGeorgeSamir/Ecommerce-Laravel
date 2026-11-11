# Laravel Store

Server-rendered e-commerce store built with Laravel 13 and Blade. Customers browse products, fill a cart, check out and follow their orders. Administrators manage products, categories and orders from a dedicated admin area.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=flat-square&logo=sqlite&logoColor=white)

<!-- Add screenshots here, for example: ![Store](docs/store.png) -->

## Features

**Customers**
- Product catalog with SEO-friendly slugs (`/products/{slug}`)
- Session-based shopping cart: add, update, remove and clear items
- Checkout and order history for signed-in users
- Registration, login and email verification (Laravel Breeze)
- Profile management, including account deletion

**Administrators**
- Role-based access through a Laravel `admin` gate
- Dashboard with store statistics
- Create, edit and delete products and categories
- Order management

**Engineering**
- MVC structure with Eloquent models, migrations, factories and seeders
- Form validation, CSRF protection and route middleware
- Feature tests for authentication and profile flows (PHPUnit)
- Code style enforced with Laravel Pint

## Tech Stack

| Layer | Technologies |
| --- | --- |
| Backend | PHP 8.3, Laravel 13, Eloquent ORM, Laravel Breeze |
| Frontend | Blade templates, Tailwind CSS, Vite |
| Database | SQLite by default; MySQL or other drivers through `.env` |
| Testing | PHPUnit |

## Project Structure

```text
app/Http/Controllers/        Storefront, cart, checkout, orders, profile, Admin/*
app/Models/                  User, Category, Product, Order, OrderItem
database/migrations/         Schema
database/seeders/            Demo users, categories, products and orders
resources/views/             Blade views (store, cart, checkout, orders, admin)
routes/web.php               Web routes
```

## Getting Started

**Requirements:** PHP 8.3+, Composer, Node.js and npm.

```bash
git clone https://github.com/AbanobGeorgeSamir/Ecommerce-Laravel.git
cd Ecommerce-Laravel

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

npm install
npm run dev          # in one terminal
php artisan serve    # in another terminal
```

Open `http://localhost:8000`. The default database is SQLite. To use MySQL, set `DB_CONNECTION=mysql` and the `DB_*` values in `.env` before migrating.

### Demo accounts (local development only)

`php artisan migrate --seed` creates two demo accounts. Change or remove them before deploying anywhere public.

| Role | Email | Password |
| --- | --- | --- |
| Administrator | `admin@example.com` | `password` |
| Customer | `customer@example.com` | `password` |

## Testing

```bash
php artisan test
```

## Author

**Abanoub George Samir** · Junior Full-Stack Developer · [Portfolio](https://devabanobgeorge.vercel.app) · [LinkedIn](https://www.linkedin.com/in/abanob-george-samir) · [GitHub](https://github.com/AbanobGeorgeSamir)
