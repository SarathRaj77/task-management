# Task Management System API

A Laravel-based API for managing tasks, where users can create, assign, and mark tasks as completed. This project demonstrates key Laravel concepts including authentication, queues, middleware, dependency injection, and task scheduling.

## Features

- **User Authentication:**  
  - Registration and login using Laravel Sanctum.
  - Only authenticated users can create and assign tasks.

- **Task Management API:**  
  - **Create Task:** `POST /api/tasks`
  - **Assign Task:** `PUT /api/tasks/{id}/assign`
  - **Complete Task:** `PUT /api/tasks/{id}/complete`
  - **List Tasks:** `GET /api/tasks` (with optional filters for status, assigned user, etc.)

- **Queues & Jobs:**  
  - Dispatches a job to send an email notification when a task is assigned.
  - Uses Laravel's database queue driver for asynchronous processing.

- **Custom Middleware:**  
  - Logs request execution time to `storage/logs/laravel.log`.
  - Applied to all API routes.

- **Scheduler:**  
  - A custom command runs every hour to check for overdue tasks.
  - Automatically marks tasks as "expired" if their due date has passed and they are still pending.


## Requirements

- PHP 8.4+
- Laravel 12+
- MySQL
- Composer

## Setup Instructions

1. **Clone the Repository**

   ```bash
   git clone <repository-url>
   cd <repository-directory>
