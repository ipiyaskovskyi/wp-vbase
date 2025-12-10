# WordPress Performance Project

High-performance WordPress setup with Docker.

## Quick Start

```bash
# Start all services
docker-compose up -d

# Wait for containers to be ready
docker-compose ps
```

## Access URLs

- **WordPress**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

## Database Credentials

| Parameter | Value |
|-----------|-------|
| Database | wordpress |
| User | wp_user |
| Password | wp_password_secure_123 |
| Root Password | root_password_secure_123 |

## WP-CLI Commands

```bash
# Run WP-CLI commands
docker-compose run --rm wpcli wp plugin list
docker-compose run --rm wpcli wp theme list
docker-compose run --rm wpcli wp cache flush
```

## Theme Development

Custom themes are mounted from `./themes/` directory to `/var/www/html/wp-content/themes/custom-themes/`

## Performance Optimizations

The included custom theme features:
- Critical CSS inlining
- Lazy loading for images
- Async/defer script loading
- Minimal DOM structure
- SEO optimizations
- Schema markup

## Useful Commands

```bash
# Stop services
docker-compose down

# Stop and remove volumes (reset everything)
docker-compose down -v

# View logs
docker-compose logs -f wordpress

# Restart WordPress
docker-compose restart wordpress
```

