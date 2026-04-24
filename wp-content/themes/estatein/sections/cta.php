<?php
/**
 * CTA Section Template Part
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="cta-section" id="cta">
  <!-- Decorative abstract backgrounds -->
  <div class="cta__bg-left"></div>
  <div class="cta__bg-right"></div>

  <div class="cta__inner">
    <!-- Text -->
    <div class="cta__text">
      <h2 class="cta__title">Start Your Real Estate Journey <span class="text-accent">Today</span></h2>
      <p class="cta__subtitle">
        Your dream property is just a click away. Whether you're looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way. Take the first step towards your real estate goals and explore our available properties or get in touch with our team for personalized assistance.
      </p>
    </div>
    <!-- Button -->
    <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="btn-primary">
      Explore Properties
    </a>
  </div>
</section>
