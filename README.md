# Task Management API

A RESTful Task Management System built with Laravel 12 following clean architecture principles using Service Layer and Repository Pattern.

---

## Features

- Authentication using Laravel Sanctum
- Projects CRUD
- Tasks CRUD
- Dashboard Statistics
- Search Tasks
- Filter Tasks
- Pagination
- Form Request Validation
- API Resources
- Error Handling
- Proper HTTP Status Codes
- Soft Deletes
- Database Seeders & Factories
- RESTful API

---

# Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Laravel Sanctum

---

# Project Structure

```
app
├── Http
│   ├── Controllers
│   ├── Requests
│   └── Resources
│
├── Repositories
│
├── Services
│
├── Traits
│
├── Filters
│
└── Models
```

---

# Installation

Clone repository

```bash
git clone https://github.com/USERNAME/task-management-api.git
```

Install packages

```bash
composer install
```

Copy environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure your database inside `.env`

Run migrations

```bash
php artisan migrate --seed
```

Run server

```bash
php artisan serve
```

---

# Authentication

## Register

POST

```
/api/v1/register
```

---

## Login

POST

```
/api/v1/login
```

---

## Logout

POST

```
/api/v1/logout
```

Requires Bearer Token.

---

# Projects

| Method | Endpoint |
|----------|----------------|
| GET | /projects |
| POST | /projects |
| GET | /projects/{id} |
| PUT | /projects/{id} |
| DELETE | /projects/{id} |

---

# Tasks

| Method | Endpoint |
|----------|----------------|
| GET | /tasks |
| POST | /tasks |
| GET | /tasks/{id} |
| PUT | /tasks/{id} |
| DELETE | /tasks/{id} |

Supports

- Search
- Filter by Status
- Filter by Priority

Example

```
GET /api/v1/tasks?status=todo

GET /api/v1/tasks?priority=high

GET /api/v1/tasks?search=meeting
```

---

# Dashboard

GET

```
/api/v1/dashboard
```

Returns

- Total Projects
- Active Projects
- Total Tasks
- Completed Tasks
- Pending Tasks
- Overdue Tasks

---

# Seeder

Generate fake data

```bash
php artisan migrate:fresh --seed
```

Creates

- Users
- Projects
- Tasks

---

# API Response

Success

```json
{
    "success": true,
    "message": "Success",
    "data": {}
}
```

Validation Error

```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {}
}
```

---

# Architecture

The project follows a layered architecture:

```
Controller
      ↓
Service
      ↓
Repository
      ↓
Model
```

---

# Design Patterns

- Repository Pattern
- Service Layer
- Resource Classes
- Form Request Validation

---

# Author

Ahmed Yousry