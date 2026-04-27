<?php
/**
 * Hero Section Template Part
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get featured property for spotlight (optional)
$featured_property = get_posts(array(
    'post_type' => 'property',
    'posts_per_page' => 1,
    'meta_key' => 'property_price',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
));
?>
<section class="hero" id="hero">
  <!-- Background -->
  <div class="hero__bg"></div>

  <!-- Decorative Shapes -->
  <div class="hero__decor">
    <div class="hero__decor-shape hero__decor-shape--1"></div>
    <div class="hero__decor-shape hero__decor-shape--2"></div>
    <div class="hero__decor-shape hero__decor-shape--3"></div>
  </div>

  <!-- Content -->
  <div class="hero__content">
    <div class="hero__content-inner">
      <!-- Left Column: Text and Search -->
      <div class="hero__left">
        <h1 class="hero__headline">
          Discover Your Dream Property with Estatein
        </h1>
        <p class="hero__subheadline">
          Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.
        </p>

        <!-- Buttons -->
        <div class="hero__buttons">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="hero__btn hero__btn--outline">Learn More</a>
          <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="hero__btn hero__btn--primary">Browse Properties</a>
        </div>

        <!-- Stats -->
        <div class="hero__stats">
          <div class="hero__stat-card">
            <span class="hero__stat-number">200+</span>
            <span class="hero__stat-label">Happy Customers</span>
          </div>
          <div class="hero__stat-card">
            <span class="hero__stat-number">10k+</span>
            <span class="hero__stat-label">Properties For Clients</span>
          </div>
          <div class="hero__stat-card">
            <span class="hero__stat-number">16+</span>
            <span class="hero__stat-label">Years of Experience</span>
          </div>
        </div>
      </div>

      <!-- Right Column: Image and Badge -->
      <div class="hero__right">
        <div class="hero__image-wrapper">
          <div class="hero__image-container">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-building.png'); ?>" alt="Modern Building" class="hero__building-image">
            <div class="hero__image-overlay"></div>
          </div>
          
          <!-- Spinning Badge -->
          <div class="hero__badge">
            <svg viewBox="0 0 160 160" class="hero__badge-text-svg">
              <path id="badge-text-path" d="M 80, 80 m -50, 0 a 50,50 0 1,1 100,0 a 50,50 0 1,1 -100,0" fill="transparent" />
              <text fill="#FFFFFF" font-family="'Urbanist', sans-serif" font-size="14.5" font-weight="600" letter-spacing="1.5">
                <textPath href="#badge-text-path" startOffset="0%" textLength="314">
                  ✨ Discover Your Dream property 
                </textPath>
              </text>
            </svg>
            <div class="hero__badge-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="hero__badge-arrow" aria-hidden="true">
                <path fill-rule="evenodd" d="M8.25 3.75H19.5a.75.75 0 0 1 .75.75v11.25a.75.75 0 0 1-1.5 0V6.31L5.03 20.03a.75.75 0 0 1-1.06-1.06L17.69 5.25H8.25a.75.75 0 0 1 0-1.5Z" clip-rule="evenodd"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
