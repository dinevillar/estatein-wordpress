<?php
/**
 * Effortless Property Management Section
 *
 * @package EstateIn
 */
?>

<section id="effortless-management" class="services-features">
  <div class="container">
    <div class="services-features__header">
      <img src="<?php echo esc_url(ESTATEIN_URL . '/assets/images/abstract-design-left.svg'); ?>" alt="" class="services-features__abstract">
      <h2 class="services-features__title">Effortless Property Management</h2>
      <p class="services-features__subtitle">Owning a property should be a pleasure, not a hassle. Estatein's Property Management Service takes the stress out of property ownership, offering comprehensive solutions tailored to your needs. Explore the categories below to see how we can make property management effortless for you.</p>
    </div>

    <div class="services-features__grid">
      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('users'); ?></div>
          <h3 class="service-feature-card__title">Tenant Harmony</h3>
        </div>
        <p class="service-feature-card__text">Our Tenant Management services ensure that your tenants have a smooth and reducing vacancies.</p>
      </div>

      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('tool'); ?></div>
          <h3 class="service-feature-card__title">Maintenance Ease</h3>
        </div>
        <p class="service-feature-card__text">Say goodbye to property maintenance headaches. We handle all aspects of property upkeep.</p>
      </div>

      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('dollar-sign'); ?></div>
          <h3 class="service-feature-card__title">Financial Peace of Mind</h3>
        </div>
        <p class="service-feature-card__text">Managing property finances can be complex. Our financial experts take care of rent collection.</p>
      </div>

      <div class="service-feature-card">
        <div class="service-feature-card__header">
          <div class="service-feature-card__icon"><?php echo estatein_service_icon('shield'); ?></div>
          <h3 class="service-feature-card__title">Legal Guardian</h3>
        </div>
        <p class="service-feature-card__text">Stay compliant with property laws and regulations effortlessly.</p>
      </div>
      
      <div class="service-feature-cta">
        <div class="service-feature-cta__content">
          <h3 class="service-feature-cta__title">Experience Effortless Property Management</h3>
          <p class="service-feature-cta__text">Ready to experience hassle-free property management? Explore our Property Management Service categories and let us handle the complexities while you enjoy the benefits of property ownership.</p>
        </div>
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn--secondary">Learn More</a>
      </div>
    </div>
  </div>
</section>
