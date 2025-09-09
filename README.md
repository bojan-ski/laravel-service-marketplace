# 🛠️ Service Marketplace

The **Service Marketplace** is a Laravel-based web application that connects **Clients** and **Freelancers**.  
It provides an interactive platform for posting projects, bidding, real-time messaging, and project management — with a full admin panel for oversight.  

This application is built using the **[imacrayon/blade-starter-kit](https://github.com/imacrayon/blade-starter-kit)**, an unofficial Laravel starter kit for Blade that offers authentication, scaffolding, and a clean project structure.

---

## ✨ Features

### 👨‍💻 Client User
- 🔐 Authentication: Sign up, Sign in, Forgot/Reset password  
- ➕ Create new projects  
- ✏️ Edit or delete own projects  
- ✅ Accept bids from freelancers on own projects  
- 🔄 Change project status  
- 📜 Scroll and search open projects  
- 💬 Private conversations with freelancers (1-on-1)  
- ⭐ Rate freelancers  
- 👤 Profile update with option to delete own account   

### 🧑‍💼 Freelancer User
- 🔐 Authentication: Sign up, Sign in, Forgot/Reset password  
- 📜 Scroll and search open projects  
- 💰 Place bids on open projects  
- 💬 Private conversations with clients (1-on-1)  
- ⭐ Rate clients  
- 👤 Profile update with option to delete own account  

### 🛡️ Admin User
- 👥 Manage all client users (delete accounts)  
- 👨‍💻 Manage all freelancer users (delete accounts)  
- 📂 Manage all projects (edit or delete)  
- 📋 View list of all bids with filtering options  
- 💬 Monitor all conversations with ability to delete messages  

---

## 🛠️ Tech Stack
- **Framework**: [Laravel 12](https://laravel.com/)  
- **Starter Kit**: [imacrayon/blade-starter-kit](https://github.com/imacrayon/blade-starter-kit)  
- **Database**: [MySQL](https://www.mysql.com/)  
- **Templating**: [Blade Templates](https://laravel.com/docs/blade)  
- **Realtime Communication**: [Pusher API](https://pusher.com/) 
- **Styling**: [Tailwind CSS](https://tailwindcss.com/) 

---

## 🚀 Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/bojan-ski/laravel-service-marketplace.git
cd laravel-service-marketplace
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Pusher API
[Pusher API](https://pusher.com/)

### 4. Environment Setup - .env
```env
# Database
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# Pusher
BROADCAST_CONNECTION=pusher

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=
PUSHER_SCHEME=
PUSHER_APP_CLUSTER=

VITE_APP_NAME=
VITE_PUSHER_APP_KEY=
VITE_PUSHER_HOST=
VITE_PUSHER_PORT=
VITE_PUSHER_SCHEME=
VITE_PUSHER_APP_CLUSTER=
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Start Servers
```bash
php artisan serve
npm run dev
```

---

👨‍💻 Author

Developed with ❤️ by BPdevelopment (bojan-ski)