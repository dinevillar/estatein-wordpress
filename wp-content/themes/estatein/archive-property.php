<?php
/**
 * Property Archive Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">

  <!-- Properties Archive Header -->
  <section class="properties-section">
    <div class="container">
      <div class="properties__header">
        <h2 class="properties__title">
          <?php
          if (is_tax()) {
            single_term_title();
          } else {
            echo 'All <span class="hero__headline-accent">Properties</span>';
          }
          ?>
        </h2>
        <p class="properties__subtitle">
          <?php
          if (is_tax()) {
            echo 'Browse our collection of ' . single_term_title('', false) . ' properties.';
          } else {
            echo 'Explore our complete catalog of premium properties available for sale and rent.';
          }
          ?>
        </p>
      </div>

      <!-- Filter Bar (simple version) -->
      <div class="properties__filters" style="margin-bottom: 2rem; padding: 1.5rem; background: var(--color-bg-secondary); border-radius: var(--border-radius-xl);">
        <form id="property-filter-form" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end;">
          <div style="flex: 1; min-width: 200px;">
            <label for="min-price" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--color-text-tertiary);">Min Price</label>
            <input type="number" id="min-price" name="min_price" placeholder="Min" style="width: 100%;">
          </div>
          <div style="flex: 1; min-width: 200px;">
            <label for="max-price" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--color-text-tertiary);">Max Price</label>
            <input type="number" id="max-price" name="max_price" placeholder="Max" style="width: 100%;">
          </div>
          <div style="flex: 1; min-width: 200px;">
            <label for="bedrooms" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--color-text-tertiary);">Bedrooms</label>
            <select id="bedrooms" name="bedrooms" style="width: 100%;">
              <option value="">Any</option>
              <option value="1">1+</option>
              <option value="2">2+</option>
              <option value="3">3+</option>
              <option value="4">4+</option>
              <option value="5">5+</option>
            </select>
          </div>
          <div style="flex: 1; min-width: 200px;">
            <label for="bathrooms" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--color-text-tertiary);">Bathrooms</label>
            <select id="bathrooms" name="bathrooms" style="width: 100%;">
              <option value="">Any</option>
              <option value="1">1+</option>
              <option value="2">2+</option>
              <option value="3">3+</option>
              <option value="4">4+</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" style="align-self: flex-end;">Filter</button>
          <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="btn btn-secondary" style="align-self: flex-end;">Clear</a>
        </form>
      </div>

      <!-- Properties Grid -->
      <?php if (have_posts()) : ?>
        <div class="properties__grid">
          <?php while (have_posts()) : the_post();
              $property_id = get_the_ID();
              $price = get_post_meta($property_id, 'property_price', true);
              $bedrooms = get_post_meta($property_id, 'property_bedrooms', true);
              $bathrooms = get_post_meta($property_id, 'property_bathrooms', true);
              $sqft = get_post_meta($property_id, 'property_sqft', true);
              $status = get_post_meta($property_id, 'property_status', true);
              $address = get_post_meta($property_id, 'property_address', true);
              $terms = get_the_terms($property_id, 'property_type');
              $property_type = !is_wp_error($terms) && $terms ? $terms[0]->name : '';
          ?>
            <article class="property-card">
              <div class="property-card__image">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('property-card'); ?>
                <?php else : ?>
                  <img src="<?php echo esc_url(ESTATEIN_URL . '/assets/images/property-placeholder.svg'); ?>" alt="Property image">
                <?php endif; ?>
                <span class="property-card__badge property-card__badge--<?php echo esc_attr($status); ?>">
                  <?php echo esc_html(ucfirst($status)); ?>
                </span>
              </div>
              <div class="property-card__content">
                <h3 class="property-card__title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <?php if ($address) : ?>
                  <div class="property-card__location">
                    <?php echo estatein_get_icon('location', 16); ?>
                    <span><?php echo esc_html($address); ?></span>
                  </div>
                <?php endif; ?>

                <div class="property-card__details">
                  <?php if ($bedrooms) : ?>
                    <div class="property-card__detail">
                      <?php echo estatein_get_icon('bed', 20); ?>
                      <span><?php echo esc_html($bedrooms); ?> Beds</span>
                    </div>
                  <?php endif; ?>
                  <?php if ($bathrooms) : ?>
                    <div class="property-card__detail">
                      <?php echo estatein_get_icon('bath', 20); ?>
                      <span><?php echo esc_html($bathrooms); ?> Baths</span>
                    </div>
                  <?php endif; ?>
                  <?php if ($sqft) : ?>
                    <div class="property-card__detail">
                      <?php echo estatein_get_icon('sqft', 20); ?>
                      <span><?php echo number_format($sqft); ?> sqft</span>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="property-card__footer">
                  <div class="property-card__price">
                    <?php echo estatein_format_price($price); ?>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="property-card__btn">
                    View Details
                    <?php echo estatein_get_icon('arrow-right', 18); ?>
                  </a>
                </div>
              </div>
            </article>
          <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="properties__footer">
          <?php
          the_posts_pagination(array(
              'mid_size' => 2,
              'prev_text' => '&laquo; Prev',
              'next_text' => 'Next &raquo;',
          ));
          ?>
        </div>

      <?php else : ?>
        <div class="no-properties">
          <p>No properties found matching your criteria.</p>
        </div>
      <?php endif; ?>

      <?php wp_reset_postdata(); ?>
    </div>
  </section>

</main><!-- #primary -->

<?php
get_footer();
