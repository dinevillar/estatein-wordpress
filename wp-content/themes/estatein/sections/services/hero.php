<?php
/**
 * Services Hero Section
 *
 * @package EstateIn
 */
?>

<section class="services-hero">
  <div class="container">
    <div class="services-hero__header">
      <h1 class="services-hero__title">Elevate Your Real Estate Experience</h1>
      <p class="services-hero__subtitle">Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.</p>
    </div>

    <div class="services-hero__links">
      <a href="#unlock-value" class="services-hero__link-card">
        <div class="services-hero__link-icon"><?php echo estatein_service_icon('home'); ?></div>
        <span class="services-hero__link-text">Find Your Dream Home</span>
        <div class="services-hero__link-arrow"><?php echo estatein_get_icon('arrow-up-right', 24); ?></div>
      </a>
      <a href="#unlock-value" class="services-hero__link-card">
        <div class="services-hero__link-icon"><?php echo estatein_service_icon('search-value'); ?></div>
        <span class="services-hero__link-text">Unlock Property Value</span>
        <div class="services-hero__link-arrow"><?php echo estatein_get_icon('arrow-up-right', 24); ?></div>
      </a>
      <a href="#effortless-management" class="services-hero__link-card">
        <div class="services-hero__link-icon"><?php echo estatein_service_icon('manage'); ?></div>
        <span class="services-hero__link-text">Effortless Property Management</span>
        <div class="services-hero__link-arrow"><?php echo estatein_get_icon('arrow-up-right', 24); ?></div>
      </a>
      <a href="#smart-investments" class="services-hero__link-card">
        <div class="services-hero__link-icon"><?php echo estatein_service_icon('sun'); ?></div>
        <span class="services-hero__link-text">Smart Investments, Informed Decisions</span>
        <div class="services-hero__link-arrow"><?php echo estatein_get_icon('arrow-up-right', 24); ?></div>
      </a>
    </div>
  </div>
</section>
