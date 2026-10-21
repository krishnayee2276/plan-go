# Plan & Go - Fullstack Travel Website

A complete fullstack travel booking website with admin dashboard, user authentication, and package management.

## Features

### Frontend
- Responsive HTML/CSS/JS website
- User registration and login
- Magic link authentication
- Travel package browsing
- Contact forms

### Backend
- PHP API endpoints
- MySQL database
- Admin dashboard for managing packages, bookings, users
- Secure authentication

## Setup Instructions

### Prerequisites
- XAMPP (Apache, MySQL, PHP)
- Web browser

### Installation

1. **Start XAMPP**
   - Open XAMPP Control Panel
   - Start Apache and MySQL modules

2. **Database Setup**
   - Open browser and go to: `http://localhost/plan-go/setup_database.php`
   - This will create the database and insert sample data

3. **Access the Website**
   - Frontend: `http://localhost/plan-go/`
   - Admin Dashboard: `http://localhost/plan-go/admin/dashboard.php`
     - Username: admin
     - Password: admin123

### Sample User Accounts
- Email: alice@example.com, Password: password123
- Email: bob@example.com, Password: password123

### API Endpoints
- POST `/api/login.php` - User login
- POST `/api/register.php` - User registration
- POST `/api/admin_login.php` - Admin login
- POST `/api/send_magic_link.php` - Magic link authentication

### Database Tables
- packages - Travel packages
- bookings - Customer bookings
- users - Registered users
- enquiries - Contact form submissions
- admin_users - Admin accounts
- settings - Site settings

## File Structure
```
plan-go/
├── index.html              # Main website entry
├── login.html              # User login page
├── register.html           # User registration
├── admin/                  # Admin dashboard
│   ├── dashboard.php
│   ├── packages.php
│   └── ...
├── api/                    # API endpoints
│   ├── login.php
│   ├── register.php
│   └── ...
├── includes/               # PHP includes
├── css/                    # Stylesheets
├── js/                     # JavaScript files
├── planngo/                # Frontend pages
└── setup_database.php      # Database setup
```

## Technologies Used
- Frontend: HTML, CSS, JavaScript, Bootstrap
- Backend: PHP, MySQL
- Authentication: Password hashing, sessions
- UI: SweetAlert2 for notifications
