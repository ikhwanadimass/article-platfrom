# 📰 Article Platform — Modern Editorial & Publishing System

A production-ready, full-featured publishing platform built with **Laravel 11**, **PHP 8.4**, and **Tailwind CSS**. Designed following contemporary editorial aesthetics with a focus on responsive UX, serverless cloud resilience, and robust content management workflows.

🔗 **Live Deployment:** [https://unaisoc-project.vercel.app](https://unaisoc-project.vercel.app)  
📁 **Repository:** [https://github.com/ikhwanadimass/article-platfrom](https://github.com/ikhwanadimass/article-platfrom)

---

## 📋 Table of Contents
1. [Project Overview & Key Features](#-project-overview--key-features)
2. [Tech Stack & Architecture](#-tech-stack--architecture)
3. [Live Deployment & Demo Credentials](#-live-deployment--demo-credentials)
4. [Local Installation & Setup Guide](#-local-installation--setup-guide)
5. [AI Usage Report & Guidelines](#-ai-usage-report--guidelines)
   - [1. AI Tools Used](#1-ai-tools-used)
   - [2. Prompt Documentation](#2-prompt-documentation)
   - [3. AI Contribution Breakdown](#3-ai-contribution-breakdown)
   - [4. Technical Understanding & Implementation Choices](#4-technical-understanding--implementation-choices)

---

## 🌟 Project Overview & Key Features

### 👤 Public Experience
- **Editorial Homepage:** Curated article showcase featuring a prominent hero article, categorized editorial lists, and dynamic category filters.
- **Instant Search:** Real-time query search filtering articles by title, snippet, and category.
- **Reading Experience:** Clean typography, rich-text rendering, author metadata, publication dates, and related article links.
- **Author Profiles:** Dedicated author views showing bio, credentials, and published catalog.

### ✍️ Editorial & Content Management (Admin)
- **Draft & Publish Workflows:** Two-step editorial lifecycle allowing writers to save drafts securely or publish immediately.
- **Interactive Rich Text Toolbar:** WYSIWYG editor supporting bold, italic, underline, bullet lists, and hyperlinking.
- **Drag & Drop Image Upload:** Intuitive cover image upload supporting drag-and-drop on both desktop and mobile viewports with real-time thumbnail preview.
- **Profile & Account Management:** Seamless avatar customization, name, bio, and password updates.
- **Fully Responsive Design:** Precision-crafted layout optimized for mobile screens (bottom navigation, swipe-friendly forms) and desktop dashboards (sidebar, modal editors).

---

## 🛠️ Tech Stack & Architecture

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 11 (PHP 8.4) |
| **Frontend Styling** | Tailwind CSS v4 & Alpine / Vanilla JS |
| **Typography** | Geist Font Family |
| **Database** | MySQL (Local) & TiDB Cloud Serverless (Production) |
| **Cloud Hosting** | Vercel Serverless Functions (`vercel-php`) |
| **Code Formatter & QA** | Laravel Pint & PHPUnit |

---

## 🚀 Live Deployment & Demo Credentials

The application is deployed on **Vercel Serverless** with a high-availability **TiDB Cloud Serverless MySQL** backend.

- **URL:** [https://unaisoc-project.vercel.app](https://unaisoc-project.vercel.app)
- **Demo Admin Account:**
  - **Email:** `admin@gmail.com`
  - **Password:** `password123`

---

## 💻 Local Installation & Setup Guide

Follow these steps to run the application locally:

### Prerequisites
- PHP `>= 8.2` (PHP 8.4 recommended) with `pdo_mysql`, `openssl`, `mbstring`, `fileinfo` extensions enabled.
- Composer
- Node.js (v18+) & NPM
- MySQL database server (e.g. Laragon, XAMPP, or Docker)

### 1. Clone the Repository
```bash
git clone https://github.com/ikhwanadimass/article-platfrom.git
cd article-platfrom
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies & build frontend assets
npm install
npm run build
```

### 3. Environment Configuration
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```
Generate the application key:
```bash
php artisan key:generate
```

Configure your local database credentials in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=article_platform
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Database Migration & Seeding
Run migrations and load initial sample data (categories, demo administrator):
```bash
php artisan migrate:fresh --seed
```

### 5. Create Storage Symlink & Run Server
```bash
php artisan storage:link
php artisan serve
```

Access the platform at `http://127.0.0.1:8000`.

---

## 🤖 AI Usage Report & Guidelines

> In compliance with the **AI Usage Guidelines**, this section provides a transparent audit of the AI tools utilized, prompt evolution, component contributions, and the technical ownership demonstrated throughout the project.

### 1. AI Tools Used

| Tool | Role & Scope |
|---|---|
| **Antigravity (Google DeepMind)** | Autonomous Agentic AI coding partner. Assisted in iterative development, refactoring Blade layouts, terminal commands, test executions, and troubleshooting edge cases. |
| **Google Gemini (LLM Engine)** | Architectural reasoning, automated code linting/formatting reviews, and query optimization logic. |
| **Figma AI Agent** | Slicing design specs, extracting spacing/typography tokens, and translating Figma design nodes into responsive Tailwind CSS utilities. |

---

### 2. Prompt Documentation

Here is a curated log of critical prompts executed during development:

#### A. Architecture & Database Design
```text
Prompt:
"Desain skema database Laravel untuk Article Platform yang memiliki fitur CRUD artikel, 
kategori, status artikel (draft & published), slug otomatis, dan relasi ke tabel users sebagai author. 
Sertakan seeder default untuk kategori dan user admin."
```
*Outcome:* Generated clean Eloquent migrations, relationships (`Article -> belongsTo(User, Category)`), and structured `DatabaseSeeder`.

#### B. Slicing UI Figma & Tailwind CSS
```text
Prompt:
"Konversikan desain modal create dan edit artikel dari Figma ke Blade template menggunakan Tailwind CSS. 
Pastikan memiliki preview cover image di sisi kiri, toolbar styling teks (bold, italic, list, link), 
serta status tombol yang adaptif antara 'Save as Draft' dan 'Publish'."
```
*Outcome:* Responsive desktop modal and dedicated mobile views matching Figma design guidelines.

#### C. Vercel Serverless & TiDB Cloud SSL Troubleshooting
```text
Prompt:
"Deployment di Vercel gagal koneksi ke TiDB Cloud dengan error:
'PDOException: failed loading cafile stream certs/ca.pem'. 
Bagaimana cara konfigurasi SSL certificate CA TiDB Cloud di Vercel tanpa file lokal, 
atau memastikan path certs/ca.pem dapat diakses oleh serverless runtime?"
```
*Outcome:* Configured dynamically verified SSL options in `config/database.php` and verified certificate paths for Vercel's serverless environment.

#### D. Handling Read-Only Filesystem in Serverless
```text
Prompt:
"Saat upload thumbnail artikel di Vercel muncul error:
'League\Flysystem\UnableToCreateDirectory: Unable to create a directory at /var/task/user/storage/app/public/thumbnails'. 
Bagaimana arsitektur fallback penyimpanan gambar yang efisien di Vercel serverless tanpa perlu AWS S3 bucket terpisah?"
```
*Outcome:* Designed and implemented a hybrid storage strategy: saving files locally in standard environments, and falling back to compressed Base64 Data URI stored in `LONGTEXT` database columns when deployed on Vercel read-only filesystems.

#### E. Debugging Layout Clipping & Drag-and-Drop Implementation
```text
Prompt:
"Saat mengedit artikel yang berstatus draft, layout modal rusak: kolom Author tertekan jadi 'AU' 
dan tombol Update terdorong keluar modal. Juga implementasikan agar upload thumbnail bisa drag-and-drop."
```
*Outcome:* Identified flexbox minimum width default (`min-width: auto`), refactored input fields to a CSS grid (`grid-cols-2`), added `min-w-0` to the flex container, and wired HTML5 drag-and-drop event listeners (`dragenter`, `dragover`, `dragleave`, `drop`).

---

### 3. AI Contribution Breakdown

```
┌─────────────────────────────────────────────────────────────┐
│                       PROJECT WORKFLOW                      │
├──────────────────────────────┬──────────────────────────────┤
│    Developer Ownership       │        AI Assistance         │
├──────────────────────────────┼──────────────────────────────┤
│ • Product Requirements       │ • Figma to Tailwind mapping  │
│ • Architectural Decisions    │ • Boilerplate generation     │
│ • Code Review & Verification │ • Error trace diagnostics    │
│ • Database Schema Validation │ • Regex & DOM event handlers │
│ • Cloud Provisioning (Vercel)│ • Pint formatting automation │
└──────────────────────────────┴──────────────────────────────┘
```

- **Figma to Code Translation (80% AI-assisted, 20% Developer refinement):** AI parsed visual nodes into semantic HTML and Tailwind utility classes. The developer adjusted mobile responsive breakpoints and touch targets.
- **Serverless Adapter & Storage Strategy (40% AI-assisted, 60% Developer engineering):** Developer identified cloud filesystem limitations and directed AI to implement the dual-mode storage engine (Local storage disk vs. Base64 database fallback).
- **Bug Diagnosing & Fixes (50% AI-assisted, 50% Developer verification):** AI analyzed error stack traces from Vercel logs; developer verified and reviewed the solutions with automated tests.

---

### 4. Technical Understanding & Implementation Choices

#### 1. Hybrid Serverless Storage Solution
- **The Challenge:** Vercel serverless lambda functions run on read-only filesystems (except `/tmp`), meaning conventional Laravel `Storage::disk('public')->put()` crashes when attempting to create directories.
- **The Solution:** Implemented an environment-aware storage fallback in `ArticleController` and `SettingsController`. If running on Vercel (`$_ENV['VERCEL']`), images are encoded into standard Base64 Data URIs (`data:image/...;base64,...`) and stored in MySQL `LONGTEXT` columns. Model accessors (`$article->thumbnail_url` and `$user->avatar_url`) abstract this layer transparently, ensuring compatibility with both local disk storage and cloud serverless.

#### 2. TiDB Cloud MySQL over SSL
- Configured PDO MySQL connector to enforce SSL encryption with `MYSQL_ATTR_SSL_CA`, pointing to the DigiCert Global Root CA required by TiDB Cloud, preventing man-in-the-middle attacks across public serverless invocation boundaries.

#### 3. Reverse Proxy & HTTPS Enforcing
- Running behind Vercel's edge proxy causes Laravel to initially detect HTTP instead of HTTPS, triggering mixed content warnings and blocked form submissions in Chrome. Resolved cleanly via:
  - Setting `trustProxies(at: '*')` in `bootstrap/app.php`.
  - Enforcing `URL::forceScheme('https')` inside `AppServiceProvider.php` for production environments.

#### 4. Flexbox Overflow Resolution in Modal Editors
- By default, CSS flex children have `min-width: auto`, allowing inner pre-formatted content or long unbroken titles to expand beyond parent bounds. Solved by declaring `min-w-0` on flex children and organizing multi-column metadata fields into CSS Grid (`grid-cols-2 gap-4`), guaranteeing deterministic responsive boundaries.

---

## 📄 License
This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
