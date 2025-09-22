BookVault – Library Manager

A small Laravel application to manage books, categories, and borrow records with role-based access.

Table of Contents

Overview

Features

Tech Stack

Setup Instructions

Database Setup

Running Seeders

Creating Admin & Member Users

Running the Application

Running Tests

Sample Credentials

Notes

Overview

BookVault is a Laravel-based system that allows:

Admins to manage books, categories, and users.

Members to browse, search, borrow, and return books.

Tracking of borrow history and overdue books.

Email notifications for overdue books (using DB queue driver).

Features

Authentication & Roles: Admin & Member roles.

Books & Categories: CRUD for books and categories. Each book belongs to a category.

Borrowing System:

Members can borrow and return books.

Stock is automatically updated.

Borrow history is maintained.

Search & Filters:

Search books by title or author.

Filter by category or availability.

Dashboards:

Admin: total books, borrowed books count, overdue records.

Member: list of borrowed books with due dates.

Notifications: Overdue email reminders (DB queue).

Policies: Access control for Admin vs Member actions.

Blade & Tailwind: UI built using Laravel Blade templates and Tailwind CSS.

Tech Stack

Laravel 10/11

MySQL

Blade templates + Tailwind CSS

Policies for access control

Laravel Queues (DB driver)

Setup Instructions

Clone the repository

git clone https://github.com/LIYANMUBARAK/book-vault.git
cd bookvault


Install dependencies

composer install
npm install
npm run dev


Environment configuration

cp .env.example .env


Update .env with your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookvault
DB_USERNAME=root
DB_PASSWORD=secret


Generate application key

php artisan key:generate

Database Setup

Run migrations

php artisan migrate


Run seeders

php artisan db:seed


This will create sample categories and books.

Creating Admin & Member Users

We have an Artisan command to create users:

php artisan user:create

Running the Application

Start the local server:

php artisan serve

Also, make sure to run the Tailwind watcher:

npm run dev

Visit: http://127.0.0.1:8000


Running Tests
php artisan test


Feature tests cover borrow/return flow, authentication, profile updates, and more.

Sample Credentials

Admin:

Email: admin@example.com

Password: password

Member:

Email: member@example.com

Password: password

You can also create additional users using the Artisan command above.
