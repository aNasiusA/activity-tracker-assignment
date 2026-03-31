# Activity Tracker - NPONTU Technologies

A Laravel-based application for tracking daily activities of application support team members with real-time status updates, personnel tracking, and comprehensive reporting capabilities.

## Features

✅ **User Authentication** - Secure login and registration system  
✅ **Activity Management** - Create and manage daily activities  
✅ **Status Tracking** - Update activity status (Pending/Done) with remarks  
✅ **Personnel Tracking** - Automatically captures who updated an activity and when  
✅ **Daily Dashboard** - View all activities and updates for each day at a glance  
✅ **Activity History** - View complete update history for each activity  
✅ **Reporting** - Query activity histories based on custom date ranges  
✅ **CSV Export** - Export reports to CSV for further analysis  
✅ **Responsive UI** - Modern, clean interface built with Tailwind CSS

## System Requirements

- PHP 8.3 or higher
- Composer
- Node.js & npm
- SQLite 3 (or another supported database)
- Laravel 13.0+

## Installation

### 1. Clone or Extract the Repository

```bash
cd activity-tracker
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Setup Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Seed Sample Data (Optional)

```bash
php artisan db:seed
```

### 8. Build Frontend Assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

## Running the Application

### Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### Or Use the Concurrent Dev Script

```bash
composer run dev
```

This will start:

- Laravel development server
- Vite dev server (for hot module replacement)
- Laravel queue listener
- Laravel Pail (log viewer)

## Default Credentials

After seeding, you can login with:

**User 1:**

- Email: john@example.com
- Password: password (set during factory creation)

**User 2:**

- Email: jane@example.com
- Password: password

Or create your own account via the registration page.

## Project Structure

```
activity-tracker/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Auth/
│   │       │   ├── LoginController.php
│   │       │   └── RegisteredUserController.php
│   │       ├── ActivityController.php
│   │       └── ReportController.php
│   └── Models/
│       ├── User.php
│       ├── Activity.php
│       └── ActivityUpdate.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── activities/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── show.blade.php
│   │   └── reports/
│   │       └── index.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   └── web.php
├── vite.config.js
└── composer.json
```

## Key Functionality

### 1. User Authentication

- Register new support team members
- Secure login with password hashing
- Session-based authentication
- Logout functionality

### 2. Activity Input & Management

- Create activities with title and description
- Assign activities to specific dates
- Delete activities when needed
- View activity details

### 3. Status Updates

- Update activity status to either "Pending" or "Done"
- Add remarks for each status update
- System automatically captures:
    - Personnel name (who made the update)
    - Exact timestamp of the update

### 4. Daily Dashboard

- View all activities for a selected date
- See the latest status for each activity
- Quick access to update status
- View complete update history for each activity
- Date picker to switch between days

### 5. Reporting & Analytics

- Filter activity updates by custom date ranges
- View all updates in a sortable, paginated table
- See who made each update and when
- Export reports to CSV format
- Track activity progress over time

## API Endpoints

### Authentication

- `POST /register` - Register new user
- `POST /login` - Login user
- `POST /logout` - Logout user

### Activities

- `GET /activities` - View activities dashboard (with optional date filter)
- `GET /activities/create` - Show create activity form
- `POST /activities` - Store new activity
- `GET /activities/{activity}` - Show activity details and update form
- `POST /activities/{activity}/update-status` - Update activity status
- `DELETE /activities/{activity}` - Delete activity

### Reports

- `GET /reports` - View activity reports with date filtering
- `GET /reports/export` - Export reports to CSV

## Database Schema

### users Table

- id (Primary Key)
- name
- email (Unique)
- password (hashed)
- email_verified_at
- remember_token
- timestamps

### activities Table

- id (Primary Key)
- title
- description (nullable)
- date
- timestamps

### activity_updates Table

- id (Primary Key)
- activity_id (Foreign Key → activities)
- user_id (Foreign Key → users)
- status (enum: pending, done)
- remark (nullable)
- updated_at_specific (timestamp)
- timestamps

## Non-Functional Requirements Met

✅ **Code Clarity** - Well-structured code with clear naming conventions  
✅ **Code Organization** - Proper separation of concerns (MVC pattern)  
✅ **Security** - CSRF protection, password hashing, session-based authentication  
✅ **Performance** - Efficient database queries with eager loading  
✅ **UI Innovation** - Clean, modern interface with Tailwind CSS  
✅ **Responsiveness** - Works on desktop, tablet, and mobile devices  
✅ **Data Integrity** - Foreign key constraints, cascade deletes  
✅ **Error Handling** - Validation with user-friendly error messages

## Testing

Run the test suite:

```bash
php artisan test
```

## Contribution Guidelines

1. Create a feature branch (`git checkout -b feature/amazing-feature`)
2. Commit changes (`git commit -m 'Add amazing feature'`)
3. Push to branch (`git push origin feature/amazing-feature`)
4. Open a Pull Request

## License

This project is licensed under the MIT License.

## Support

For issues, questions, or suggestions, please contact NPONTU Technologies support team.

## Version History

**v1.0.0** - Initial Release

- Complete activity tracking system
- Daily dashboard
- Comprehensive reporting
- User authentication
- CSV export functionality
