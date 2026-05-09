# 🏠 We-Invite — Rental Property Directory Platform

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00758F?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38BDF8?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![PWA](https://img.shields.io/badge/PWA-Enabled-5A0FC8?style=for-the-badge&logo=pwa&logoColor=white)

> **We-Invite** is a web-based rental property directory platform that connects room seekers with property owners. Built with Laravel 10, featuring a responsive interface, a multi-role management system, and **Progressive Web App (PWA)** support for the Owner Panel.

</div>

---

## 📌 Project Overview

We-Invite makes it easy for people to find boarding houses, rooms, or rental properties in their area. The platform supports three distinct user roles:

| Role | Access |
|---|---|
| 🛡️ **Admin** | Full data management: properties, owners, facilities, areas, and more |
| 🏡 **Owner** | Manage their own listings: room count, pricing, and availability |
| 🌐 **Public** | Browse, filter, and view property details without login |

---

## ✨ Key Features

- **Public Pages (Home)**
  - Property listing with pagination (12 items per page)
  - Featured property slider (`panel_utama = 'on'`)
  - Filter by area, category, and rental system
  - Filter for rarely viewed & never viewed properties
  - Detailed property page (facilities, rules, highlights, photos)
  - Automatic view/traffic tracker per property
  - Direct WhatsApp redirect to customer service
  - About Company page

- **Admin Panel**
  - Dedicated admin login with custom guard (`auth.admin`)
  - Dashboard summary: total properties, owners, and traffic
  - Dynamic CRUD for all managed tables via a single `AdminController`
  - Managed tables: `data_kontrakan`, `data_pemilik`, `data_fasilitas`, `data_detail_fasilitas`, `data_wilayah`, `data_peraturan`, `data_kelebihan`, `data_admin`
  - Upload up to 5 photos per property
  - Per-column data search
  - Admin profile management

- **Owner Panel**
  - Dedicated owner login with custom guard (`auth.owner`)
  - Owner dashboard
  - Update room count and room pricing
  - **PWA (Progressive Web App) support** — installable on mobile & desktop

---

## 📱 Progressive Web App (PWA)

We-Invite includes PWA support specifically for the **Owner Panel**, allowing property owners to install the application on their device and use it like a native app.

### PWA Files

| File | Location | Description |
|---|---|---|
| `manifest.json` | `public/pwa/manifest.json` | App metadata for installation |
| `service_worker.js` | `public/pwa/service_worker.js` | Offline caching & background sync |

### Manifest Configuration

```json
{
  "name": "KostKito.com",
  "short_name": "KostKito.com",
  "start_url": "/owner",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#ff8238",
  "icons": [...]
}
```

- **`display: standalone`** — The app opens without a browser toolbar, giving it a native app feel.
- **`start_url: /owner`** — When launched from the home screen, the app goes directly to the Owner Dashboard.
- **`theme_color: #ff8238`** — Brand orange applied to the status bar on mobile.

### Service Worker — Caching Strategy

The service worker (`public/pwa/service_worker.js`) implements a **Cache-First** strategy:

1. **Install** — Pre-caches essential assets on first load:
   - `/owner` — Owner dashboard
   - `/owner/login_page` — Owner login page
   - `/img_logo/new_kostkito_form.png` — App icon

2. **Fetch** — Serves cached responses first; falls back to network if not cached.

3. **Activate** — Cleans up old cache versions automatically on update.

### How PWA is Registered

The manifest and service worker are linked in the Owner Panel's shared layout (`resources/views/components/header-owner.blade.php`):

```html
<link rel="manifest" href="{{ url('pwa/manifest.json') }}">
```

> **Note:** PWA is scoped to the **Owner Panel only**. The public home page and admin panel do not have PWA support.



## 🛠️ Tech Stack

| Component | Technology |
|---|---|
| **Backend Framework** | Laravel 10.x |
| **Language** | PHP 8.1+ |
| **Database** | MySQL |
| **Frontend Styling** | Tailwind CSS 3.x + `@tailwindcss/forms` |
| **JavaScript** | Alpine.js 3.x + Axios |
| **Build Tool** | Vite 5.x + `laravel-vite-plugin` |
| **Authentication** | Laravel Breeze + Laravel Sanctum |
| **HTTP Client** | Guzzle HTTP |
| **Testing** | PHPUnit 10.x |

---

## 🗂️ Directory Structure

```
we-invite/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php     # Dynamic CRUD for all tables
│   │   │   ├── HomeController.php      # Listing, detail, filter, traffic
│   │   │   ├── OwnerController.php     # Owner dashboard & actions
│   │   │   └── ProfileController.php  # Admin profile management
│   │   └── Middleware/
│   ├── Models/
│   │   ├── DataKontrakan.php           # Main model with full relationships
│   │   ├── DataPemilik.php
│   │   ├── DataFasilitas.php
│   │   ├── DataDetailFasilitas.php
│   │   ├── DataWilayah.php
│   │   ├── DataTraffic.php
│   │   ├── DataAdmin.php
│   │   ├── DataPeraturan.php
│   │   ├── DataKelebihan.php
│   │   └── User.php
│   └── Helpers/
│       └── general.php                 # Helper functions (id_otomatis, move_files)
├── database/
│   ├── migrations/                     # 16 migration files
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── home/                       # Public-facing views
│   │   ├── admin/                      # Admin panel views
│   │   ├── owner/                      # Owner panel views
│   │   ├── layouts/                    # Shared layouts
│   │   └── components/                 # Blade components
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php                         # All web routes (public, admin, owner)
│   ├── api.php
│   └── auth.php
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
└── vite.config.js
```

---

## 🗄️ Database Schema

| Table | Description |
|---|---|
| `users` | Default Laravel users |
| `data_admin` | Admin account data |
| `data_pemilik` | Property owner data |
| `data_kontrakan` | Main rental property data |
| `data_fasilitas` | Facilities per property (pivot to facility details) |
| `data_detail_fasilitas` | Master list of facility types |
| `data_wilayah` | Master area/region list |
| `data_peraturan` | House rules per property |
| `data_kelebihan` | Highlights/advantages per property |
| `data_traffic` | View counter per property |

---

## 🚀 Installation

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Web server (Laragon / XAMPP / Laravel Sail)

### Setup Steps

```bash
# 1. Clone the repository
git clone <repository-url> we-invite
cd we-invite

# 2. Install PHP dependencies
composer install

# 3. Install Node.js dependencies
npm install

# 4. Copy the environment file
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Configure your database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=we_invite
DB_USERNAME=root
DB_PASSWORD=

# 7. Run database migrations
php artisan migrate

# 8. (Optional) Run seeders
php artisan db:seed

# 9. Build frontend assets
npm run build

# 10. Start the development server
php artisan serve
```

### Development Mode (Hot Reload)

```bash
# Terminal 1 — Laravel dev server
php artisan serve

# Terminal 2 — Vite dev server
npm run dev
```

Visit the application at: `http://localhost:8000` or `http://we-invite.test` (Laragon)

---

## 🌐 Route Reference

### Public Routes
| Method | URL | Description |
|---|---|---|
| `GET` | `/` | Home page (property listing) |
| `GET` | `/detail_home/{id}` | Property detail page |
| `GET` | `/daftar/{kategori}` | Filter by category |
| `GET` | `/daftar/jarang` | Rarely viewed properties |
| `GET` | `/daftar/belum` | Never viewed properties |
| `POST` | `/home/find_kontrakan` | Search properties (area/category/system) |
| `GET` | `/home/about` | About company page |
| `GET` | `/costumer_service` | Redirect to WhatsApp customer service |

### Admin Routes (prefix `/admin`, middleware `auth.admin`)
| Method | URL | Description |
|---|---|---|
| `GET` | `/admin/logon` | Admin login page |
| `POST` | `/admin/action/login` | Process admin login |
| `GET` | `/admin/dashboard` | Admin dashboard |
| `GET` | `/admin/menu/{table}` | List data for a table |
| `GET` | `/admin/menu/{table}/tambah` | Add new data form |
| `POST` | `/admin/menu/{table}/tambah` | Save new data |
| `GET` | `/admin/menu/{table}/edit/{id}` | Edit data form |
| `PUT` | `/admin/menu/{table}/proses_edit/{id}` | Update data |
| `POST` | `/admin/menu/{table}/proses_hapus/{id}` | Delete data |
| `GET` | `/admin/menu/{page}/detail/{id}` | View data detail |
| `POST` | `/admin/logout` | Admin logout |

### Owner Routes (middleware `auth.owner`)
| Method | URL | Description |
|---|---|---|
| `GET` | `/owner/login_page` | Owner login page |
| `POST` | `/login/owner/request` | Process owner login |
| `GET` | `/owner` | Owner dashboard |
| `POST` | `/action/update/j_kamar` | Update room count |
| `POST` | `/owner/set_hargakamar` | Update room pricing |
| `POST` | `/owner/logout` | Owner logout |

---

## 🔑 Key Environment Variables

```env
APP_NAME=We-Invite
APP_ENV=local
APP_KEY=           # Auto-generated via artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=we_invite
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📦 Dependencies

### PHP (Composer)
| Package | Version | Purpose |
|---|---|---|
| `laravel/framework` | ^10.10 | Core framework |
| `laravel/sanctum` | ^3.3 | API token authentication |
| `guzzlehttp/guzzle` | ^7.2 | PHP HTTP client |
| `laravel/breeze` | ^1.29 | Authentication starter kit |

### JavaScript (NPM)
| Package | Version | Purpose |
|---|---|---|
| `vite` | ^5.0.0 | Frontend build tool |
| `tailwindcss` | ^3.1.0 | Utility-first CSS framework |
| `alpinejs` | ^3.4.2 | Lightweight JS reactivity |
| `axios` | ^1.6.4 | JavaScript HTTP client |
| `@tailwindcss/forms` | ^0.5.2 | Default form styling reset |

---

## 📝 License

This project was developed for internal use. All rights reserved.

---

<div align="center">

Built with ❤️ using **Laravel 10** + **Tailwind CSS**

</div>
