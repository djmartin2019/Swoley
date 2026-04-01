# Swoley

![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-16-4169E1?style=flat-square&logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-2.4-D22128?style=flat-square&logo=apache&logoColor=white)
![License](https://img.shields.io/badge/License-Apache%202.0-FF6A00?style=flat-square)
![Status](https://img.shields.io/badge/Status-Active%20Development-orange?style=flat-square)

> A fast, focused weightlifting tracker. Log workouts, track sets, and watch your strength grow session by session.

---

## Overview

Swoley is a server-rendered PHP web application built on a hand-rolled MVC architecture — no frameworks, no magic. Lifters can log training sessions, track exercises and sets, and review their history through a personal dashboard.

The codebase is intentionally lean: PHP 8.3 backend, PostgreSQL database, Apache server, vanilla HTML/CSS, all containerized with Docker. The goal is zero friction at the point of logging — get in, record the session, get out.

---

## Features

- **User accounts** — Registration, login, logout, and password reset flows
- **Workout logging** — Create sessions with a title, date, and duration
- **Exercise tracking** — Add exercises to any workout with full set/rep/weight history
- **Personal dashboard** — At-a-glance stats, recent workouts, and personal records
- **Responsive UI** — Mobile-first design with a neon-orange cyberpunk theme
- **Secure auth** — `password_hash` / `password_verify`, session-based authentication, ownership-checked DB queries

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.3 |
| Database | PostgreSQL 16 |
| Web Server | Apache 2.4 |
| Infrastructure | Docker + Docker Compose |
| Frontend | HTML5, CSS3 (vanilla) |
| PHP Extensions | `pdo`, `pdo_pgsql` |

---

## Architecture

Swoley uses a hand-built MVC pattern with a single front controller (`public/index.php`) that routes all requests to the appropriate controller.

```
Request
   │
   ▼
public/index.php          ← front controller: parses URI, dispatches to controller
   │
   ▼
src/Controllers/          ← controllers: handle request, prepare data, call render()
   │           │
   │           ▼
   │        src/Models/   ← models: all SQL lives here, one class per table
   │
   ▼
src/Core/BaseController   ← render(): merges shared data, buffers view, loads layout
   │
   ▼
src/Views/                ← views: HTML templates, no logic, no DB access
```

### Core Layer (`src/Core/`)

| File | Responsibility |
|---|---|
| `Database.php` | PDO singleton — one connection per request |
| `Model.php` | Abstract base class — provides `db()` to all models |
| `BaseController.php` | `render($view, $data)` — output buffering, shared auth injection, layout loading |

### Controllers (`src/Controllers/`)

| Controller | Routes |
|---|---|
| `HomeController` | `GET /`, `GET /about`, `GET /contact` |
| `AuthController` | `GET/POST /login`, `GET/POST /register`, `POST /logout`, `GET/POST /forgot-password` |
| `DashboardController` | `GET /dashboard` |
| `WorkoutController` | `GET /workout/{id}`, `POST /workout`, `POST /workout/{id}/exercise`, `POST /workout/{id}/set` *(in progress)* |

### Models (`src/Models/`)

Each model owns all SQL for its table. Controllers call model methods — no raw queries outside of models.

| Model | Table | Key Methods |
|---|---|---|
| `User` | `users` | `findByUsername`, `findById`, `create` |
| `Workout` | `workouts` | `findForUser`, `allForUser`, `create` |
| `Exercise` | `exercises` | `findByWorkout`, `findForUser`, `create` |
| `Set` | `sets` | `findByExercises`, `create` |

---

## Project Structure

```text
swoley/
├── Dockerfile
├── docker-compose.yml
├── schema/
│   └── schema.sql              # Database schema (auto-applied on first run)
│
├── public/                     # Apache document root
│   ├── index.php               # Front controller — all requests route through here
│   ├── workout.php             # Workout page (pending MVC migration)
│   ├── styles/
│   │   └── style.css
│   ├── js/
│   │   └── navbar.js
│   └── actions/                # Legacy POST handlers (pending migration)
│       ├── add_workout.php
│       ├── add_exercise.php
│       └── add_set.php
│
└── src/                        # Application source
    ├── bootstrap.php           # Requires auth + db helpers
    ├── auth.php                # Session helpers (login, logout, require_login, etc.)
    ├── db.php                  # Legacy PDO factory (get_db)
    │
    ├── Core/
    │   ├── Database.php        # OOP PDO singleton
    │   ├── Model.php           # Abstract base model
    │   └── BaseController.php  # Base controller with render()
    │
    ├── Controllers/
    │   ├── HomeController.php
    │   ├── AuthController.php
    │   ├── DashboardController.php
    │   └── WorkoutController.php
    │
    ├── Models/
    │   ├── User.php
    │   ├── Workout.php
    │   ├── Exercise.php
    │   └── Set.php
    │
    └── Views/
        ├── layout.php          # HTML shell (head, navbar, footer)
        ├── home.php
        ├── about.php
        ├── contact.php
        ├── login.php
        ├── register.php
        ├── forgot-password.php
        ├── dashboard.php
        ├── workouts/
        │   └── show.php
        └── components/
            ├── navbar.php
            └── footer.php
```

---

## Data Model

```
users
 └── workouts          (user_id → users.id)
      └── exercises     (workout_id → workouts.id)
           └── sets      (exercise_id → exercises.id)
```

| Table | Key Columns |
|---|---|
| `users` | `id`, `username`, `email`, `first_name`, `last_name`, `password_hash`, `created_at` |
| `workouts` | `id`, `user_id`, `title`, `workout_date`, `duration_minutes`, `created_at` |
| `exercises` | `id`, `workout_id`, `name` |
| `sets` | `id`, `exercise_id`, `reps`, `weight` |

---

## Getting Started

### Prerequisites

- [Docker](https://www.docker.com/get-started) (includes Docker Compose)

### Run Locally

```bash
# 1. Clone the repo
git clone <your-repo-url>
cd swoley

# 2. Build and start all services
docker compose up --build

# 3. Open in your browser
open http://localhost:8080
```

The database schema is applied automatically on first run from `schema/schema.sql`.

### Stop the App

```bash
# Stop containers
docker compose down

# Stop and remove the database volume (wipes all data)
docker compose down -v
```

### Default Local DB Credentials

| Setting | Value |
|---|---|
| Host | `db` (internal Docker network) |
| Database | `swoley_db` |
| User | `postgres` |
| Password | `password` |

> **Note:** Change these credentials before any non-local deployment.

---

## Roadmap

### Shipped
- [x] Custom MVC architecture — front controller, base controller, model layer
- [x] User registration, login, logout, and password reset flows
- [x] Workout creation with exercises and sets
- [x] Responsive landing page, about, contact, and dashboard
- [x] Mobile-first navbar with hamburger menu
- [x] `Database` / `Model` / `BaseController` core classes
- [x] `User`, `Workout`, `Exercise`, `Set` models with typed static methods

### In Progress
- [ ] `WorkoutController` — migrate `workout.php` and action handlers to MVC
- [ ] Live DB queries wired to dashboard stats and recent workouts
- [ ] Auth session guard on all protected routes via `require_login()`

### Planned
- [ ] Services layer for complex operations (PR calculation, workout templates)
- [ ] Progress charts — volume load by week/month
- [ ] Estimated 1RM tracking over time
- [ ] Plateau detection and trend analysis
- [ ] Exercise frequency and consistency scoring
- [ ] PR history per lift with timeline view

---

## Development Notes

- Apache document root is `public/` — set via `ENV APACHE_DOCUMENT_ROOT` in the `Dockerfile`
- `mod_rewrite` is enabled and `AllowOverride All` is set so `.htaccess` rewrites all requests through `public/index.php`
- Code is bind-mounted into the container (`./:/var/www/html`) so edits are reflected immediately without rebuilding
- PHP extensions `pdo` and `pdo_pgsql` are installed at image build time
- `src/db.php` and `src/auth.php` are functional helpers kept alongside the OOP layer during the MVC migration; `Database.php` is the long-term home for the PDO connection

---

## Contributing

Contributions, bug reports, and feature ideas are welcome.

When opening a pull request:

1. Fork the repo and create a feature branch
2. Include a clear description of the change and the problem it solves
3. If the schema changes, include a migration or note what needs to be re-initialized
4. Test locally with `docker compose up --build` before submitting

---

## License

This project is licensed under the **Apache License, Version 2.0**.

See the [LICENSE](LICENSE) file for the full text, or visit [apache.org/licenses](https://www.apache.org/licenses/LICENSE-2.0).
