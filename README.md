# 📚 BookVault – Library Manager

A **modern Laravel application** to manage books, categories, and borrow records with **role-based access control**.

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Setup Instructions](#setup-instructions)
- [Database Setup](#database-setup)
- [Running Seeders](#running-seeders)
- [Creating Admin & Member Users](#creating-admin--member-users)
- [Running the Application](#running-the-application)
- [Running Tests](#running-tests)
- [Sample Credentials](#sample-credentials)
- [Notes](#notes)

## 🎯 Overview

**BookVault** is a Laravel-based library management system that provides:

- **👨‍💼 Admin capabilities**: Manage books, categories, and users
- **👤 Member features**: Browse, search, borrow, and return books
- **📊 Tracking system**: Borrow history and overdue book monitoring
- **📧 Email notifications**: Automated overdue book reminders using DB queue driver

## ✨ Features

### 🔐 Authentication & Roles
- **Admin** & **Member** role-based access control

### 📖 Books & Categories
- **CRUD operations** for books and categories
- Each book belongs to a specific category
- Stock management system

### 📚 Borrowing System
- Members can **borrow** and **return** books seamlessly
- **Automatic stock updates**
- Complete **borrow history** maintenance

### 🔍 Search & Filters
- **Search books** by title or author
- **Filter** by category or availability status

### 📊 Dashboards
- **Admin Dashboard**: 
  - Total books count
  - Currently borrowed books
  - Overdue records monitoring
- **Member Dashboard**: 
  - Personal borrowed books list
  - Due dates tracking

### 🔔 Notifications
- **Automated overdue email reminders** (DB queue system)

### 🛡️ Security
- **Laravel Policies** for granular access control
- Separate Admin vs Member action permissions

### 🎨 UI/UX
- **Laravel Blade templates** with **Tailwind CSS**
- Responsive and modern design

## 🛠️ Tech Stack

| Technology | Purpose |
|-----------|---------|
| **Laravel 10/11** | Backend Framework |
| **MySQL** | Database |
| **Blade Templates** | Frontend Templating |
| **Tailwind CSS** | Styling Framework |
| **Laravel Policies** | Access Control |
| **Laravel Queues** | Background Jobs (DB driver) |

## 🚀 Setup Instructions

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/LIYANMUBARAK/book-vault.git
cd bookvault
```

### 2️⃣ Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
npm run dev
```

### 3️⃣ Environment Configuration
```bash
# Copy environment file
cp .env.example .env
```

**Update `.env` with your database credentials:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookvault
DB_USERNAME=root
DB_PASSWORD=secret
```

### 4️⃣ Generate Application Key
```bash
php artisan key:generate
```

## 🗄️ Database Setup

### Run Migrations
```bash
php artisan migrate
```

## 🌱 Running Seeders

```bash
php artisan db:seed
```
*This will create sample categories and books for testing.*

## 👥 Creating Admin & Member Users

We provide a convenient **Artisan command** to create users:

```bash
php artisan user:create
```

## 🖥️ Running the Application

### Start the Local Server
```bash
php artisan serve
```

### Start Tailwind Watcher
```bash
npm run dev
```

**Visit your application at:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 🧪 Running Tests

```bash
php artisan test
```

**Feature tests include:**
- Borrow/return workflow
- Authentication system
- Profile updates
- Access control verification

To manually test the email senting process :

```bash
php artisan test:overdue-email

php artisan queue:work
```

The above will create an overvue borrow entry and then run the worker where it will pickup the job from the job queue
and will sent the email.

## 🔑 Sample Credentials

### 👨‍💼 Admin Access
- **Email:** `admin@example.com`
- **Password:** `password`

### 👤 Member Access
- **Email:** `member@example.com`
- **Password:** `password`


## 📝 Notes

- Ensure **MySQL** is running before starting the application
- The **queue system** uses the database driver for email notifications
- All **policies** are configured to enforce proper access control
- **Tailwind CSS** provides responsive design out of the box




This project is open source and available under the [MIT License](LICENSE).
