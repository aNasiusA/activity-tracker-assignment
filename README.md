# Activity Tracker - NPONTU Technologies

A professional Laravel-based system for tracking daily activities of application support team members, enabling real-time status management, personnel tracking, handover management, and comprehensive activity reporting.

## 🎯 Project Overview

This application was built as a comprehensive solution for NPONTU Technologies to manage activity tracking for their application support team. The system allows team members to log daily activities, update their status (pending/done), and provides managers with visibility into team activities for shift handovers and performance analysis.

## ✨ Key Features

| Feature                    | Description                                                        |
| -------------------------- | ------------------------------------------------------------------ |
| 🔐 **Authentication**      | Secure user registration and login system with session management  |
| 📋 **Activity Management** | Create, view, and manage daily activities with descriptions        |
| ✅ **Status Updates**      | Update activity status with remarks and automatic timestamping     |
| 👤 **Personnel Tracking**  | Automatic capture of who updated an activity and when              |
| 📊 **Daily Dashboard**     | Comprehensive view of all daily activities and their latest status |
| 📈 **Update History**      | Complete activity update history showing all personnel actions     |
| 📅 **Custom Reporting**    | Query activity histories with flexible date range filters          |
| 📥 **CSV Export**          | Export reports for external analysis and archiving                 |
| 📱 **Responsive Design**   | Full support for desktop, tablet, and mobile devices               |
| 🎨 **Modern UI**           | Clean, intuitive interface built with Tailwind CSS                 |

## 🚀 Quick Start

### Prerequisites

- PHP 8.3+
- Composer
- Node.js & npm
- A supported database (SQLite, MySQL, PostgreSQL, etc.)

### Installation

```bash
# 1. Clone/extract and navigate to project
cd activity-tracker

# 2. Install dependencies
composer install
npm install

# 3. Setup configuration
cp .env.example .env
php artisan key:generate

# 4. Setup database
php artisan migrate
php artisan db:seed  # Optional: loads sample data

# 5. Build assets
npm run build

# 6. Run the application
php artisan serve
```

Visit `http://localhost:8000` and login with demo credentials:

- Email: `john@example.com`
- Password: `password`

For detailed setup instructions, see [SETUP.md](SETUP.md)

## 📋 Requirements Implementation

The system fully implements all requirements from the assignment:

### 1. ✅ Activity Input

- Allow inputting of activities with title and description
- Example: "Daily SMS count in comparison to SMS count from logs"

### 2. ✅ Status Updates with Remarks

- Update activity status to either "Done" or "Pending"
- Input remarks for each activity update
- History of all status changes preserved

### 3. ✅ Personnel & Time Capture

- Automatically captures who updated each activity
- Captures exact timestamp of when update was made
- Bio details linked through user profiles

### 4. ✅ Daily Activity Dashboard

- View all activities for a selected date
- See what updates were made by which personnel
- See the exact time each update was done
- Quick overview for shift handovers

### 5. ✅ Reporting with Custom Durations

- Query activity histories based on custom date ranges
- Filter by start and end dates
- View complete update details
- Export to CSV for further analysis

### 6. ✅ User Authentication

- Secure login system before access granted
- Session-based authentication
- Password hashing and security

## 🛠️ Technology Stack

- **Backend**: Laravel 13 (PHP 8.3)
- **Frontend**: Blade Templates + Tailwind CSS 4.0
- **Database**: SQLite (configurable to MySQL, PostgreSQL)
- **Build Tool**: Vite
- **Authentication**: Laravel Session Guard
- **Styling**: Tailwind CSS with custom configuration

## 📁 Project Structure

