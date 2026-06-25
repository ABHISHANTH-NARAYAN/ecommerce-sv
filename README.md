# Laravel E-Commerce Platform

A fully functional, modern e-commerce platform built with Laravel. This project provides a robust foundation for online stores, featuring user authentication, product management, shopping cart, checkout processing, and an administrative dashboard.

## 🚀 Features

### User-Facing (Frontend)
- **Authentication**: User registration, login, and profile management (powered by Laravel Breeze).
- **Product Catalog**: Browse products by brands, colors, and categories.
- **Shopping Cart & Wishlist**: Add products to cart or save them for later.
- **Checkout & Orders**: Seamless checkout process and order tracking.
- **Reviews & Ratings**: Customers can leave reviews for products.
- **News/Blog**: Integrated news and articles section.
- **Contact/Enquiry System**: Allow users to submit enquiries easily.

### Admin Dashboard
- **Product Management**: Create, update, and delete products, categories, brands, and colors.
- **Order Management**: View and process customer orders.
- **User Management**: Manage registered users and user roles.
- **Data Tables**: Efficient server-side rendering of lists using Yajra DataTables.

## 🛠️ Tech Stack

- **Framework**: [Laravel](https://laravel.com/) (PHP ^8.3)
- **Frontend Assets**: [Tailwind CSS](https://tailwindcss.com/) & [Alpine.js](https://alpinejs.dev/)
- **Bundler**: [Vite](https://vitejs.dev/)
- **DataTables**: [Yajra DataTables](https://yajrabox.com/docs/laravel-datatables)

## ⚙️ Installation

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/ABHISHANTH-NARAYAN/ecommerce-sv.git
   cd ecommerce-sv
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   Copy the `.env.example` file to `.env` and configure your database settings.
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations & Seeders**
   Set up your database tables and populate them with dummy data.
   ```bash
   php artisan migrate --seed
   ```

7. **Compile Frontend Assets**
   ```bash
   npm run dev
   ```

8. **Start the Local Development Server**
   ```bash
   php artisan serve
   ```
   The application will be accessible at `http://localhost:8000`.

## 📜 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
