<?php
/**
 * About Us - Hero Section ("Our Journey")
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="about-hero" id="our-journey">
  <div class="container">
    <div class="about-hero__inner">

      <!-- Left Column -->
      <div class="about-hero__left">
        <div class="about-hero__text-wrap">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/abstract-design.svg'); ?>" alt="Abstract Design" class="section-star-decor">
          <h1 class="about-hero__heading">Our Journey</h1>
          <p class="about-hero__paragraph">Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary. Over the years, we've expanded our reach, forged valuable partnerships, and gained the trust of countless clients.</p>
        </div>

        <!-- Stats -->
        <div class="about-hero__stats">
          <div class="about-hero__stat-card">
            <span class="about-hero__stat-number">200+</span>
            <span class="about-hero__stat-label">Happy Customers</span>
          </div>
          <div class="about-hero__stat-card">
            <span class="about-hero__stat-number">10k+</span>
            <span class="about-hero__stat-label">Properties For Clients</span>
          </div>
          <div class="about-hero__stat-card">
            <span class="about-hero__stat-number">16+</span>
            <span class="about-hero__stat-label">Years of Experience</span>
          </div>
        </div>
      </div>

      <!-- Right Column: Image -->
      <div class="about-hero__right">
        <div class="about-hero__image-wrap">
          <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about.png'); ?>"
            alt="Estatein team at work"
            class="about-hero__image"
          >
        </div>
      </div>

    </div>
  </div>
</section>
