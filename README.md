# 🏋️ BeFit Store

A full-stack sportswear e-commerce platform built with **Laravel 12**, designed for selling athletic apparel, sportswear, and related products.

BeFit provides a complete **server-rendered web storefront** built with Laravel Blade, together with a **Filament-powered admin dashboard** for managing products, categories, variants, users, orders, shipping options, and other store operations.

The project follows a clean Laravel architecture with **Controllers, Form Requests, Services, Eloquent Models, and Filament Resources**, keeping business logic organized and maintainable.

---

## ✨ Features

### 🛍️ Shopping Experience

* Browse products by category and subcategory
* Product listing with filtering
* Product search suggestions
* Product details page
* Multiple product images
* Product image gallery
* Product variants
* Color and size selection
* Variant-specific stock management
* Variant-specific pricing support
* Product badges and availability
* Related product browsing
* Responsive sportswear storefront

### 🎨 Product Variants

BeFit supports product variants based on:

* Colors
* Sizes
* Stock quantity
* SKU
* Variant pricing

Each product can have multiple combinations of colors and sizes, allowing the store to manage inventory at the variant level.

---

### 👤 Authentication

* User registration
* User login
* User logout
* Email OTP verification
* 6-digit OTP verification
* OTP resend functionality
* OTP-based password reset
* Google OAuth login
* Session-based authentication
* Separate admin authentication through Filament

---

### 🛒 Cart

* Guest shopping cart
* Authenticated user cart
* Add products to cart
* Update quantities
* Remove cart items
* Clear cart
* Variant-aware cart items
* Stock validation
* Product availability validation

---

### ❤️ Wishlist

* Add products to wishlist
* Remove products from wishlist
* Save products for later
* Wishlist integration with the storefront

---

### 💳 Checkout & Orders

* Checkout process
* Customer shipping information
* Governorate-based shipping options
* Shipping price calculation
* Order creation
* Order items with selected variants
* Order history
* Order details
* Pending order cancellation
* Stock handling during order cancellation

> Payment gateway integration can be added later as part of the project's future development.

---

## 🖥️ Admin Panel

BeFit includes a dedicated **Filament Admin Dashboard** for managing the store.

### Admin Features

* Product management
* Category management
* Subcategory management
* User management
* Order management
* Color management
* Size management
* Shipping option management
* Product image management
* Product variant management
* Stock management
* Product availability management

The admin dashboard provides CRUD interfaces for the main e-commerce entities and allows administrators to manage the store without directly interacting with the database.

Admin panel:

```text
/admin
```

---

## 🏗️ Architecture

BeFit follows a practical Laravel architecture based on separation of responsibilities.

```text
                    ┌──────────────────┐
                    │   Blade Views    │
                    └────────┬─────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │   Controllers    │
                    └────────┬─────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │    Services      │
                    │ Business Logic   │
                    └────────┬─────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │ Eloquent Models  │
                    └────────┬─────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │    Database      │
                    └──────────────────┘
```

### Controllers

Controllers are responsible for handling HTTP requests and returning the appropriate response or view.

They are kept focused on request handling while business logic is delegated to service classes.

---

### Services

Business logic is organized inside service classes.

Typical responsibilities include:

| Service              | Responsibility                                            |
| -------------------- | --------------------------------------------------------- |
| `ProductService`     | Product listing, filtering and product-related operations |
| `CategoryService`    | Category-related operations                               |
| `SubCategoryService` | Subcategory and product relationships                     |
| `CartService`        | Cart operations and stock validation                      |
| `CheckoutService`    | Checkout and order processing                             |
| `OrderService`       | Order operations and cancellation                         |
| `OtpService`         | OTP generation and verification                           |
| `AuthService`        | Authentication-related business logic                     |
| `WishlistService`    | Wishlist operations                                       |
| `SocialAuthService`  | Google authentication                                     |
| `ShippingService`    | Shipping option and price handling                        |

> Service names may vary depending on the current implementation. The important architectural principle is keeping business logic outside controllers whenever practical.

---

## 🧩 Form Requests

BeFit uses Laravel Form Requests to handle request validation.

This keeps validation rules separated from controllers and makes request handling easier to maintain.

Examples include validation for:

* Cart operations
* Checkout information
* User profile information
* Wishlist operations
* OTP verification
* Product-related requests
* Authentication-related requests

---

## 🗄️ Database Models

The main e-commerce entities include:

