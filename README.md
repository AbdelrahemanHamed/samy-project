# Sports Club Management System 🏅

A full-stack management system designed to streamline operations for a Sports Club. This system seamlessly integrates a **Next.js** frontend with a **Laravel** backend, backed by a fully normalized **MySQL** database.

---

## 🏗️ Technology Stack

| Component | Technology | Description |
| :--- | :--- | :--- |
| **Frontend** | [Next.js](https://nextjs.org/) + React | Modern, fast, and responsive user interface built with App Router. |
| **Styling** | [Tailwind CSS](https://tailwindcss.com/) | Beautiful, custom glassmorphism design with dynamic gradients. |
| **Backend** | [Laravel](https://laravel.com/) (PHP) | Robust RESTful API architecture. |
| **Database** | MySQL | Fully normalized (3NF) relational database. |

---

## 🗄️ Database Architecture (MySQL)

The database was meticulously designed starting from a conceptual ERD and strictly normalized up to the **Third Normal Form (3NF)** to ensure zero data redundancy and absolute data integrity.

### Core Tables & Relationships
1. **Members (`members`)**: Stores personal details (Name, Gender, DOB).
2. **Staff (`staff`)**: Employees managing the club.
3. **Coaches (`coaches`)**: Trainers assigned to specific sports.
4. **Facilities (`facilities`)**: Physical locations (Pools, Fields) managed by Staff.
5. **Sports (`sports`)**: Activities hosted in Facilities and trained by Coaches.
6. **Equipment (`equipment`)**: Inventory used across various sports.

### Pivot / Junction Tables (M:N Relationships)
*   **`enrolls`**: Connects Members to Sports.
*   **`uses`**: Connects Sports to Equipment.
*   **`dependents` & `member_phones`**: Handles multi-valued attributes and weak entities using composite primary keys.

> *Note: The full database schema is located in `laravel-core-files/database/migrations/2026_01_01_000000_create_sports_club_tables.php`.*

---

## ⚙️ Backend Documentation (Laravel)

The Laravel backend is structured to provide a clean, RESTful API. The core files are currently located in the `laravel-core-files/` directory, ready to be dropped into a fresh Laravel installation.

### 1. Eloquent Models (`app/Models/`)
All database relationships are mapped natively in Laravel using Eloquent:
*   `hasMany()` / `belongsTo()` for 1-to-Many relationships (e.g., Staff -> Facilities).
*   `belongsToMany()` for Many-to-Many relationships (e.g., Members -> Sports).
*   Composite Keys are supported by disabling increments (`public $incrementing = false;`).

### 2. Controllers (`app/Http/Controllers/`)
The `MemberController` handles incoming API requests. 
*   **Eager Loading**: It uses `Member::with(['sports', 'payments', 'dependents'])` to fetch related data instantly, preventing the N+1 query problem.
*   **Validation**: Built-in request validation ensures only clean data enters the database.

### 3. API Routes (`routes/api.php`)
*   `GET /api/members` - Fetch all members.
*   `POST /api/members` - Register a new member.
*   `GET /api/members/{id}` - Fetch a specific member.

---

## 🎨 Frontend Documentation (Next.js)

The frontend is built for administrators, prioritizing aesthetic excellence ("Glassmorphism") and user experience. 

### Key Pages
1. **Dashboard (`/`)**: A sleek landing page giving an overview of the club's modules (Members, Facilities, Finances) with interactive UI cards.
2. **Member Directory (`/members`)**: A data table displaying all registered members. It actively fetches data from the Laravel API (`GET /api/members`). If the API is offline, it gracefully falls back to mock data so the UI remains functional.
3. **Facilities Manager (`/facilities`)**: A grid layout displaying club facilities, their capacities, and assigned managers. Features a smooth, blurred modal form for adding new facilities.

---

## 🚀 Installation & Setup Guide

### 1. Running the Next.js Frontend
Requirements: [Node.js](https://nodejs.org/) installed.

```bash
# 1. Navigate to the frontend directory
cd frontend

# 2. Install dependencies
npm install

# 3. Start the development server
npm run dev
```
*Open [http://localhost:3000](http://localhost:3000) in your browser.*

### 2. Setting up the Laravel Backend
Requirements: [PHP](https://www.php.net/), [Composer](https://getcomposer.org/), and MySQL installed.

```bash
# 1. Create a fresh Laravel project in the root folder (if not already done)
composer create-project laravel/laravel backend

# 2. Copy the contents of `laravel-core-files` into the new `backend` folder
cp -r laravel-core-files/* backend/

# 3. Configure your .env file in the `backend` folder to connect to your MySQL database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sports_club
DB_USERNAME=root
DB_PASSWORD=

# 4. Run the database migrations
cd backend
php artisan migrate

# 5. Start the Laravel API server
php artisan serve
```
*The API will now be running at [http://localhost:8000](http://localhost:8000).*

---
*Developed by Abdelraheman Hamed & Team.*
