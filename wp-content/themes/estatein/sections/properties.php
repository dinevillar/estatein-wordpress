<?php
/**
 * Properties Section Template Part
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = array(
    'post_type'      => 'property',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'meta_query'     => array(
        array(
            'key'     => 'property_status',
            'value'   => 'sold',
            'compare' => '!=',
        ),
    ),
);

$property_query = new WP_Query($args);
?>

<section class="properties-section" id="properties">
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <div class="section-header__text">
        <h2 class="section-header__title">Featured <span class="text-accent">Properties</span></h2>
        <p class="section-header__subtitle">
          Explore our handpicked selection of featured properties. Each listing offers a glimpse into exceptional homes and investments available through Estatein. Click "View Details" for more information.
        </p>
      </div>
      <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="btn-outline">
        View All Properties
      </a>
    </div>

    <!-- Properties Grid -->
    <div class="properties__cards">
      <?php if ($property_query->have_posts()) : ?>
        <?php while ($property_query->have_posts()) : $property_query->the_post();
            $property_id = get_the_ID();
            $price       = get_post_meta($property_id, 'property_price', true);
            $bedrooms    = get_post_meta($property_id, 'property_bedrooms', true);
            $bathrooms   = get_post_meta($property_id, 'property_bathrooms', true);
            $sqft        = get_post_meta($property_id, 'property_sqft', true);
            $status      = get_post_meta($property_id, 'property_status', true);
            $terms       = get_the_terms($property_id, 'property_type');
            $property_type = !is_wp_error($terms) && $terms ? $terms[0]->name : 'Villa';
        ?>
        <article class="property-card">
          <!-- Image -->
          <div class="property-card__image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('large', ['class' => 'property-card__img']); ?>
            <?php else : ?>
              <img src="<?php echo esc_url(ESTATEIN_URL . '/assets/images/property-placeholder.jpg'); ?>" alt="Property" class="property-card__img">
            <?php endif; ?>
          </div>

          <!-- Card Body -->
          <div class="property-card__body">
            <!-- Text -->
            <div class="property-card__text">
              <h3 class="property-card__title"><?php the_title(); ?></h3>
              <p class="property-card__desc">
                <?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 15, '... '); ?>
                <a href="<?php the_permalink(); ?>" class="property-card__readmore">Read More</a>
              </p>
            </div>

            <!-- Feature Pills -->
            <div class="property-card__pills">
              <?php if ($bedrooms) : ?>
              <span class="pill">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 12V8a1 1 0 011-1h16a1 1 0 011 1v4M3 12v6h18v-6M3 12H1m20 0h2M7 12V9m10 3V9"/></svg>
                <?php echo esc_html($bedrooms); ?>-Bedroom
              </span>
              <?php endif; ?>
              <?php if ($bathrooms) : ?>
              <span class="pill">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 12h16a1 1 0 011 1v3a4 4 0 01-4 4H7a4 4 0 01-4-4v-3a1 1 0 011-1z"/><path d="M6 12V5a2 2 0 012-2h3v2.25"/></svg>
                <?php echo esc_html($bathrooms); ?>-Bathroom
              </span>
              <?php endif; ?>
              <span class="pill">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                <?php echo esc_html($property_type); ?>
              </span>
            </div>

            <!-- Price + CTA -->
            <div class="property-card__footer">
              <div class="property-card__price-wrap">
                <span class="property-card__price-label">Price</span>
                <span class="property-card__price"><?php echo estatein_format_price($price); ?></span>
              </div>
              <a href="<?php the_permalink(); ?>" class="btn-primary">
                View Property Details
              </a>
            </div>
          </div>
        </article>
        <?php endwhile; ?>
      <?php else : ?>
        <!-- Placeholder cards matching design -->
        <?php
        $placeholder_properties = [
          ['title' => 'Seaside Serenity Villa', 'desc' => 'A stunning 4-bedroom, 3-bathroom villa in a peaceful suburban neighborhood...', 'beds' => '4', 'baths' => '3', 'type' => 'Villa', 'price' => '$550,000'],
          ['title' => 'Metropolitan Haven', 'desc' => 'A chic and fully-furnished 2-bedroom apartment with panoramic city views...', 'beds' => '2', 'baths' => '2', 'type' => 'Villa', 'price' => '$350,000'],
          ['title' => 'Rustic Retreat Cottage', 'desc' => 'An elegant 3-bedroom, 2.5-bathroom townhouse in a gated community...', 'beds' => '3', 'baths' => '3', 'type' => 'Villa', 'price' => '$820,000'],
        ];
        foreach ($placeholder_properties as $prop) : ?>
        <article class="property-card">
          <div class="property-card__image property-card__image--placeholder">
            <div class="property-card__placeholder-img"></div>
          </div>
          <div class="property-card__body">
            <div class="property-card__text">
              <h3 class="property-card__title"><?php echo esc_html($prop['title']); ?></h3>
              <p class="property-card__desc">
                <?php echo esc_html($prop['desc']); ?> <a href="#" class="property-card__readmore">Read More</a>
              </p>
            </div>
            <div class="property-card__pills">
              <span class="pill">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 12V8a1 1 0 011-1h16a1 1 0 011 1v4M3 12v6h18v-6"/></svg>
                <?php echo esc_html($prop['beds']); ?>-Bedroom
              </span>
              <span class="pill">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 12h16a1 1 0 011 1v3a4 4 0 01-4 4H7a4 4 0 01-4-4v-3a1 1 0 011-1z"/></svg>
                <?php echo esc_html($prop['baths']); ?>-Bathroom
              </span>
              <span class="pill">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                <?php echo esc_html($prop['type']); ?>
              </span>
            </div>
            <div class="property-card__footer">
              <div class="property-card__price-wrap">
                <span class="property-card__price-label">Price</span>
                <span class="property-card__price"><?php echo esc_html($prop['price']); ?></span>
              </div>
              <a href="#" class="btn-primary">View Property Details</a>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>

    <!-- Pagination Nav -->
    <div class="section-nav">
      <p class="section-nav__count"><span class="text-white">01</span> of 60</p>
      <div class="section-nav__buttons">
        <button class="section-nav__btn" aria-label="Previous properties">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </button>
        <button class="section-nav__btn section-nav__btn--active" aria-label="Next properties">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>