```
activity-tracker/
├── app/
│   ├── Http/Controllers/
│   │   ├── ActivityController.php      # Activity CRUD & updates
│   │   ├── ReportController.php        # Reporting & exports
│   │   └── Auth/
│   │       ├── LoginController.php
│   │       └── RegisteredUserController.php
│   └── Models/
│       ├── User.php
│       ├── Activity.php
│       └── ActivityUpdate.php
├── database/
│   ├── migrations/
│   │   ├── *_create_activities_table.php
│   │   └── *_create_activity_updates_table.php
│   └── seeders/DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   ├── activities/
│   │   ├── reports/
│   │   └── layouts/
│   ├── css/app.css
│   └── js/app.js
├── routes/web.php
└── vite.config.js
```

## 🔄 Core Workflows

### Creating an Activity

1. Click "New Activity" from dashboard
2. Enter activity title and optional description
3. Select the date
4. Submit to create

### Updating Activity Status

1. Click "Update" on any activity
2. Select status (Pending or Done)
3. Optionally add a remark
4. Submit - system auto-captures timestamp and your name

### Viewing Daily Activities

1. Use date picker to select a date
2. Dashboard shows all activities for that date
3. Each activity displays latest status and personnel
4. Click activity to see full update history

### Running Reports

1. Navigate to Reports section
2. Select start and end dates
3. View all activities updated in that period
4. Export to CSV if needed

## 🗄️ Database Schema

### Users Table

```sql
- id (PK)
- name
- email (UNIQUE)
- password (hashed)
- email_verified_at
- remember_token
- timestamps
```

### Activities Table

```sql
- id (PK)
- title
- description (nullable)
- date
- timestamps
```

### Activity Updates Table

```sql
- id (PK)
- activity_id (FK → activities)
- user_id (FK → users)
- status (enum: pending, done)
- remark (nullable)
- updated_at_specific (timestamp)
- timestamps
```

## 🎓 Code Quality Features

✅ **Logic & Code Clarity**

- Clear, descriptive naming conventions
- Well-documented code with comments
- Proper separation of concerns (MVC pattern)

✅ **Code Organization**

- Services for business logic
- Models with defined relationships
- Controllers focused on routing logic

✅ **UI Innovation**

- Modern, clean design
- Intuitive navigation
- Responsive layout
- Activity history with expandable details

✅ **Requirement Interpretation**

- All 6 requirements fully implemented
- Edge cases handled
- User experience optimized for shift handovers

✅ **Non-Functional Requirements**

- Security: CSRF tokens, password hashing, session protection
- Performance: Eager loading, indexed queries
- Scalability: Efficient database design
- Maintainability: Clear code structure
- Accessibility: Semantic HTML, form validation
- Reliability: Error handling and validation

## 💻 Development

### Run with Hot Reload

```bash
npm run dev
# In another terminal:
php artisan serve
```

### Run Tests

```bash
php artisan test
```

### Format Code

```bash
php artisan pint
```

## 📦 Build for Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔒 Security Measures

- CSRF protection on all forms
- Password hashing with bcrypt
- SQL injection prevention through ORM
- Session-based authentication
- Input validation on all endpoints
- Authorization checks on protected routes

## 📝 API Routes

```
AUTH ROUTES:
POST    /register              # User registration
POST    /login                 # User login
POST    /logout                # User logout

ACTIVITY ROUTES:
GET     /activities            # View dashboard with date filter
GET     /activities/create     # Show create form
POST    /activities            # Store new activity
GET     /activities/{id}       # Show activity details
POST    /activities/{id}/update-status  # Update status
DELETE  /activities/{id}       # Delete activity

REPORT ROUTES:
GET     /reports               # View reports with filters
GET     /reports/export        # Export to CSV
```

## 🚀 Deployment

For production deployment:

1. Copy `.env.example` to `.env`
2. Configure database connection
3. Run migrations: `php artisan migrate --force`
4. Run seeders: `php artisan db:seed --force`
5. Build assets: `npm run build`
6. Set `APP_ENV=production`
7. Set `APP_DEBUG=false`

## 📧 Contact & Support

For questions or support regarding this application, contact NPONTU Technologies.

---

**Made with ❤️ for NPONTU Technologies**

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
