<?php
/**
 * Search Results Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$search_query = get_search_query();
?>

<main id="primary" class="site-main">

  <section class="search-results" style="padding: var(--spacing-4xl) 0;">
    <div class="container">
      <div class="search-results__header" style="margin-bottom: var(--spacing-3xl);">
        <h2 class="search-results__title" style="font-size: var(--font-size-3xl); color: var(--color-text-primary);">
          Search Results for: <span class="hero__headline-accent">"<?php echo esc_html($search_query); ?>"</span>
        </h2>
        <p class="search-results__count" style="color: var(--color-text-secondary);">
          <?php
          global $wp_query;
          echo sprintf(_n('%d result found', '%d results found', $wp_query->found_posts, 'estatein'), $wp_query->found_posts);
          ?>
        </p>
      </div>

      <?php if (have_posts()) : ?>
        <div class="search-results__grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: var(--spacing-2xl);">

          <?php while (have_posts()) : the_post(); ?>
            <article class="search-result-card" style="background: var(--color-bg-secondary); border-radius: var(--border-radius-xl); overflow: hidden; border: 1px solid var(--color-border); transition: transform var(--transition-normal);">
              <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
                <?php if (has_post_thumbnail()) : ?>
                  <div style="height: 200px; overflow: hidden;">
                    <?php the_post_thumbnail('medium'); ?>
                  </div>
                <?php endif; ?>
                <div style="padding: 1.5rem;">
                  <h3 style="font-size: var(--font-size-xl); color: var(--color-text-primary); margin-bottom: 0.5rem;">
                    <?php the_title(); ?>
                  </h3>
                  <p style="color: var(--color-text-secondary); font-size: var(--font-size-sm);">
                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                  </p>
                  <div style="margin-top: 1rem; color: var(--color-accent-primary); font-weight: 600; font-size: var(--font-size-sm);">
                    View Details <?php echo estatein_get_icon('arrow-right', 16); ?>
                  </div>
                </div>
              </a>
            </article>
          <?php endwhile; ?>

        </div>

        <!-- Pagination -->
        <div class="search-results__pagination" style="margin-top: var(--spacing-3xl);">
          <?php
          the_posts_pagination(array(
              'mid_size' => 2,
              'prev_text' => '&laquo; Prev',
              'next_text' => 'Next &raquo;',
          ));
          ?>
        </div>

      <?php else : ?>
        <div class="no-results" style="text-align: center; padding: var(--spacing-4xl) 0;">
          <h3 style="font-size: var(--font-size-2xl); color: var(--color-text-primary); margin-bottom: var(--spacing-md);">
            No results found
          </h3>
          <p style="color: var(--color-text-secondary); margin-bottom: var(--spacing-2xl);">
            Try adjusting your search terms or browse our categories.
          </p>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
            Browse All Properties
          </a>
        </div>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php
get_footer();
