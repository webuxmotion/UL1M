# Installation Instructions

## ✅ Installation Complete!

Your Robotics Parts Catalog application is now fully installed and running!

**Application URL:** http://127.0.0.1:8000

## What Was Installed

✅ PHP 8.2+ and Composer
✅ MySQL database (`robotics_catalog`)
✅ Laravel 11 framework with all dependencies
✅ Database tables (users, workshops, parts, sessions, cache, jobs)
✅ Sample data (3 workshops, 12 electronic parts)
✅ Authentication system (Laravel Breeze)
✅ Admin panel with role-based access
✅ Public search interface

## Quick Start

### Start the Application
```bash
php artisan serve
```

Then visit: **http://127.0.0.1:8000**

### Stop the Application
Press `Ctrl+C` in the terminal running the server

---

## Installation Steps (Already Completed)

The following steps have already been completed for you:

### 1. ✅ Prerequisites Installed
- Homebrew
- PHP 8.2+
- Composer
- MySQL

### 2. ✅ Database Created
```bash
mysql -u root -e "CREATE DATABASE robotics_catalog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 3. ✅ Application Key Generated
```bash
php artisan key:generate
```

### 4. ✅ Migrations Run
```bash
php artisan migrate
```

### 5. ✅ Database Seeded
```bash
php artisan db:seed
```

### 6. ✅ Server Started
```bash
php artisan serve
```

## Default Credentials

**Super Admin:**
- Email: admin@robotics.com
- Password: password
- Access: Can manage all workshops and parts

**Workshop Admins:**
- KYIV-1: kyiv1@robotics.com / password
- KYIV-2: kyiv2@robotics.com / password
- LVIV-1: lviv1@robotics.com / password
- Access: Can manage parts for their assigned workshop only

---

## Application Features

### Public Features (No Login Required)
- **Search Parts**: Search by name, category, manufacturer, or part number
- **View Details**: See part specifications, quantity, price, and workshop location
- **Workshop Info**: Contact information for each workshop

### Workshop Admin Features
- **Manage Parts**: Add, edit, delete parts for assigned workshop
- **Track Inventory**: Update quantities and prices
- **Categorize**: Organize parts by category (Microcontroller, Sensor, Motor, Display, Tool, Cable/Connector, Other)

### Super Admin Features
- **Manage Workshops**: Create, edit, delete workshops across all cities
- **Assign Admins**: Assign workshop administrators
- **Global Access**: Manage all parts across all workshops

---

## Sample Data Included

### Workshops
- **KYIV-1** - Khreshchatyk Street, Kyiv
- **KYIV-2** - Peremohy Avenue, Kyiv
- **LVIV-1** - Svobody Avenue, Lviv

### Sample Parts (12 items)
- Microcontrollers: Arduino Uno R3, Raspberry Pi 4, ESP32
- Sensors: HC-SR04 Ultrasonic, DHT22 Temperature/Humidity
- Motors: SG90 Servo, L298N Motor Driver, Nema 17 Stepper
- Displays: OLED 0.96"
- Tools: Soldering Station, Breadboard, Jumper Wires

---

## Troubleshooting

### Database Connection Issues
If you get database connection errors:
```bash
# Check MySQL is running
brew services list

# Restart MySQL if needed
brew services restart mysql

# Verify database exists
mysql -u root -e "SHOW DATABASES LIKE 'robotics_catalog';"
```

### Application Key Missing
If you see "No application encryption key has been specified":
```bash
php artisan key:generate
```

### Permission Issues
If you get permission errors:
```bash
# Fix storage and cache permissions
chmod -R 775 storage bootstrap/cache
```

### Clear Cache
If changes aren't appearing:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Optional: Frontend Assets (Not Required)

The application uses Tailwind CSS via CDN and is fully functional without building assets.

If you want to use Vite for asset compilation (optional):
```bash
# Fix npm permissions (if needed)
sudo chown -R $(whoami) ~/.npm

# Install dependencies
npm install

# Run dev server (optional)
npm run dev

# Or build for production
npm run build
```

**Note:** The application works perfectly without npm/Vite as views use Tailwind CSS CDN.

---

## Next Steps

1. **Visit the Application**: http://127.0.0.1:8000
2. **Try Public Search**: Search for "Arduino" or "Sensor"
3. **Login as Admin**: Use admin@robotics.com / password
4. **Explore Admin Panel**: http://127.0.0.1:8000/admin
5. **Add Your Own Parts**: Create new workshops and parts

Enjoy your Robotics Parts Catalog! 🤖
