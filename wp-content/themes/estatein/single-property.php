<?php
/**
 * Single Property Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$property_id = get_the_ID();
$price = get_post_meta($property_id, 'property_price', true);
$bedrooms = get_post_meta($property_id, 'property_bedrooms', true);
$bathrooms = get_post_meta($property_id, 'property_bathrooms', true);
$sqft = get_post_meta($property_id, 'property_sqft', true);
$status = get_post_meta($property_id, 'property_status', true);
$address = get_post_meta($property_id, 'property_address', true);
$video_url = get_post_meta($property_id, 'property_video', true);
$virtual_tour = get_post_meta($property_id, 'property_virtual_tour', true);
$gallery = get_post_meta($property_id, 'property_gallery', true);

$terms = get_the_terms($property_id, 'property_type');
$property_type = !is_wp_error($terms) && $terms ? $terms[0]->name : '';

$location_terms = get_the_terms($property_id, 'property_location');
$locations = !is_wp_error($location_terms) && $location_terms ? $location_terms : array();
?>

<main id="primary" class="site-main single-property">

  <!-- Property Header -->
  <section class="property-header" style="padding: 2rem 0; border-bottom: 1px solid var(--color-border);">
    <div class="container">
      <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
        <div>
          <h1 style="font-size: var(--font-size-4xl); color: var(--color-text-primary); margin-bottom: 0.5rem;">
            <?php the_title(); ?>
          </h1>
          <div class="property-header__meta" style="display: flex; align-items: center; gap: 1rem; color: var(--color-text-secondary);">
            <?php if ($address) : ?>
              <span style="display: flex; align-items: center; gap: 0.25rem;">
                <?php echo estatein_get_icon('location', 16); ?>
                <?php echo esc_html($address); ?>
              </span>
            <?php endif; ?>
            <?php if ($property_type) : ?>
              <span class="property-type" style="background: var(--color-bg-tertiary); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem;">
                <?php echo esc_html($property_type); ?>
              </span>
            <?php endif; ?>
            <span class="property-status property-status--<?php echo esc_attr($status); ?>" style="text-transform: uppercase; font-weight: 600; color: var(--color-accent-primary);">
              <?php echo esc_html($status); ?>
            </span>
          </div>
        </div>
        <div class="property-header__price">
          <?php echo estatein_format_price($price); ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Property Gallery -->
  <?php if ($gallery && is_array($gallery)) : ?>
    <section class="property-gallery" style="padding: var(--spacing-3xl) 0;">
      <div class="container">
        <div class="property-gallery__main" style="position: relative; margin-bottom: 1rem;">
          <?php
          $first_image = wp_get_attachment_image_src($gallery[0], 'large');
          if ($first_image) :
          ?>
            <img src="<?php echo esc_url($first_image[0]); ?>" alt="<?php the_title(); ?>" style="width: 100%; height: 500px; object-fit: cover; border-radius: var(--border-radius-xl);">
          <?php endif; ?>
        </div>
        <?php if (count($gallery) > 1) : ?>
          <div class="property-gallery__thumbs" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem;">
            <?php foreach (array_slice($gallery, 1, 5) as $image_id) :
              $thumb = wp_get_attachment_image_src($image_id, 'thumbnail');
              if ($thumb) :
            ?>
              <img src="<?php echo esc_url($thumb[0]); ?>" alt="" style="width: 100%; height: 80px; object-fit: cover; border-radius: var(--border-radius-md); cursor: pointer;">
            <?php endif; endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- Property Details -->
  <section class="property-details" style="padding: var(--spacing-3xl) 0; background: var(--color-bg-secondary);">
    <div class="container">
      <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">

        <!-- Main Column -->
        <div class="property-main">
          <!-- Quick Stats -->
          <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2rem; padding: 1.5rem; background: var(--color-bg-tertiary); border-radius: var(--border-radius-xl);">
            <?php if ($bedrooms) : ?>
              <div style="text-align: center;">
                <div style="display: flex; justify-content: center; align-items: center; height: 48px; margin-bottom: 0.5rem; color: var(--color-accent-primary);">
                  <?php echo estatein_get_icon('bed', 32); ?>
                </div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--color-text-primary);"><?php echo esc_html($bedrooms); ?></div>
                <div style="font-size: 0.875rem; color: var(--color-text-tertiary);">Bedrooms</div>
              </div>
            <?php endif; ?>
            <?php if ($bathrooms) : ?>
              <div style="text-align: center;">
                <div style="display: flex; justify-content: center; align-items: center; height: 48px; margin-bottom: 0.5rem; color: var(--color-accent-primary);">
                  <?php echo estatein_get_icon('bath', 32); ?>
                </div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--color-text-primary);"><?php echo esc_html($bathrooms); ?></div>
                <div style="font-size: 0.875rem; color: var(--color-text-tertiary);">Bathrooms</div>
              </div>
            <?php endif; ?>
            <?php if ($sqft) : ?>
              <div style="text-align: center;">
                <div style="display: flex; justify-content: center; align-items: center; height: 48px; margin-bottom: 0.5rem; color: var(--color-accent-primary);">
                  <?php echo estatein_get_icon('sqft', 32); ?>
                </div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--color-text-primary);"><?php echo number_format($sqft); ?></div>
                <div style="font-size: 0.875rem; color: var(--color-text-tertiary);">Sq Ft</div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Description -->
          <div class="property-description" style="margin-bottom: 2rem;">
            <h3 style="font-size: var(--font-size-2xl); color: var(--color-text-primary); margin-bottom: 1rem;">Description</h3>
            <div style="color: var(--color-text-secondary); line-height: var(--line-height-relaxed);">
              <?php the_content(); ?>
            </div>
          </div>

          <!-- Features -->
          <?php
          $features = get_the_terms($property_id, 'property_feature');
          if ($features && !is_wp_error($features)) :
          ?>
            <div class="property-features" style="margin-bottom: 2rem;">
              <h3 style="font-size: var(--font-size-2xl); color: var(--color-text-primary); margin-bottom: 1rem;">Features</h3>
              <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                <?php foreach ($features as $feature) : ?>
                  <span style="background: var(--color-bg-tertiary); padding: 0.5rem 1rem; border-radius: var(--border-radius-full); font-size: 0.875rem; color: var(--color-text-secondary);">
                    <?php echo esc_html($feature->name); ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>

          <!-- Location -->
          <?php if ($locations) : ?>
            <div class="property-location">
              <h3 style="font-size: var(--font-size-2xl); color: var(--color-text-primary); margin-bottom: 1rem;">Location</h3>
              <div style="color: var(--color-text-secondary);">
                <?php
                $location_names = wp_list_pluck($locations, 'name');
                echo esc_html(implode(', ', $location_names));
                ?>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="property-sidebar">
          <!-- Agent Card -->
          <div style="background: var(--color-bg-tertiary); padding: 1.5rem; border-radius: var(--border-radius-xl); margin-bottom: 2rem;">
            <h4 style="margin-bottom: 1rem; color: var(--color-text-primary);">Interested in this property?</h4>
            <p style="color: var(--color-text-secondary); margin-bottom: 1.5rem;">
              Contact us for more information or to schedule a viewing.
            </p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary" style="width: 100%;">
              Contact Us
            </a>
          </div>

          <!-- Property Info -->
          <div style="background: var(--color-bg-tertiary); padding: 1.5rem; border-radius: var(--border-radius-xl);">
            <h4 style="margin-bottom: 1rem; color: var(--color-text-primary);">Property Details</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
              <div>
                <div style="color: var(--color-text-tertiary); font-size: 0.875rem;">Price</div>
                <div style="color: var(--color-text-primary); font-weight: 600;"><?php echo estatein_format_price($price); ?></div>
              </div>
              <div>
                <div style="color: var(--color-text-tertiary); font-size: 0.875rem;">Status</div>
                <div style="color: var(--color-text-primary); font-weight: 600; text-transform: capitalize;"><?php echo esc_html($status); ?></div>
              </div>
              <div>
                <div style="color: var(--color-text-tertiary); font-size: 0.875rem;">Bedrooms</div>
                <div style="color: var(--color-text-primary); font-weight: 600;"><?php echo esc_html($bedrooms ? $bedrooms : 'N/A'); ?></div>
              </div>
              <div>
                <div style="color: var(--color-text-tertiary); font-size: 0.875rem;">Bathrooms</div>
                <div style="color: var(--color-text-primary); font-weight: 600;"><?php echo esc_html($bathrooms ? $bathrooms : 'N/A'); ?></div>
              </div>
              <div>
                <div style="color: var(--color-text-tertiary); font-size: 0.875rem;">Area</div>
                <div style="color: var(--color-text-primary); font-weight: 600;"><?php echo $sqft ? number_format($sqft) . ' sqft' : 'N/A'; ?></div>
              </div>
              <?php if ($property_type) : ?>
                <div>
                  <div style="color: var(--color-text-tertiary); font-size: 0.875rem;">Type</div>
                  <div style="color: var(--color-text-primary); font-weight: 600;"><?php echo esc_html($property_type); ?></div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <!-- Virtual Tour / Video -->
  <?php if ($video_url || $virtual_tour) : ?>
    <section class="property-media" style="padding: var(--spacing-3xl) 0;">
      <div class="container">
        <h3 style="font-size: var(--font-size-2xl); color: var(--color-text-primary); margin-bottom: 1.5rem;">Virtual Tour</h3>
        <?php if ($video_url) : ?>
          <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: var(--border-radius-xl); margin-bottom: 1rem;">
            <iframe src="<?php echo esc_url($video_url); ?>"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                    allowfullscreen>
            </iframe>
          </div>
        <?php endif; ?>
        <?php if ($virtual_tour) : ?>
          <a href="<?php echo esc_url($virtual_tour); ?>" target="_blank" class="btn btn-secondary">
            Take Virtual Tour
            <?php echo estatein_get_icon('external-link', 18); ?>
          </a>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
