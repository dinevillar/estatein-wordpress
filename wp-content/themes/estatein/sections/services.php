<?php
/**
 * Services Section Template Part
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

// Query services
$services = get_posts(array(
    'post_type' => 'service',
    'posts_per_page' => 3,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));
?>

<section class="services-section" id="services">
  <div class="container">
    <!-- Section Header -->
    <div class="services__header">
      <h2 class="services__title">Our <span class="hero__headline-accent">Services</span></h2>
      <p class="services__subtitle">
        Comprehensive real estate services tailored to meet your needs, from buying to selling and beyond.
      </p>
    </div>

    <!-- Services Grid -->
    <?php if ($services) : ?>
      <div class="services__grid">
        <?php foreach ($services as $service) :
            $icon = get_post_meta($service->ID, 'service_icon', true);
            $link = get_post_meta($service->ID, 'service_link', true);
            $external = get_post_meta($service->ID, 'service_external', true);
            $target = $external ? '_blank' : '_self';
        ?>
          <article class="service-card">
            <div class="service-card__icon">
              <div class="service-card__icon-bg"></div>
              <?php echo estatein_get_service_icon($icon); ?>
            </div>
            <h3 class="service-card__title"><?php echo esc_html(get_the_title($service->ID)); ?></h3>
            <div class="service-card__description">
              <?php echo wp_kses_post(wp_trim_words($service->post_content, 20, '...')); ?>
            </div>
            <?php if ($link) : ?>
              <a href="<?php echo esc_url($link); ?>" class="service-card__link" target="<?php echo esc_attr($target); ?>" rel="<?php echo $external ? 'noopener noreferrer' : ''; ?>">
                Learn More
                <?php echo estatein_get_icon('arrow-right', 18); ?>
              </a>
            <?php else : ?>
              <a href="<?php echo esc_url(get_permalink($service->ID)); ?>" class="service-card__link">
                Learn More
                <?php echo estatein_get_icon('arrow-right', 18); ?>
              </a>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>

      <!-- View All Button -->
      <div class="services__footer">
        <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="btn btn-secondary">
          View All Services
        </a>
      </div>
    <?php else : ?>
      <div class="no-services">
        <p>No services found. Add services in WordPress admin.</p>
      </div>
    <?php endif; ?>
  </div>
</section>
