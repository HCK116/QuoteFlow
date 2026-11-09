# QuoteFlow – Docker Architecture

## 1. Architecture Overview

QuoteFlow uses a multi-container architecture managed by Docker Compose. The application consists of a Laravel application container and a MySQL database container. An optional Adminer container is available for database management.

## 2. Application Container

The application container runs Laravel using PHP 8.4 and Apache.

- Service name: `app`
- Container name: `quoteflow-app`
- Internal port: `80`
- Host port: `8080`

Users can access the application through `http://localhost:8080`.

## 3. Database Container

The database container uses MySQL 8.0.36.

- Service name: `db`
- Container name: `quoteflow-db`
- Internal port: `3306`
- Database: `quoteflow_db`

The Laravel application connects to MySQL using the Docker service hostname `db`, rather than `localhost`.

## 4. Docker Network

The application and database communicate through a user-defined Docker bridge network named `quoteflow-network`.

This allows the containers to communicate using their service names.

## 5. Database Persistence

QuoteFlow uses a Docker named volume called `quoteflow_data` to persist MySQL data.

The volume ensures that database records remain available when containers are stopped and recreated using `docker compose down` and `docker compose up -d`.

## 6. Healthcheck and Service Dependency

The MySQL service uses a healthcheck to verify database readiness.

The application service uses `depends_on` with the `service_healthy` condition so it waits for the database healthcheck to pass before starting.

## 7. Optional Adminer

Adminer is available through the Docker Compose `tools` profile.

- Host port: `8081`
- Internal port: `8080`
- Database server: `db`

It can be started using:

```bash
docker compose --profile tools up -d
```

## 8. Request Flow

1. A user sends an HTTP request through a browser or API client.
2. The request reaches the Laravel application through port `8080`.
3. Laravel processes the request.
4. If database access is required, Laravel communicates with MySQL through the `quoteflow-network` network using hostname `db`.
5. MySQL reads or writes data in the persistent `quoteflow_data` volume.
6. Laravel returns the API response to the user.