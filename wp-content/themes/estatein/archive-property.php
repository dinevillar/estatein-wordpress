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

<main id="primary" class="site-main properties-page">

  <!-- Hero Section -->
  <section class="properties-hero">
    <div class="container">
      <div class="properties-hero__content">
        <h1 class="properties-hero__title">Find Your Dream Property</h1>
        <p class="properties-hero__desc">Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. With categories to suit every lifestyle, your journey</p>
      </div>
    </div>
  </section>

  <!-- Search/Filter Bar -->
  <section class="properties-search-section">
    <div class="container">
      <div class="properties-search">
        <form id="property-search-form" method="GET" action="<?php echo esc_url(get_post_type_archive_link('property')); ?>">
          <div class="properties-search__inputs">
            
            <div class="properties-search__field">
              <span class="properties-search__icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </span>
              <input type="text" name="location" placeholder="Location" class="properties-search__input" value="<?php echo esc_attr($_GET['location'] ?? ''); ?>">
            </div>

            <div class="properties-search__field">
              <span class="properties-search__icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="22" x2="9" y2="22.01"/><line x1="15" y1="22" x2="15" y2="22.01"/><line x1="12" y1="22" x2="12" y2="22.01"/><line x1="12" y1="2" x2="12" y2="22"/><line x1="4" y1="10" x2="20" y2="10"/><line x1="4" y1="14" x2="20" y2="14"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
              </span>
              <select name="property_type" class="properties-search__input">
                <option value="">Property Type</option>
                <option value="villa" <?php selected($_GET['property_type'] ?? '', 'villa'); ?>>Villa</option>
                <option value="apartment" <?php selected($_GET['property_type'] ?? '', 'apartment'); ?>>Apartment</option>
                <option value="townhouse" <?php selected($_GET['property_type'] ?? '', 'townhouse'); ?>>Townhouse</option>
              </select>
            </div>

            <div class="properties-search__field">
              <span class="properties-search__icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              </span>
              <select name="price_range" class="properties-search__input">
                <option value="">Pricing Range</option>
                <option value="0-500000" <?php selected($_GET['price_range'] ?? '', '0-500000'); ?>>Under $500,000</option>
                <option value="500000-1000000" <?php selected($_GET['price_range'] ?? '', '500000-1000000'); ?>>$500,000 - $1,000,000</option>
                <option value="1000000+" <?php selected($_GET['price_range'] ?? '', '1000000+'); ?>>Over $1,000,000</option>
              </select>
            </div>

            <div class="properties-search__field">
              <span class="properties-search__icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 3h18v18H3z"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/></svg>
              </span>
              <select name="property_size" class="properties-search__input">
                <option value="">Property Size</option>
                <option value="small" <?php selected($_GET['property_size'] ?? '', 'small'); ?>>Small</option>
                <option value="medium" <?php selected($_GET['property_size'] ?? '', 'medium'); ?>>Medium</option>
                <option value="large" <?php selected($_GET['property_size'] ?? '', 'large'); ?>>Large</option>
              </select>
            </div>

            <div class="properties-search__field">
              <span class="properties-search__icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              </span>
              <select name="build_year" class="properties-search__input">
                <option value="">Build Year</option>
                <option value="2020+" <?php selected($_GET['build_year'] ?? '', '2020+'); ?>>2020+</option>
                <option value="2010-2020" <?php selected($_GET['build_year'] ?? '', '2010-2020'); ?>>2010 - 2020</option>
                <option value="pre-2010" <?php selected($_GET['build_year'] ?? '', 'pre-2010'); ?>>Before 2010</option>
              </select>
            </div>

          </div>
          
          <button type="submit" class="properties-search__btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Find Property
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- Properties Grid Section -->
  <section class="properties-listing-section">
    <div class="container">
      <!-- Section Header -->
      <div class="section-header">
        <div class="section-header__text">
          <h2 class="section-header__title">Discover a World of Possibilities</h2>
          <p class="section-header__subtitle">
            Our portfolio of properties is as diverse as your dreams. Explore the following categories to find the perfect property that resonates with your vision of home
          </p>
        </div>
      </div>

      <div class="properties__cards">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post();
              $property_id = get_the_ID();
              $price       = get_post_meta($property_id, 'property_price', true);
              $bedrooms    = get_post_meta($property_id, 'property_bedrooms', true);
              $bathrooms   = get_post_meta($property_id, 'property_bathrooms', true);
              $sqft        = get_post_meta($property_id, 'property_sqft', true);
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
          <div class="no-properties">
            <p>No properties found matching your criteria.</p>
          </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
      </div>

      <!-- Pagination Nav -->
      <?php
      global $wp_query;
      $max_pages = $wp_query->max_num_pages;
      if ($max_pages > 1) {
          $current_page = max(1, get_query_var('paged'));
          ?>
          <div class="section-nav">
            <p class="section-nav__count">
              <span class="text-white"><?php echo str_pad($current_page, 2, '0', STR_PAD_LEFT); ?></span> of <?php echo str_pad($max_pages, 2, '0', STR_PAD_LEFT); ?>
            </p>
            <div class="section-nav__buttons">
              <?php if ($current_page > 1) : ?>
                <a href="<?php echo get_pagenum_link($current_page - 1); ?>" class="section-nav__btn" aria-label="Previous properties">
                  <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                </a>
              <?php endif; ?>
              
              <?php if ($current_page < $max_pages) : ?>
                <a href="<?php echo get_pagenum_link($current_page + 1); ?>" class="section-nav__btn section-nav__btn--active" aria-label="Next properties">
                  <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </a>
              <?php endif; ?>
            </div>
          </div>
          <?php
      }
      ?>

    </div>
  </section>

  <!-- Let's Make It Happen Form Section -->
  <section class="properties-inquiry-section">
    <div class="container">
      <div class="section-header">
        <div class="section-header__text">
          <h2 class="section-header__title">Let's Make it Happen</h2>
          <p class="section-header__subtitle">
            Ready to take the first step toward your dream property? Fill out the form below, and our real estate wizards will reach out to you with personalized opportunities and expert advice.
          </p>
        </div>
      </div>

      <div class="inquiry-form-wrapper">
        <form class="inquiry-form" action="#" method="POST">
          <div class="inquiry-form__row">
            <div class="inquiry-form__group">
              <label for="first_name">First Name</label>
              <input type="text" id="first_name" name="first_name" placeholder="Enter First Name">
            </div>
            <div class="inquiry-form__group">
              <label for="last_name">Last Name</label>
              <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name">
            </div>
            <div class="inquiry-form__group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Enter your Email">
            </div>
            <div class="inquiry-form__group">
              <label for="phone">Phone</label>
              <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number">
            </div>
          </div>

          <div class="inquiry-form__row">
            <div class="inquiry-form__group">
              <label for="inquiry_location">Preferred Location</label>
              <div class="inquiry-form__select-wrap">
                <select id="inquiry_location" name="inquiry_location">
                  <option value="">Select Location</option>
                  <option value="ny">New York</option>
                  <option value="la">Los Angeles</option>
                  <option value="mi">Miami</option>
                </select>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
              </div>
            </div>
            <div class="inquiry-form__group">
              <label for="inquiry_type">Property Type</label>
              <div class="inquiry-form__select-wrap">
                <select id="inquiry_type" name="inquiry_type">
                  <option value="">Select Property Type</option>
                  <option value="villa">Villa</option>
                  <option value="apartment">Apartment</option>
                </select>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
              </div>
            </div>
            <div class="inquiry-form__group">
              <label for="inquiry_bathrooms">No. of Bathrooms</label>
              <div class="inquiry-form__select-wrap">
                <select id="inquiry_bathrooms" name="inquiry_bathrooms">
                  <option value="">Select no. of Bathrooms</option>
                  <option value="1">1+</option>
                  <option value="2">2+</option>
                </select>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
              </div>
            </div>
            <div class="inquiry-form__group">
              <label for="inquiry_bedrooms">No. of Bedrooms</label>
              <div class="inquiry-form__select-wrap">
                <select id="inquiry_bedrooms" name="inquiry_bedrooms">
                  <option value="">Select no. of Bedrooms</option>
                  <option value="1">1+</option>
                  <option value="2">2+</option>
                </select>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
              </div>
            </div>
          </div>

          <div class="inquiry-form__row inquiry-form__row--full">
            <div class="inquiry-form__group">
              <label for="budget">Budget</label>
              <div class="inquiry-form__select-wrap">
                <select id="budget" name="budget">
                  <option value="">Select Budget</option>
                  <option value="low">Under $500k</option>
                  <option value="high">Over $500k</option>
                </select>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
              </div>
            </div>
          </div>

          <div class="inquiry-form__row inquiry-form__row--full">
            <div class="inquiry-form__group">
              <label for="message">Message</label>
              <textarea id="message" name="message" rows="5" placeholder="Enter your Message here"></textarea>
            </div>
          </div>

          <div class="inquiry-form__footer">
            <label class="inquiry-form__checkbox-wrap">
              <input type="checkbox" name="agree_terms">
              <span class="inquiry-form__checkbox-custom"></span>
              <span class="inquiry-form__checkbox-label">I agree with Terms of Use and Privacy Policy</span>
            </label>
            <button type="submit" class="btn-primary">Send Your Message</button>
          </div>

        </form>
      </div>
    </div>
  </section>

</main><!-- #primary -->

<?php
get_footer();