| Model            | Responsibility                          |
| ---------------- | --------------------------------------- |
| `User`           | Store customers and authentication data |
| `Category`       | Product categories                      |
| `Subcategory`    | Categories' subcategories               |
| `Product`        | Main store products                     |
| `ProductImage`   | Product gallery images                  |
| `ProductVariant` | Product color/size combinations         |
| `Color`          | Available product colors                |
| `Size`           | Available product sizes                 |
| `Cart`           | Shopping cart items                     |
| `Order`          | Customer orders                         |
| `OrderItem`      | Products included in orders             |
| `ShippingOption` | Shipping price by governorate           |

### Main Relationships

```text
Category
   │
   ├── hasMany → Subcategories
   │
   └── hasMany → Products
                    │
                    ├── hasMany → ProductImages
                    │
                    └── hasMany → ProductVariants
                                      │
                                      ├── belongsTo → Color
                                      │
                                      └── belongsTo → Size
```

Orders are connected to users and contain order items representing the purchased products and their selected variants.

---

## 🔐 Security Features

BeFit uses Laravel's built-in security mechanisms together with application-level validation.

### Authentication Security

* Password hashing through Laravel
* Session-based authentication
* CSRF protection
* OTP-based email verification
* OTP-based password reset
* OTP expiration/verification handling
* Google OAuth authentication
* Separate admin authentication through Filament

### E-commerce Security

* Authentication checks for protected operations
* Cart ownership validation
* Product/variant availability validation
* Stock validation before checkout
* Validation of checkout information
* Authorization checks for user-owned data
* Admin access control

---

## 🌍 Localization

BeFit supports bilingual product-related content.

The catalog can contain:

* English product names
* Arabic product names
* English category names
* Arabic category names
* English subcategory names
* Arabic subcategory names
* English color names
* Arabic color names
* English size names
* Arabic size names

The localization approach is primarily focused on **catalog data**, allowing products and store entities to contain both Arabic and English content.

---

## 🎨 Frontend

The storefront is built using Laravel Blade and a responsive frontend design.

### Frontend Technologies

* Laravel Blade
* Bootstrap 5
* Custom CSS
* JavaScript
* Vite
* Font Awesome
* Responsive layouts
* Custom UI components

The frontend focuses on a modern sportswear aesthetic with:

* Hero sections
* Product cards
* Category sections
* Product galleries
* Filters
* Shopping cart interface
* Wishlist interface
* Responsive navigation
* Mobile-friendly layouts

---

## 🐳 Docker Setup

BeFit is configured to run using Docker.

### Docker Stack

The project includes Docker configuration for the Laravel application and supporting services.

Typical services include:

| Service            | Purpose                        |
| ------------------ | ------------------------------ |
| `befit_app`        | PHP/Laravel application        |
| `befit_nginx`      | Nginx web server               |
| `befit_phpmyadmin` | Database administration        |
| MySQL              | Application database           |
| Redis              | Cache/session-related services |

Docker allows the development environment to remain isolated and consistent across machines.

---

## 💻 Requirements

Before running BeFit locally, make sure you have:

* Docker Desktop
* Docker Compose
* WSL2
* Ubuntu on WSL2
* Git
* VS Code
* GitHub account

For Windows development, **WSL2 + Docker** is recommended.

---

## 🚀 Installation

### 1. Clone the Repository

Clone the project from GitHub:

```bash
cd /home/orabii

git clone https://github.com/mohamedorabii/BeFit-Store.git

cd BeFit-Store
```

---

### 2. Open the Project in VS Code

```bash
code .
```

---

### 3. Configure Environment Variables

Create the environment file:

```bash
cp .env.example .env
```

Configure the database, application URL, mail settings, and other required environment variables according to your local Docker configuration.

---

### 4. Start Docker

Build and start the containers:

```bash
docker compose up -d --build
```

Check the running containers:

```bash
docker ps
```

---

### 5. Generate Application Key

Run:

```bash
docker exec -it befit_app php artisan key:generate
```

---

### 6. Run Database Migrations

```bash
docker exec -it befit_app php artisan migrate
```

If seeders are available and you want to populate the database:

```bash
docker exec -it befit_app php artisan db:seed
```

Or:

```bash
docker exec -it befit_app php artisan migrate --seed
```

---

### 7. Create Storage Link

```bash
docker exec -it befit_app php artisan storage:link
```

---

### 8. Install Frontend Dependencies

If Node/npm is handled inside the project environment:

```bash
npm install
```

Then build the frontend:

```bash
npm run build
```

For development:

```bash
npm run dev
```

---

## 🌐 Local URLs

After starting Docker, the application can be accessed through:

| Service         | URL                           |
| --------------- | ----------------------------- |
| 🏋️ BeFit Store | `http://localhost:8000`       |
| 🖥️ Admin Panel | `http://localhost:8000/admin` |
| 🗄️ phpMyAdmin  | `http://localhost:8080`       |

