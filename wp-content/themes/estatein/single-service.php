<?php
/**
 * Single Service Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$service_id = get_the_ID();
$icon = get_post_meta($service_id, 'service_icon', true);
$link = get_post_meta($service_id, 'service_link', true);
$external = get_post_meta($service_id, 'service_external', true);
$target = $external ? '_blank' : '_self';
?>

<main id="primary" class="site-main single-service">

  <section class="service-single" style="padding: var(--spacing-4xl) 0;">
    <div class="container">
      <div style="max-width: 800px; margin: 0 auto; text-align: center;">
        <!-- Icon -->
        <?php if ($icon) : ?>
          <div style="width: 100px; height: 100px; margin: 0 auto var(--spacing-xl); background: linear-gradient(135deg, var(--color-accent-primary), var(--color-accent-secondary)); border-radius: var(--border-radius-xl); display: flex; align-items: center; justify-content: center;">
            <?php echo estatein_get_service_icon($icon, 48); ?>
          </div>
        <?php endif; ?>

        <!-- Title -->
        <h1 style="font-size: var(--font-size-4xl); color: var(--color-text-primary); margin-bottom: var(--spacing-lg);">
          <?php the_title(); ?>
        </h1>

        <!-- Content -->
        <div class="service-content" style="color: var(--color-text-secondary); line-height: var(--line-height-relaxed); font-size: var(--font-size-lg);">
          <?php the_content(); ?>
        </div>

        <?php if ($link) : ?>
          <div style="margin-top: var(--spacing-2xl);">
            <a href="<?php echo esc_url($link); ?>" class="btn btn-primary" target="<?php echo esc_attr($target); ?>" rel="<?php echo $external ? 'noopener noreferrer' : ''; ?>">
              Get Started
              <?php echo estatein_get_icon('arrow-right', 18); ?>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Related Services -->
  <?php
  $related_services = get_posts(array(
      'post_type' => 'service',
      'posts_per_page' => 3,
      'exclude' => array($service_id),
      'orderby' => 'rand',
  ));

  if ($related_services) :
  ?>
    <section class="related-services" style="padding: var(--spacing-3xl) 0; background: var(--color-bg-secondary);">
      <div class="container">
        <h3 style="font-size: var(--font-size-2xl); color: var(--color-text-primary); margin-bottom: var(--spacing-2xl); text-align: center;">
          Other Services
        </h3>
        <div class="services__grid">
          <?php foreach ($related_services as $related) :
              $related_icon = get_post_meta($related->ID, 'service_icon', true);
          ?>
            <div class="service-card">
              <div class="service-card__icon">
                <div class="service-card__icon-bg"></div>
                <?php echo estatein_get_service_icon($related_icon); ?>
              </div>
              <h3 class="service-card__title">
                <a href="<?php echo esc_url(get_permalink($related->ID)); ?>" style="color: inherit; text-decoration: none;">
                  <?php echo esc_html(get_the_title($related->ID)); ?>
                </a>
              </h3>
              <div class="service-card__description">
                <?php echo wp_kses_post(wp_trim_words($related->post_content, 15, '...')); ?>
              </div>
              <a href="<?php echo esc_url(get_permalink($related->ID)); ?>" class="service-card__link">
                Learn More
                <?php echo estatein_get_icon('arrow-right', 18); ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

</main>

<?php
get_footer();
