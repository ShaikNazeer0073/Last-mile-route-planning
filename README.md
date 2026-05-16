# Simple Last-Mile Delivery Management

A clean Laravel project for a college presentation. It focuses on the basic workflow of a delivery company:

- Manage delivery centers
- Manage drivers
- Create customer orders
- Create delivery routes
- Assign orders to routes
- Track delivery status

## Modules

### Dashboard
Shows simple counts for centers, drivers, orders, routes, and current delivery statuses.

### Delivery Centers CRUD
Create and manage local hubs.

### Drivers CRUD
Create and manage delivery drivers and assign them to a center.

### Orders CRUD
Create customer orders and update their status:

- Pending
- Assigned
- Out for delivery
- Delivered
- Cancelled

### Routes CRUD
Create routes, assign a driver, assign orders, and update route status:

- Planned
- In progress
- Completed
- Cancelled

When a route status changes, assigned order statuses are updated automatically:

- Planned route -> Assigned orders
- In progress route -> Out for delivery orders
- Completed route -> Delivered orders
- Cancelled route -> Cancelled orders

## Removed From This Version

The advanced logistics features were intentionally removed to keep the project simple:

- AI route optimization
- Dispatch automation
- Analytics dashboards
- Traffic APIs
- Delivery time windows
- Driver shifts
- Route stop simulation
- Vehicle/fleet module
- Demo pages
- Unused API controllers

## Setup

```bash
composer install
php artisan migrate:fresh --seed
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Tech Stack

- Laravel
- Blade
- Bootstrap
- SQLite
