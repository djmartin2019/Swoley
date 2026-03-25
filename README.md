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

Swoley is a server-rendered PHP web application that helps lifters record and review their training. The goal is zero friction at the point of logging — get in, log the session, get out. Over time, the accumulated data becomes a clear picture of progress.

The app is containerized with Docker for easy local development and deployment, backed by PostgreSQL, and served via Apache with no JavaScript framework overhead.

---

## Features

- **User accounts** — Registration, login, logout, and password reset flows
- **Workout logging** — Create sessions with a title, date, and duration
- **Exercise tracking** — Add exercises to any workout with full set/rep/weight history
- **Personal dashboard** — At-a-glance stats, recent workouts, and personal records
- **Responsive UI** — Mobile-first design with a neon-orange cyberpunk theme
- **Secure auth** — Password hashing via PHP's `password_hash`, session-based authentication

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

## Project Structure

```text
swoley/
├── Dockerfile
├── docker-compose.yml
├── LICENSE
│
├── public/                     # Apache document root
│   ├── index.php               # Landing page
│   ├── about.php
│   ├── contact.php
│   ├── login.php
│   ├── register.php
│   ├── forgot-password.php
│   ├── dashboard.php
│   ├── workout.php
│   ├── styles/
│   │   └── style.css
│   ├── js/
│   │   └── navbar.js
│   └── actions/                # Form handlers (POST endpoints)
│       ├── login_handler.php
│       ├── logout.php
│       ├── register_user.php
│       ├── password_reset.php
│       └── create_workout.php
│
├── src/                        # Application core
│   ├── bootstrap.php           # Environment setup & session init
│   ├── db.php                  # PDO connection factory
│   ├── auth.php                # Auth helpers
│   └── models/
│       ├── User.php
│       ├── Workout.php
│       └── Exercise.php
│
├── views/
│   └── components/
│       ├── navbar.php
│       └── footer.php
│
└── schema/
    └── schema.sql              # Database bootstrap
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
- [x] User registration, login, logout, and password reset
- [x] Workout creation with exercises and sets
- [x] Responsive landing page, about, contact, and dashboard pages
- [x] Mobile-first navbar with hamburger menu
- [x] Personal records display on dashboard

### In Progress
- [ ] Live DB queries wired to dashboard stats and recent workouts
- [ ] Workout detail and edit views
- [ ] Full auth session guard on protected routes

### Planned
- [ ] Progress charts — volume load by week/month
- [ ] Estimated 1RM tracking over time
- [ ] Plateau detection and trend analysis
- [ ] Exercise frequency and consistency scoring
- [ ] PR history per lift with timeline view

---

## Development Notes

- Apache document root is set to `public/` via `ENV APACHE_DOCUMENT_ROOT` in the `Dockerfile`
- Code is bind-mounted into the app container (`./:/var/www/html`) so edits are reflected immediately without rebuilding
- `mod_rewrite` is enabled in Apache for future clean URL support
- PHP extensions `pdo` and `pdo_pgsql` are installed at build time

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
