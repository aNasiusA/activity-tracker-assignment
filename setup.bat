@echo off
REM Activity Tracker - Quick Setup Script for Windows
REM Run this script to quickly set up the application

echo.
echo ================================
echo Activity Tracker Setup Script
echo ================================
echo.

REM Check if .env exists
if not exist ".env" (
    echo 📋 Creating .env file...
    copy .env.example .env
    echo ✓ .env created
) else (
    echo ℹ️  .env already exists
)

REM Check if database file exists
if not exist "database\database.sqlite" (
    echo 📦 Creating SQLite database...
    type nul > database\database.sqlite
    echo ✓ Database file created
)

echo.
echo 🔧 Installing PHP dependencies...
call composer install

echo.
echo 🔑 Generating application key...
call php artisan key:generate

echo.
echo 📦 Installing Node dependencies...
call npm install

echo.
echo 🗄️ Running database migrations...
call php artisan migrate --force

echo.
echo 🌱 Seeding sample data...
call php artisan db:seed --force

echo.
echo 🏗️ Building frontend assets...
call npm run build

echo.
echo ================================
echo ✅ Setup Complete!
echo ================================
echo.
echo To start the development server, run:
echo   php artisan serve
echo.
echo In another terminal, run:
echo   npm run dev
echo.
echo Then visit: http://localhost:8000
echo.
echo Demo Credentials:
echo   Email: john@example.com
echo   Password: password
echo.
pause
