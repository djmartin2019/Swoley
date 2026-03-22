# Swoley

A lightweight weightlifting tracker built with PHP, designed to help lifters log workouts and monitor progress over time.

## Vision

Swoley is focused on one core outcome: make it easy to track lifting performance session by session, then use that data to show progress trends over weeks and months.

Analytics are intentionally still in discovery, so the app is being built with a clean foundation first (workouts, exercises, sets, and users), then expanded with insights.

## Current Status

This project is currently in active development and includes:

- Core PHP pages for navigation and account/workout flow
- Responsive, cyberpunk-styled frontend
- PostgreSQL schema for users, workouts, exercises, and sets
- Dockerized local development with PHP (Apache) + Postgres

## Tech Stack

- **Backend:** PHP 8.3 (Apache)
- **Database:** PostgreSQL 16
- **Frontend:** HTML/CSS (custom styling)
- **Containerization:** Docker + Docker Compose

## Project Structure

```text
swoley/
├── Dockerfile
├── docker-compose.yml
├── public/            # Web root (Apache document root)
│   ├── index.php
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   ├── workout.php
│   └── styles/
│       └── style.css
└── schema/
    └── schema.sql     # DB bootstrap tables
```

## Getting Started

### Prerequisites

- Docker
- Docker Compose

### Run Locally

1. Clone the repository:

```bash
git clone <your-repo-url>
cd swoley
```

2. Build and start containers:

```bash
docker compose up --build
```

3. Open the app:

- App: [http://localhost:8080](http://localhost:8080)

### Stop the App

```bash
docker compose down
```

To also remove the Postgres volume/data:

```bash
docker compose down -v
```

## Database Notes

- Postgres is started as the `db` service
- Schema is auto-initialized from `schema/schema.sql`
- Default local credentials in `docker-compose.yml`:
  - `POSTGRES_DB=swoley_db`
  - `POSTGRES_USER=postgres`
  - `POSTGRES_PASSWORD=password`

## Data Model (Current)

- **users**: account identity and hashed password
- **workouts**: workout sessions per user
- **exercises**: exercises attached to workouts
- **sets**: reps/weight rows per exercise

## Roadmap

Planned next steps:

- Complete auth flow and workout CRUD end-to-end
- Add progressive overload views and historical charts
- Add personal records and trend lines by lift
- Improve dashboard UX for mobile logging speed

Potential analytics under consideration:

- Estimated 1RM over time
- Volume load by day/week/month
- Exercise frequency and consistency scoring
- Plateau detection and simple recommendations

## Development Notes

- Apache document root is set to `public/`
- PHP extensions installed: `pdo`, `pdo_pgsql`
- Code is mounted into the app container for fast iteration

## Contributing

Early-stage project; contributions, ideas, and issue reports are welcome.

If you open a PR, include:

- A clear description of the change
- Any schema updates and migration notes
- Steps to test locally with Docker

## License

This project is licensed under the Apache License, Version 2.0.

See the [LICENSE](LICENSE) file for the full text.
