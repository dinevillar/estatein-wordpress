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

  <!-- Hero & Search Section -->
  <section class="properties-hero">
    <div class="container">
      <div class="properties-hero__content">
        <h1 class="properties-hero__title">Find Your Dream Property</h1>
        <p class="properties-hero__desc">Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. With categories to suit every lifestyle, your journey</p>
      </div>

      <div class="properties-search-wrapper">
        <form id="property-search-form" method="GET" action="<?php echo esc_url(get_post_type_archive_link('property')); ?>">
          <input type="hidden" name="post_type" value="property">
          <!-- Main Search Bar -->
          <div class="properties-search__main">
            <input type="text" name="s" placeholder="Search For A Property" class="properties-search__main-input" value="<?php echo esc_attr(get_search_query()); ?>">
            <button type="submit" class="properties-search__btn">
              <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
              </svg>
              Find Property
            </button>
          </div>

          <!-- Filters Bar -->
          <div class="properties-search__filters">
            <div class="properties-search__field">
              <span class="properties-search__icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                </svg>
              </span>
              <input type="text" name="location" placeholder="Location" class="properties-search__input" value="<?php echo esc_attr($_GET['location'] ?? ''); ?>">
            </div>

            <div class="properties-search__field">
              <span class="properties-search__icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                </svg>
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
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
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
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
                </svg>
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
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                </svg>
              </span>
              <select name="build_year" class="properties-search__input">
                <option value="">Build Year</option>
                <option value="2020+" <?php selected($_GET['build_year'] ?? '', '2020+'); ?>>2020+</option>
                <option value="2010-2020" <?php selected($_GET['build_year'] ?? '', '2010-2020'); ?>>2010 - 2020</option>
                <option value="pre-2010" <?php selected($_GET['build_year'] ?? '', 'pre-2010'); ?>>Before 2010</option>
              </select>
            </div>
          </div>
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
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/abstract-design.svg'); ?>" alt="Abstract Design" class="section-header__icon">
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
                  <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                  </svg>
                </a>
              <?php endif; ?>
              
              <?php if ($current_page < $max_pages) : ?>
                <a href="<?php echo get_pagenum_link($current_page + 1); ?>" class="section-nav__btn section-nav__btn--active" aria-label="Next properties">
                  <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                  </svg>
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
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/abstract-design.svg'); ?>" alt="Abstract Design" class="section-header__icon">
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
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
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
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
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
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
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
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
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
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
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
