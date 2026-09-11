# BeFit Store

BeFit Store is a Laravel-based sportswear e-commerce application designed for selling athletic apparel, accessories, and gear. The project includes a storefront for browsing and purchasing products, a wishlist and cart flow, order processing, and a Filament-powered admin dashboard for managing the catalog and store operations.

The codebase is implemented as a server-rendered web application using Laravel, Blade, Bootstrap, and Vite. It is organized around a typical MVC architecture with service classes, request validation, and Eloquent models for the main e-commerce entities.

## ✨ Features

- Product catalog with category and subcategory browsing
- Product detail pages with gallery images and variant selection
- Color and size variants with stock handling
- Shop filters by category, subcategory, size, color, and price range
- Search suggestions for products
- Shopping cart with guest and authenticated user support
- Wishlist for saving products
- Checkout flow with shipping options and order creation
- Order listing and cancellation for pending orders
- User authentication using Laravel’s built-in web auth system
- Email OTP verification for newly registered users
- Password reset flow using OTP codes
- Social login with Google via Laravel Socialite
- Admin dashboard with Filament for catalog and store management
- Soft-deleted records for products and categories when managed through admin flows
- Product image handling through the public storage disk

## 🛠️ Tech Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.2, Laravel 12 |
| Frontend | Blade templates, Bootstrap 5, custom CSS/JS |
| Build tooling | Vite |
| Admin panel | Filament 5 |
| Authentication | Laravel auth, Laravel Socialite, OTP-based flows |
| Database | MySQL (Dockerized), SQLite supported by default in example env |
| Queue / background | Laravel queue support with database queue connection |
| Infrastructure | Docker Compose |
| Testing | PHPUnit |
| Mail testing | Mailpit |
| Search / additional services | Meilisearch, Redis included in Docker stack |

## 🏗️ Architecture

The application follows a practical Laravel architecture with a clear separation between the request layer, business logic, and persistence layer.

- Routes are defined in [routes/web.php](routes/web.php) and are grouped into public storefront routes, cart/wishlist flows, authenticated checkout flows, and auth-related routes.
- Controllers in [app/Http/Controllers](app/Http/Controllers) handle HTTP requests and delegate business operations to service classes.
- Services in [app/Services](app/Services) encapsulate the main domain logic for home page data, filtering products, checkout, orders, OTP, wishlist, and social authentication.
- Form requests in [app/Http/Requests](app/Http/Requests) validate incoming payloads for cart updates, checkout, profile updates, wishlist items, and OTP verification.
- Models in [app/Models](app/Models) represent the main entities such as categories, products, variants, colors, sizes, carts, orders, shipping options, and users.
- Admin resources in [app/Filament/Resources](app/Filament/Resources) define structured CRUD screens for managing store data through Filament.
- The app also uses Eloquent relationships to connect categories to subcategories, products to variants and images, and carts/orders to the customer and product data.
- The project does not include a custom middleware directory; it uses Laravel’s built-in middleware and the Filament authentication/session stack configured in the admin provider.

This layered approach keeps controllers thin and moves catalog, pricing, cart, and order rules into reusable service classes.

## 📁 Project Structure

```text
BeFit/
├── app/
│   ├── Filament/          # Admin resources and pages
│   ├── Http/              # Controllers, requests, and route-driven logic
│   ├── Models/            # Eloquent models
│   ├── Notifications/     # OTP notification email classes
│   ├── Providers/         # App and Filament service providers
│   └── Services/          # Business logic layer
├── bootstrap/
├── config/
├── database/
│   ├── migrations/        # Database schema definitions
│   ├── seeders/           # Product/category/color/size data seeders
│   └── factories/
├── docker/                # Docker-related configuration
├── public/                # Public web assets and generated files
├── resources/
│   ├── css/               # Stylesheets
│   ├── js/                # Frontend JS entrypoints
│   └── views/             # Blade storefront templates
├── routes/
│   └── web.php            # Application routes
├── storage/
│   └── app/public/        # Uploaded media such as product/category images
├── tests/                 # PHPUnit tests
├── .env.example
├── composer.json
├── docker-compose.yml
├── package.json
├── phpunit.xml
├── vite.config.js
└── README.md
```

## 🔐 Authentication & Security

The project includes multiple authentication and security mechanisms, all implemented in the codebase:

- Standard Laravel web authentication for customers via the default auth routes and login/register flow.
- Separate admin guard and admin model for Filament access.
- Google social login using Laravel Socialite.
- OTP-based email verification after registration.
- OTP-based password reset with rate limiting and verification windows.
- Password hashing via Laravel’s default hashing configuration.
- CSRF protection enabled through the default Laravel middleware stack.
- Session-based user and admin authentication with dedicated guards in [config/auth.php](config/auth.php).
- Active/inactive status checks for users and products before allowing access to purchase and sign-in flows.

## 🛍️ E-commerce Functionality

The storefront is designed around a typical sportswear retail flow:

1. Customers land on the home page showing featured categories and products.
2. They can browse products from the shop page, using category, subcategory, size, color, and price filters.
3. Product detail pages show the main gallery, price, badges, stock information, and variant selection.
4. Users can select size and color combinations, then add items to the cart.
5. The cart supports quantity updates and removal.
6. Authenticated users can proceed to checkout, completing shipping details and choosing a shipping governorate option.
7. Orders are created and stored with order items and captured variant information.
8. Users can view their orders and cancel only pending orders.
9. The wishlist stores items in session data and is available as a lightweight saved-items feature.

## 🎨 Frontend

The frontend is server-rendered Blade UI with Bootstrap 5 and custom styling:

