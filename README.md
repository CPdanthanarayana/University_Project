# University Project - Application Management System

## Overview

This is a university project built using the Laravel framework, designed as a web-based application management system. The system allows users to submit applications (e.g., for travel permits or vehicle usage) and provides administrators with tools to manage users, applications, vehicles, and application statuses. It features role-based access control, form submissions, status tracking, and integration with a database for storing application data.

The application is built with Laravel 8, uses Tailwind CSS for styling, and includes features like authentication via Laravel Jetstream, Livewire for dynamic components, and a MySQL database.

## Features

- **User Authentication**: Login and registration using Laravel Jetstream with two-factor authentication.
- **Role-Based Access**: Supports different user types (e.g., admin, regular user) with middleware for access control.
- **Application Submission**: Users can submit detailed applications including personal information, travel details, and vehicle requests.
- **Admin Dashboard**: Administrators can manage users, view and update application statuses, handle vehicles, and oversee application visits.
- **Vehicle Management**: CRUD operations for vehicles used in applications.
- **Application Tracking**: Track application status, members, visits, and final decisions.
- **Database Migrations**: Comprehensive database schema for users, applicants, applications, members, visits, and vehicles.
- **Frontend**: Built with Tailwind CSS, Alpine.js for interactivity, and Laravel Mix for asset compilation.
- **Testing**: Includes PHPUnit tests and various debug/test scripts.

## Technologies Used

- **Backend**: Laravel 8 Framework (PHP)
- **Database**: MySQL (configured via environment variables)
- **Frontend**: Tailwind CSS, Alpine.js
- **Authentication**: Laravel Sanctum, Jetstream
- **Asset Management**: Laravel Mix, Vite
- **Other Libraries**: Livewire, Guzzle, CORS handling

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/CPdanthanarayana/University_Project.git
   cd University_Project
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js Dependencies**:
   ```bash
   npm install
   ```

4. **Environment Setup**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other settings (e.g., DB_CONNECTION, DB_HOST, etc.).

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

7. **Build Assets**:
   ```bash
   npm run dev
   ```

8. **Serve the Application**:
   ```bash
   php artisan serve
   ```

The application will be available at `http://localhost:8000`.

## Usage

- **Landing Page**: Visit the root URL to see the landing page.
- **Submit Application**: Users can submit applications via the form.
- **Admin Panel**: Admins can log in and access the dashboard to manage resources.
- **API Endpoints**: Includes routes for form submission, status checking, and CRUD operations for vehicles and users.

## Database Schema

The application uses the following main tables:
- `users`: User accounts with roles (e.g., admin, user).
- `applicants`: Applicant details.
- `applications`: Main application records with status, dates, and details.
- `application_members`: Members associated with applications.
- `application_visits`: Visit records for applications.
- `vehicles`: Vehicle information for assignments.

Run migrations to set up the schema.

## Testing

- Run PHPUnit tests:
  ```bash
  php artisan test
  ```
- Various test and debug scripts are included in the root directory for integration and production readiness.

## Contributing

1. Fork the repository.
2. Create a feature branch.
3. Make your changes and commit.
4. Push to your branch and create a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Built as part of a university project.
- Uses the Laravel framework and its ecosystem.
- Special thanks to the Laravel community for documentation and support.
