# School Management System

A Laravel-based school management application for handling core academic operations such as students, teachers, grades, grade classes, sections, promotions, and parent/student attachment management. The project follows the standard Laravel MVC structure and adds feature-oriented controllers and Blade views for each domain.

## Project overview

This system is built with Laravel 9 and uses Blade views, Eloquent models, and Laravel routing to manage the school administration workflow. It includes authenticated access, localized routes, and a dashboard that exposes the operational modules used by the school.

## Tech stack

- PHP 7.3 / 8.1+
- Laravel 9
- Blade templates
- MySQL/PostgreSQL-compatible Laravel database layer
- Bootstrap and Laravel Mix for frontend assets
- Livewire for dynamic form handling
- Localization support via `mcamara/laravel-localization`

## Main project structure

```text
school-management-system/
├── app/                           # Core Laravel application logic
│   ├── Console/                  # Artisan commands
│   ├── Exceptions/               # Custom exception handling
│   ├── Http/                     # Request handling layer
│   │   ├── Controllers/          # Feature controllers
│   │   │   ├── Auth/             # Authentication-related controllers
│   │   │   ├── GradeClasses/    # Grade classes and sections logic
│   │   │   ├── Grades/           # Grade management logic
│   │   │   ├── Promotions/       # Student promotion workflows
│   │   │   ├── Students/         # Student management and graduation logic
│   │   │   ├── Teachers/         # Teacher management logic
│   │   │   ├── HomeController.php
│   │   │   └── Controller.php
│   │   ├── Livewire/             # Livewire components
│   │   ├── Middleware/           # Application middleware
│   │   ├── Requests/             # Form request validation classes
│   │   └── Resources/            # API resources (if used)
│   ├── Models/                   # Eloquent models for school entities
│   │   ├── Student.php
│   │   ├── Teacher.php
│   │   ├── Grade.php
│   │   ├── GradeClass.php
│   │   ├── Section.php
│   │   ├── Promotion.php
│   │   ├── MyParent.php
│   │   ├── ParentAttachment.php
│   │   ├── BloodType.php
│   │   ├── Gender.php
│   │   ├── Nationality.php
│   │   ├── Religion.php
│   │   └── Specialization.php
│   ├── Providers/                # Service providers
│   ├── Repository/               # Repository-based abstractions
│   ├── interfaces/               # Interface definitions
│   ├── User.php                  # Auth user model
│   └── ...
├── bootstrap/                    # Laravel bootstrap files
├── config/                       # Laravel configuration files
├── database/                     # Migrations, factories, and seeders
│   ├── factories/
│   ├── migrations/
│   └── seeds/
├── public/                       # Publicly served assets and entry point
├── resources/                    # Frontend assets and templates
│   ├── js/                       # JavaScript files
│   ├── lang/                     # Localization files
│   ├── sass/                     # SCSS styles
│   └── views/                    # Blade files
│       ├── auth/
│       ├── grade_classes/
│       ├── grades/
│       ├── layouts/
│       ├── livewire/
│       ├── sections/
│       ├── students/
│       ├── teachers/
│       ├── dashboard.blade.php
│       └── home.blade.php
├── routes/                       # Route definitions
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage/                      # Logs, cache, uploaded files
├── tests/                        # PHPUnit tests
├── .env.example                  # Environment configuration template
├── artisan                       # Laravel CLI entry point
├── composer.json                 # PHP dependencies and autoload config
├── package.json                  # Frontend dependencies and build scripts
├── phpunit.xml                   # PHPUnit configuration
├── server.php                    # PHP server bootstrap
├── vite.config.js                # Vite config
├── webpack.mix.js                # Laravel Mix build configuration
├── README.md                     # Project documentation
└── .gitignore                    # Git ignore rules
```

## How the application is organized

The application follows Laravel's default structure, but feature-wise it is organized around school domain modules:

- `Grades` handles grade definitions and grade-class relationships.
- `GradeClasses` manages class groups and section-based structures.
- `Students` handles student records, attachments, graduation tracking, and related uploads.
- `Teachers` manages teacher profiles and teaching assignments.
- `Promotions` manages moving students between academic levels or graduating them.
- `Models` define the data entities and Eloquent relationships used across the system.
- `resources/views` contains the UI for dashboards, lists, forms, and admin-related pages.
- `routes/web.php` groups all authenticated and localized endpoints in one central routing definition.

The project uses `Auth::routes()` and a localized route group with `LaravelLocalization`, meaning most app pages are intentionally protected and localized for the end user experience.

## Main entry points

### Web routes

The main application endpoints are defined in `routes/web.php`. The routes include:

- `/dashboard` for the main dashboard
- `/Grades`, `/GradeClasses`, `/Sections`, `/Teachers`, `/Students`, `/Promotions` as resource routes
- custom endpoints for actions such as filtering, attachments uploads, and student promotion/graduation flows

### Controllers

The business logic is kept in feature-specific controller folders under `app/Http/Controllers`.

Examples:

- `StudentController` for student management
- `TeacherController` for teacher management
- `GradeController` for academic grade operations
- `GradeClassController` and `SectionController` for class/section assignments
- `PromotionController` for promotion logic and graduation

### Models

The app uses Eloquent models to represent database entities such as:

- `Student`
- `Teacher`
- `Grade`
- `GradeClass`
- `Section`
- `Promotion`
- `MyParent`
- `ParentAttachment`
- `Gender`, `Nationality`, `Religion`, `BloodType`, `Specialization`

These models form the core of the school administration data model.

## Frontend and UI

The frontend is implemented using:

- Blade templates under `resources/views`
- Bootstrap styling through the Laravel Mix pipeline
- Livewire components for interactive form behavior

The main dashboard page is the core UI entry point, and the project keeps feature views grouped in folders such as:

- `resources/views/students`
- `resources/views/teachers`
- `resources/views/grades`
- `resources/views/grade_classes`
- `resources/views/sections`
- `resources/views/livewire`

## Database and persistence

The database layer is stored under `database/` and includes:

- `migrations/` - schema definitions for school data
- `factories/` - model factories for testing and seed generation
- `seeds/` - database seeding support

This project uses Laravel Eloquent ORM to connect these classes to the database and manage records for school operations.

## Local setup

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Copy the example environment file and configure your local database settings:

```bash
cp .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Run migrations and seed the database if needed:

```bash
php artisan migrate
```

7. Compile frontend assets:

```bash
npm run dev
```

8. Start the local server:

```bash
php artisan serve
```

Then open the application in your browser.

## Notes

- This project includes authentication via Laravel default auth scaffolding.
- It also supports multilingual routing using `LaravelLocalization`.
- The dashboard and most routines are protected by the `auth` middleware.
- Some functionality includes file uploads and attachments for students and parents.

## Summary

This repository is a full Laravel school management system focused on administrative operations for schools: student management, teacher management, academic structure, class management, and promotion workflows. The structure is organized around Laravel conventions, with feature modules kept separate under `app/Http/Controllers` and `resources/views` to make the system easier to extend.