- Product cards, category cards, hero banners, and filter components are implemented as Blade component views under [resources/views/components](resources/views/components).
- Shared layout is defined in [resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php).
- Product pages include gallery thumbs and variant selection JavaScript for selecting color and size combinations.
- The project uses CDN-hosted Bootstrap and Font Awesome styles for the storefront UI.
- Responsive layout patterns are used throughout the storefront pages for mobile and desktop shopping flows.
- The app is not built as a separate SPA; it is implemented as a traditional Laravel view-based storefront.

## 🎛️ Admin Dashboard

The admin dashboard is powered by Filament and is configured in [app/Providers/Filament/AdminPanelProvider.php](app/Providers/Filament/AdminPanelProvider.php).

The available admin resources include:

- Products
- Categories
- Subcategories
- Users
- Orders
- Colors
- Sizes
- Shipping options

The dashboard supports listing, viewing, creating, editing, and soft-deleting records for the main catalog and order data. Product management includes product galleries, variant configuration, and stock records through Filament forms.

## 🌍 Localization

The project includes bilingual fields for core commerce data:

- English and Arabic names are stored for categories, subcategories, colors, sizes, and products.
- [app/Models/Category.php](app/Models/Category.php) contains a locale-aware name accessor that selects Arabic or English labels based on the current app locale.
- The project also includes default values and seed data in Arabic and English.

However, this repository does not include dedicated Laravel language translation files under a lang directory, and the storefront views are mostly hardcoded in English. The current localization behavior is therefore centered on bilingual catalog data rather than a full app-wide translation system.

## 🗄️ Database

The database schema is built with Laravel migrations and includes the main entities used by the store.

| Model | Purpose | Key relationships |
| --- | --- | --- |
| User | Customer and auth account | Has many carts, orders |
| Admin | Filament admin user | Separate auth guard |
| Category | Top-level store category | Has many subcategories, products |
| Subcategory | Child category grouping | Belongs to category, has many products |
| Product | Core item catalog record | Belongs to category/subcategory, has many images and variants |
| ProductImage | Product gallery image | Belongs to product |
| Color | Available color option | Has many variants |
| Size | Available size option | Has many variants |
| ProductVariant | SKU/stock variation | Belongs to product, color, size |
| Cart | Session or user cart entry | Belongs to user, product, variant |
| Order | Customer order | Belongs to user, has many order items |
| OrderItem | Each order line item | Belongs to order, product, variant |
| ShippingOption | Shipping price by governorate | Used during checkout |

The most important database relationships include:

- Categories have many subcategories and products.
- Products belong to a category and optionally a subcategory.
- Products have many images and many variants.
- Product variants combine a color and a size with stock and SKU tracking.
- Carts hold quantity by product and variant.
- Orders store shipping and buyer details, while order items preserve the purchased variant metadata.

## 🐳 Docker

The project includes a Docker Compose setup with multiple services:

- app: PHP/Laravel application container
- webserver: Nginx reverse proxy
- db: MySQL 8 container
- phpmyadmin: database management UI
- redis: Redis service
- meilisearch: search service
- mailpit: SMTP mail testing

The Docker stack is defined in [docker-compose.yml](docker-compose.yml). It is the recommended way to run the project locally because the project includes the full development environment configuration.

## ⚙️ Requirements

Before running the project, make sure the following are available:

- PHP 8.2 or newer
- Composer
- Node.js and npm
- Docker and Docker Compose (recommended)
- A browser for local development

## 🚀 Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd BeFit
```

### 2. Configure environment variables

```bash
cp .env.example .env
```

For the Docker-based setup, use environment values consistent with the services in [docker-compose.yml](docker-compose.yml), especially the MySQL connection settings for the app container.

The default [.env.example](.env.example) is a generic Laravel template and uses SQLite as the default DB connection, but the repository’s Docker environment is configured around MySQL.

### 3. Install PHP and frontend dependencies

```bash
composer install
npm install
```

### 4. Start the Docker environment

```bash
docker compose up -d --build
```

### 5. Run database migrations and seeders

```bash
docker compose exec app php artisan migrate
Docker compose exec app php artisan db:seed
```

If you are running without Docker, use the equivalent local commands:

```bash
php artisan migrate
php artisan db:seed
```

### 6. Generate the application key

```bash
php artisan key:generate
```

### 7. Set up public storage

```bash
php artisan storage:link
```

This is important because category, subcategory, and product images are served from the public storage disk.

### 8. Build frontend assets

```bash
npm run build
```

For local development, you can also use:

```bash
npm run dev
```

## ▶️ Running the Project

With Docker:

```bash
docker compose up
```

Then open:

- Storefront: http://localhost:8000
- Admin panel: http://localhost:8000/admin
- phpMyAdmin: http://localhost:8080
- Mailpit: http://localhost:8025

For a direct local run without Docker:

```bash
php artisan serve
npm run dev
```

## 🧪 Testing

The repository includes PHPUnit tests under [tests](tests), including examples for OTP logic and password reset flows. However, the test suite is limited and not broad enough to claim complete coverage across the entire application.

To run the test suite:

```bash
php artisan test
```

## 🚧 Future Improvements

The codebase shows a mature storefront and admin foundation, and a few natural follow-ups would be:

- expanding the localization layer into a full app-wide i18n implementation
- improving the order and shipping workflow with more advanced payment and fulfillment logic
- broadening automated test coverage for storefront and checkout flows
- adding more administrative reports and analytics

These are reasonable next steps based on the current code, but they are not currently implemented as core features.

## 👨‍💻 Author

This project is authored in the existing repository context and is intended as a Laravel e-commerce implementation for BeFit. The project does not currently include a separate author file or portfolio metadata beyond the codebase itself.

## 📄 License

This project declares the MIT license in [composer.json](composer.json).
