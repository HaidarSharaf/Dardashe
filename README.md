# ⚡ Livewire Auth Starter Kit

A simple Laravel auth starter kit with **Livewire**, **Tailwind CSS**, and **Alpine.js** pre-configured for rapid development.

---

## ✨ Features

### 🔐 Complete Authentication System
- Login / Register
- Email verification using OTP
- Password reset
- Remember me functionality
- Update password after login

### ⚡ Livewire Components
- Loading states
- Flash session notifications

### 🎨 Modern UI
- Tailwind CSS
- Alpine.js
- Responsive design

---

## 🚀 Quick Start

### Option 1: Use This Template (Recommended)

1. Click the **“Use this template”** button on GitHub
2. Create your new repository
3. Clone and set up your project:

#### Windows (Command Prompt)
```cmd
git clone https://github.com/HaidarSharaf/livewire-auth-starter-kit.git my-project
cd my-project
setup.bat
```


#### Windows (PowerShell):
```powershell

git clone https://github.com/HaidarSharaf/livewire-auth-starter-kit.git
cd your-new-project
.\setup.ps1
````

#### Linux/Mac:
```bash

git clone https://github.com/HaidarSharaf/livewire-auth-starter-kit.git
cd your-new-project
chmod +x setup.sh
./setup.sh
```

### Option 2: Manual Installation

#### Windows:
```cmd

# Clone the repository
git clone https://github.com/HaidarSharaf/livewire-auth-starter-kit.git my-project
cd my-project

# Run setup (choose one)
setup.bat
# OR
.\setup.ps1

# Configure environment
notepad .env  # Edit database and other settings

# Run migrations
php artisan migrate

# Start development server
php artisan serve
```

##### Linux/Mac:
``` bash

# Clone the repository
git clone https://github.com/HaidarSharaf/livewire-auth-starter-kit.git my-project
cd my-project

# Run setup
chmod +x setup.sh
./setup.sh

# Configure environment
nano .env  # Edit database and other settings

# Run migrations
php artisan migrate

# Start development server
php artisan serve
```

📋 Requirements

    PHP 8.1+
    Composer
    Node.js 18+
    MySQL/PostgreSQL/SQLite
    Git

Asset Building
```bash

# Development
npm run dev

# Watch for changes
npm run dev -- --watch

# Production build
npm run build
```

## 📁 Project Structure

```text
├── app/
│   ├── Livewire/           # Your Livewire components
│   ├── Models/             # Eloquent models
│   └── Providers/          # Service providers
├── resources/
│   ├── views/
│   │   ├── livewire/       # Livewire component views
│   │   ├── layouts/        # App layouts
│   │   ├── auth/           # Authentication pages
│   │   └── components/     # Blade components
│   ├── css/                # Tailwind CSS
│   └── js/                 # Alpine.js
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
└── public/                 # Public assets

```

🎯 What's Included

Authentication Pages

    Login
    Register
    Forgot Password
    Reset Password
    Email Verification
    Update Password


🙏 Acknowledgments

    Laravel - The PHP Framework
    Livewire - Full-stack framework for Laravel
    Tailwind CSS - Utility-first CSS framework
    Alpine.js - Minimal JavaScript framework

