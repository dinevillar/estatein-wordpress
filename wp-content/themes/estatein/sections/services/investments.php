<?php
/**
 * Smart Investments Section
 *
 * @package EstateIn
 */
?>

<section id="smart-investments" class="services-investments">
  <div class="container">
    <div class="services-investments__grid">
      <div class="services-investments__left">
        <div class="services-investments__header">
          <div class="services-features__abstract"><?php echo estatein_service_icon('spark'); ?></div>
          <h2 class="services-investments__title">Smart Investments, Informed Decisions</h2>
          <p class="services-investments__subtitle">Building a real estate portfolio requires a strategic approach. Estatein's Investment Advisory Service empowers you to make smart investments and informed decisions.</p>
        </div>
        <div class="service-feature-cta service-feature-cta--compact">
          <div class="service-feature-cta__content">
            <h3 class="service-feature-cta__title">Unlock Your Investment Potential</h3>
            <p class="service-feature-cta__text">Explore our Property Management Service categories and let us handle the complexities while you enjoy the benefits of property ownership.</p>
          </div>
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn">Learn More</a>
        </div>
      </div>
      
      <div class="services-investments__right">
        <div class="service-feature-card">
          <div class="service-feature-card__header">
            <div class="service-feature-card__icon"><?php echo estatein_service_icon('chart-bar'); ?></div>
            <h3 class="service-feature-card__title">Market Insight</h3>
          </div>
          <p class="service-feature-card__text">Stay ahead of market trends with our expert Market Analysis. We provide in-depth insights into real estate market conditions</p>
        </div>

        <div class="service-feature-card">
          <div class="service-feature-card__header">
            <div class="service-feature-card__icon"><?php echo estatein_service_icon('fire'); ?></div>
            <h3 class="service-feature-card__title">ROI Assessment</h3>
          </div>
          <p class="service-feature-card__text">Make investment decisions with confidence. Our ROI Assessment services evaluate the potential returns on your investments</p>
        </div>

        <div class="service-feature-card">
          <div class="service-feature-card__header">
            <div class="service-feature-card__icon"><?php echo estatein_service_icon('lightbulb'); ?></div>
            <h3 class="service-feature-card__title">Customized Strategies</h3>
          </div>
          <p class="service-feature-card__text">Every investor is unique, and so are their goals. We develop Customized Investment Strategies tailored to your specific needs</p>
        </div>

        <div class="service-feature-card">
          <div class="service-feature-card__header">
            <div class="service-feature-card__icon"><?php echo estatein_service_icon('sun'); ?></div>
            <h3 class="service-feature-card__title">Diversification Mastery</h3>
          </div>
          <p class="service-feature-card__text">Diversify your real estate portfolio effectively. Our experts guide you in spreading your investments across various property types and locations</p>
        </div>
      </div>
    </div>
  </div>
</section>
