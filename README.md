# Estatein WordPress Project

This project contains the Estatein WordPress theme and the local development environment via Docker.

## Demo Video: https://www.loom.com/share/d501f5b67a0b42409b15944341843079

## Prerequisites

- Docker and Docker Compose installed on your system.

## Getting Started

Follow these steps to run the project locally.

### 1. Start the Docker Environment

Navigate to the root directory of the project in your terminal and run:

```bash
docker compose up -d
```

This will start the following containers:
- WordPress (port 8080)
- MySQL/MariaDB database
- phpMyAdmin (port 8081)

### 2. Access the Website

- **Frontend:** http://localhost:8080
- **Admin Dashboard:** http://localhost:8080/wp-admin
- **phpMyAdmin:** http://localhost:8081

### 3. Generate Dummy Properties (Seeder)

To test the property filters, you can use the built-in WP-CLI command to generate dummy properties.

First, copy an image to the container to be used as a placeholder (optional):
```bash
docker cp /path/to/your/image.png estatein-wordpress:/tmp/property_placeholder.png
```

Then, run the seeder command via Docker:
```bash
docker exec estatein-wordpress wp estatein seed_properties --count=20 --image=/tmp/property_placeholder.png --allow-root
```

This command will:
- Generate 20 random properties (you can change `--count` as needed).
- Create random prices, square footage, and build years.
- Create and assign random locations, types, and features (taxonomies).
- Upload the provided image to the media library and set it as the featured image and gallery images.

## Theme Development

The custom theme is located at `wp-content/themes/estatein`. Any changes made to the files in this directory will immediately reflect on the local WordPress site.
