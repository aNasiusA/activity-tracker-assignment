#!/usr/bin/env bash

# Activity Tracker - Quick Setup Script
# Run this script to quickly set up the application

set -e

echo "================================"
echo "Activity Tracker Setup Script"
echo "================================"
echo ""

# Check if .env exists
if [ ! -f ".env" ]; then
    echo "📋 Creating .env file..."
    cp .env.example .env
    echo "✓ .env created"
fi

# Check if database file exists
if [ ! -f "database/database.sqlite" ]; then
    echo "📦 Creating SQLite database..."
    touch database/database.sqlite
    echo "✓ Database file created"
fi

echo "🔧 Installing PHP dependencies..."
composer install

echo "🔑 Generating application key..."
php artisan key:generate

echo "📦 Installing Node dependencies..."
npm install

echo "🗄️ Running database migrations..."
php artisan migrate --force

echo "🌱 Seeding sample data..."
php artisan db:seed --force

echo "🏗️ Building frontend assets..."
npm run build

echo ""
echo "================================"
echo "✅ Setup Complete!"
echo "================================"
echo ""
echo "To start the development server, run:"
echo "  php artisan serve"
echo ""
echo "In another terminal, run:"
echo "  npm run dev"
echo ""
echo "Then visit: http://localhost:8000"
echo ""
echo "Demo Credentials:"
echo "  Email: john@example.com"
echo "  Password: password"
echo ""
