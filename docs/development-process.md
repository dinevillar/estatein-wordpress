# Development Process & Technical Documentation: Estatein WordPress Theme

This document outlines the development process, technical choices, and tools utilized during the creation of the **Estatein WordPress Theme**.

## 1. Project Overview
The primary objective of this project was to convert a high-fidelity Figma design for a real estate business into a fully functional, responsive, and performant custom WordPress theme. The theme is built to be manageable by non-technical users while maintaining strict adherence to design specifications.

## 2. Development Process

### 2.1 Design-First Workflow
We followed a "Design-First" approach, ensuring that every component matches the [Estatein Figma Template](https://www.figma.com/design/8TZSEqWKHs2CZR0LNYpOCM/Real-Estate-Business-Website-UI-Template---Dark-Theme-%7C-Produce-UI--Community-?node-id=45-2&m=dev) with pixel precision.
- **Token Extraction**: Color palettes, typography scales, and spacing units were extracted from Figma and implemented as CSS Variables in `style.css`.
- **Component Mapping**: Each visual section in Figma was mapped to a modular PHP partial in the `sections/` directory.

### 2.2 Theme Architecture
The theme is built as a **Custom WordPress Theme** from scratch, avoiding bloated frameworks or page builders to ensure maximum performance and SEO efficiency.
- **Modular Sections**: The theme uses a modular structure where each section (Hero, Features, Properties, etc.) has its own PHP file and dedicated CSS partial.
- **Logic Separation**: Core functionality (CPTs, AJAX handlers, walkers) is contained within the `inc/` directory, keeping `functions.php` clean and manageable.

## 3. Key Technical Choices

### 3.1 Custom Post Types (CPTs)
To manage structured data effectively, three primary CPTs were implemented:
- **Properties**: Stores real estate listings with metadata for price, location, bedrooms, bathrooms, etc.
- **Services**: Manages the various service offerings (Investment, Management, etc.).
- **Testimonials**: Stores client feedback and ratings.

### 3.2 Advanced Custom Fields (ACF) & Local JSON
We chose **ACF Pro** as the backbone for content management. 
- **Local JSON**: ACF field groups are saved as JSON files in the `acf/json/` directory. This allows for version control of database fields and ensures that field configurations are automatically synced across different environments (local, staging, production).

### 3.3 Vanilla CSS & Asset Management
- **No Utility Frameworks**: We opted for vanilla CSS over Tailwind or Bootstrap to maintain full control over the complex, dark-themed design and to minimize the final asset size.
- **CSS Partials**: Styles are organized into small, focused files (e.g., `hero.css`, `properties.css`) located in `css/partials/`, which are then enqueued based on the page's requirements.
- **Custom Nav Walker**: A custom PHP class (`class-nav-walker.php`) was built to handle the unique styling and active-state requirements of the navigation menu.

### 3.4 Data Seeder
To facilitate rapid development and testing of search/filter features, a custom **Property Seeder** (`inc/property-seeder.php`) was developed. This script programmatically populates the site with realistic property data.

## 4. Tools & Plugins

### 4.1 Plugins
- **Advanced Custom Fields (ACF)**: Used for all custom metadata and flexible page sections. No other third-party plugins were used in the core development to maintain performance.

### 4.2 Development Environment
- **Docker**: A complete local environment is provided via `docker-compose.yml`, including:
  - **WordPress**: Latest stable version.
  - **MySQL 8.0**: For data storage.
  - **phpMyAdmin**: For database management.
- **Git**: Used for version control, with a strict `.gitignore` to keep the repository focused only on custom theme files.

## 5. Performance & SEO
- **Semantic HTML5**: Used throughout the theme for accessibility and SEO.
- **Image Optimization**: Custom image sizes (defined in `functions.php`) ensure that the browser only loads the necessary image dimensions.
- **Minified Logic**: Assets are enqueued using standard WordPress best practices, with versioning to prevent caching issues during updates.

## 6. Future Maintenance
The modular nature of the `sections/` and `inc/` directories makes it easy to add new features. To add a new section:
1. Create a PHP file in `sections/`.
2. Create a corresponding CSS file in `css/partials/`.
3. Enqueue the style in `functions.php` and include the section in the desired page template.
