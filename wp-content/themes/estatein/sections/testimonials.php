<?php
/**
 * Testimonials Section Template Part
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

$testimonials = get_posts(array(
    'post_type'      => 'testimonial',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
));
?>

<section class="testimonials-section" id="testimonials">
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <div class="section-header__text">
        <h2 class="section-header__title">What Our <span class="text-accent">Clients Say</span></h2>
        <p class="section-header__subtitle">
          Read the success stories and heartfelt testimonials from our valued clients. Discover why they chose Estatein for their real estate needs.
        </p>
      </div>
      <a href="#" class="btn-outline">View All Testimonials</a>
    </div>

    <!-- Testimonials Cards -->
    <div class="testimonials__cards">
      <?php if ($testimonials) : ?>
        <?php foreach ($testimonials as $testimonial) :
            $rating      = get_post_meta($testimonial->ID, 'testimonial_rating', true) ?: 5;
            $author_name = get_post_meta($testimonial->ID, 'testimonial_author_name', true);
            $author_role = get_post_meta($testimonial->ID, 'testimonial_author_role', true);
            $has_thumb   = has_post_thumbnail($testimonial->ID);
        ?>
        <article class="testimonial-card">
          <!-- Stars -->
          <div class="testimonial-card__stars">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
              <span class="star<?php echo $i <= $rating ? ' star--filled' : ''; ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="<?php echo $i <= $rating ? '#FFD700' : 'none'; ?>" stroke="<?php echo $i <= $rating ? '#FFD700' : '#666'; ?>" stroke-width="1.5">
                  <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                </svg>
              </span>
            <?php endfor; ?>
          </div>

          <!-- Content -->
          <div class="testimonial-card__content">
            <h4 class="testimonial-card__heading"><?php echo esc_html(get_the_title($testimonial->ID)); ?></h4>
            <p class="testimonial-card__text"><?php echo wp_kses_post($testimonial->post_content); ?></p>
          </div>

          <!-- Author -->
          <div class="testimonial-card__author">
            <?php if ($has_thumb) : ?>
              <?php echo get_the_post_thumbnail($testimonial->ID, [60, 60], ['class' => 'testimonial-card__avatar']); ?>
            <?php else : ?>
              <div class="testimonial-card__avatar testimonial-card__avatar--placeholder">
                <?php echo esc_html(strtoupper(substr($author_name ?: 'U', 0, 1))); ?>
              </div>
            <?php endif; ?>
            <div class="testimonial-card__author-info">
              <p class="testimonial-card__name"><?php echo esc_html($author_name); ?></p>
              <?php if ($author_role) : ?>
                <p class="testimonial-card__location"><?php echo esc_html($author_role); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      <?php else : ?>
        <!-- Static testimonials matching Figma design -->
        <?php
        $static_testimonials = [
          ['title' => 'Exceptional Service!', 'text' => 'Our experience with Estatein was outstanding. Their team\'s dedication and professionalism made finding our dream home a breeze. Highly recommended!', 'name' => 'Wade Warren', 'location' => 'USA, California'],
          ['title' => 'Efficient and Reliable', 'text' => 'Estatein provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn\'t be happier with the results.', 'name' => 'Emelie Thomson', 'location' => 'USA, Florida'],
          ['title' => 'Trusted Advisors', 'text' => 'The Estatein team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!', 'name' => 'John Mans', 'location' => 'USA, Nevada'],
        ];
        foreach ($static_testimonials as $t) : ?>
        <article class="testimonial-card">
          <div class="testimonial-card__stars">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
              <span class="star star--filled">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="#FFD700" stroke="#FFD700" stroke-width="1.5">
                  <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                </svg>
              </span>
            <?php endfor; ?>
          </div>
          <div class="testimonial-card__content">
            <h4 class="testimonial-card__heading"><?php echo esc_html($t['title']); ?></h4>
            <p class="testimonial-card__text"><?php echo esc_html($t['text']); ?></p>
          </div>
          <div class="testimonial-card__author">
            <div class="testimonial-card__avatar testimonial-card__avatar--placeholder">
              <?php echo esc_html(strtoupper(substr($t['name'], 0, 1))); ?>
            </div>
            <div class="testimonial-card__author-info">
              <p class="testimonial-card__name"><?php echo esc_html($t['name']); ?></p>
              <p class="testimonial-card__location"><?php echo esc_html($t['location']); ?></p>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Pagination Nav -->
    <div class="section-nav">
      <p class="section-nav__count"><span class="text-white">01</span> of 10</p>
      <div class="section-nav__buttons">
        <button class="section-nav__btn testimonial-prev" aria-label="Previous testimonial">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </button>
        <button class="section-nav__btn section-nav__btn--active testimonial-next" aria-label="Next testimonial">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>
