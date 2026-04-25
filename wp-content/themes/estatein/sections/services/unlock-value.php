<?php
/**
 * Unlock Property Value Section
 *
 * @package EstateIn
 */
?>

<section id="unlock-value" class="services-features">
  <div class="container">
    <div class="services-features__header">
      <img src="<?php echo esc_url(ESTATEIN_URL . '/assets/images/abstract-design-left.svg'); ?>" alt="" class="services-features__abstract">
      <h2 class="services-features__title">Unlock Property Value</h2>
      <p class="services-features__subtitle">Selling your property should be a rewarding experience, and at Estatein, we make sure it is. Our Property Selling Service is designed to maximize the value of your property, ensuring you get the best deal possible. Explore the categories below to see how we can help you at every step of your selling journey.</p>
    </div>

    <div class="services-features__grid">
      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('bar-chart'); ?></div>
          <h3 class="service-feature-card__title">Valuation Mastery</h3>
        </div>
        <p class="service-feature-card__text">Discover the true worth of your property with our expert valuation services.</p>
      </div>

      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('pie-chart'); ?></div>
          <h3 class="service-feature-card__title">Strategic Marketing</h3>
        </div>
        <p class="service-feature-card__text">Selling a property requires more than just a listing; it demands a strategic marketing approach.</p>
      </div>

      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('briefcase'); ?></div>
          <h3 class="service-feature-card__title">Negotiation Wizardry</h3>
        </div>
        <p class="service-feature-card__text">Negotiating the best deal is an art, and our negotiation experts are masters of it.</p>
      </div>

      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('speaker'); ?></div>
          <h3 class="service-feature-card__title">Closing Success</h3>
        </div>
        <p class="service-feature-card__text">A successful sale is not complete until the closing. We guide you through the intricate closing process.</p>
      </div>
      
      <div class="service-feature-cta">
        <div class="service-feature-cta__content">
          <h3 class="service-feature-cta__title">Unlock the Value of Your Property Today</h3>
          <p class="service-feature-cta__text">Ready to unlock the true value of your property? Explore our Property Selling Service categories and let us help you achieve the best deal possible for your valuable asset.</p>
        </div>
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn--secondary">Learn More</a>
      </div>
    </div>
  </div>
</section>
