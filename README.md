# QuoteFlow – Supplier & Product Management API

QuoteFlow is a web-based application built with Laravel, PHP, and Docker to manage supplier and product data through RESTful APIs.

This project was developed as part of the Cloud Services course assignment. It demonstrates containerized application deployment, database integration, REST API implementation, and data persistence using Docker Compose.

## Project Overview

| Information | Details |
|---|---|
| Project Name | QuoteFlow |
| Framework | Laravel |
| Programming Language | PHP 8.4 |
| Database | MySQL 8.0.36 |
| Containerization | Docker & Docker Compose |
| Web Server | Apache |
| Architecture | Multi-container application |

### Main Features

- Supplier Management (Create, Read, Update, Delete)
- Product Management (Create, Read, Update, Delete)
- RESTful API endpoints
- MySQL database integration
- Docker multi-stage build
- Persistent database storage using Docker named volume
- Database healthcheck
- Optional Adminer database management

## Architecture

QuoteFlow uses a multi-container architecture consisting of:

1. **Application Container:** Laravel application running on PHP 8.4 and Apache.
2. **Database Container:** MySQL 8.0.36 for storing application data.
3. **Adminer Container:** Optional database management interface.

The application communicates with MySQL through a user-defined Docker bridge network using the service hostname `db`.

### Port Configuration

| Service | Port | Description |
|---|---|---|
| Laravel Application | 8080 | Application access |
| Adminer | 8081 | Optional database management |
| MySQL | 3306 | Internal Docker network |

## Requirements

Before running this project, make sure you have:

- Docker Desktop
- Docker Compose
- Git

## Installation and Setup

### 1. Clone Repository

```bash
git clone https://github.com/HCK116/QuoteFlow.git
cd QuoteFlow
```

### 2. Create Environment File

Copy the example environment file.

**Windows PowerShell:**

```powershell
Copy-Item .env.example .env
```

**Linux/macOS:**

```bash
cp .env.example .env
```

Configure the required environment variables in `.env` according to the Docker Compose configuration.

Make sure the application key and database credentials are configured correctly. Never upload the real `.env` file or expose application secrets.

### 3. Build and Start Containers

```bash
docker compose up -d --build
```

### 4. Check Container Status

```bash
docker compose ps
```

Wait until the application container is running and the MySQL container reports `healthy`.

### 5. Generate Application Key

If `APP_KEY` is empty in your local `.env` file, generate it using:

```bash
docker compose exec app php artisan key:generate
```

Do not regenerate the key if one is already configured for an existing application environment.

### 6. Run Database Migrations

```bash
docker compose exec app php artisan migrate
```

### 7. Access Application

Health check endpoint:

```text
http://localhost:8080/health
```

Expected response:

```json
{
    "status": "healthy",
    "application": "QuoteFlow",
    "version": "1.0.0"
}
```

## API Endpoints

Base URL:

```text
http://localhost:8080
```

### Health Check

| Method | Endpoint | Description |
|---|---|---|
| GET | `/health` | Check application health |

### Supplier API

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/suppliers` | Get all suppliers |
| POST | `/api/suppliers` | Create a supplier |
| GET | `/api/suppliers/{id}` | Get supplier by ID |
| PUT | `/api/suppliers/{id}` | Update supplier |
| DELETE | `/api/suppliers/{id}` | Delete supplier |

### Product API

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/products` | Get all products |
| POST | `/api/products` | Create a product |
| GET | `/api/products/{id}` | Get product by ID |
| PUT | `/api/products/{id}` | Update product |
| DELETE | `/api/products/{id}` | Delete product |

## Database Persistence

QuoteFlow uses a Docker named volume called `quoteflow_data` to persist MySQL database data.

The data remains available after containers are stopped and recreated using:

```bash
docker compose down
docker compose up -d
```

The named volume preserves database contents when containers are recreated.

**Important:** Do not use `docker compose down -v` when you want to preserve database data, because this command removes the Compose-managed named volume.

## Optional: Adminer

Adminer can be started using the Docker Compose `tools` profile.

```bash
docker compose --profile tools up -d
```

Access Adminer at:

```text
http://localhost:8081
```

Use the following database connection settings:

| Setting | Value |
|---|---|
| System | MySQL |
| Server | `db` |
| Username | `quoteflow_user` |
| Password | Configured in local `.env` |
| Database | `quoteflow_db` |

## Testing Evidence

The following screenshots document the application and Docker testing process:

- Docker Compose container status
- Application health check
- Supplier API CRUD operations
- Product API CRUD operations
- Database persistence before and after container restart
- Docker image information
- PHP version and installed PHP extensions

Screenshots can be added to this repository in a folder named `screenshots/`.

## AI Usage Declaration

AI tools were used as supporting tools during project development and documentation.

**AI Tool Used:** ChatGPT

AI assistance included:

- Guidance on Dockerfile and Docker Compose configuration.
- Assistance with Laravel REST API implementation.
- Troubleshooting Docker, Laravel, and database configuration.
- Assistance with project documentation and technical explanations.

The developer reviewed, tested, and evaluated the implementation and is responsible for the submitted project.

## Project Links

- **GitHub Repository:** https://github.com/HCK116/QuoteFlow
- **Article:** To be added
- **YouTube Demo:** To be added

## Author

Developed as an academic project for the Cloud Services course.