> Ports depend on the values configured in `docker-compose.yml`.

---

## 🔧 Daily Development

Start the containers:

```bash
cd /home/orabii/BeFit-Store

docker compose up -d
```

Open the project:

```bash
code .
```

Check containers:

```bash
docker ps
```

Stop the project:

```bash
docker compose down
```

Rebuild containers when Docker configuration changes:

```bash
docker compose up -d --build
```

---

## 🧹 Useful Laravel Commands

Clear application caches:

```bash
docker exec -it befit_app php artisan optimize:clear
```

Run migrations:

```bash
docker exec -it befit_app php artisan migrate
```

Refresh migrations:

```bash
docker exec -it befit_app php artisan migrate:fresh
```

Run seeders:

```bash
docker exec -it befit_app php artisan db:seed
```

Create storage link:

```bash
docker exec -it befit_app php artisan storage:link
```

Open Laravel Tinker:

```bash
docker exec -it befit_app php artisan tinker
```

---

## 🔧 Tech Stack

### Backend

| Technology        | Purpose                      |
| ----------------- | ---------------------------- |
| PHP               | Backend programming language |
| Laravel 12        | Web application framework    |
| Eloquent ORM      | Database interaction         |
| Laravel Blade     | Server-side rendering        |
| Laravel Socialite | Google OAuth                 |
| Laravel UI        | Authentication scaffolding   |
| Filament          | Admin dashboard              |

### Frontend

| Technology   | Purpose                  |
| ------------ | ------------------------ |
| Blade        | Server-rendered views    |
| Bootstrap 5  | UI framework             |
| JavaScript   | Client-side interactions |
| Vite         | Frontend build tool      |
| Font Awesome | Icons                    |
| Custom CSS   | Storefront styling       |

### Infrastructure

| Technology | Purpose                       |
| ---------- | ----------------------------- |
| Docker     | Containerized development     |
| Nginx      | Web server                    |
| MySQL      | Relational database           |
| Redis      | Caching / application support |
| phpMyAdmin | Database management           |

---

## 📁 Project Structure

```text
BeFit-Store/
│
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   └── Pages/
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Requests/
│   │   └── Middleware/
│   │
│   ├── Models/
│   │
│   ├── Notifications/
│   │
│   ├── Providers/
│   │
│   └── Services/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── docker/
│   └── nginx/
│
├── public/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   └── web.php
│
├── storage/
│   └── app/
│
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── docker-compose.yml
├── package.json
├── phpunit.xml
├── vite.config.js
└── README.md
```

---

## 🧪 Testing

BeFit includes a Laravel testing structure under the `tests` directory.

Run the test suite with:

```bash
docker exec -it befit_app php artisan test
```

You can also run a specific test file:

```bash
docker exec -it befit_app php artisan test tests/Feature/ExampleTest.php
```

---

## 📦 Storage

Product images and other publicly accessible files can be handled through Laravel's public storage disk.

Create the symbolic link using:

```bash
docker exec -it befit_app php artisan storage:link
```

The public storage directory is connected to:

```text
public/storage
```

---

## 🔄 Application Flow

A typical shopping flow looks like:

```text
Customer
   │
   ▼
Browse Store
   │
   ▼
Select Product
   │
   ├── Select Color
   │
   └── Select Size
   │
   ▼
Add to Cart
   │
   ▼
Review Cart
   │
   ▼
Checkout
   │
   ▼
Select Shipping Option
   │
   ▼
Create Order
   │
   ▼
Order History
```

---

## 🛡️ Admin Flow

```text
Administrator
      │
      ▼
   /admin
      │
      ▼
Filament Dashboard
      │
      ├── Products
      │     ├── Images
      │     ├── Colors
      │     ├── Sizes
      │     └── Variants
      │
      ├── Categories
      │
      ├── Subcategories
      │
      ├── Users
      │
      ├── Orders
      │
      └── Shipping Options
```

---

## 🚧 Future Improvements

Potential future improvements include:

* Online payment gateway integration
* More advanced product variant management
* Additional product attributes
* Advanced analytics
* Improved order management
* More automated tests
* Advanced search
* Performance optimization
* Full application-wide Arabic/English localization
* Deployment and production optimization

---

## 📌 Project Status

BeFit Store is a **Laravel-based sportswear e-commerce project** focused on providing a complete online shopping experience with product variants, inventory management, cart, wishlist, checkout, orders, authentication, and an administrative dashboard.

The current application is a **web application** and does **not include a REST API**.

---

## 👨‍💻 Author

**Mohamed Alaa Oraby**

Junior Backend Developer | PHP · Laravel

📧 `devmohamedalaaoraby@gmail.com`
