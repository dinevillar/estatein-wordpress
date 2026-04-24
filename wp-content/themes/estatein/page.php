<?php
/**
 * Page Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">

  <section class="page-content" style="padding: var(--spacing-4xl) 0;">
    <div class="container" style="max-width: 800px;">
      <?php
      while (have_posts()) :
          the_post();
      ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="page-header" style="margin-bottom: var(--spacing-2xl);">
            <h1 class="page-title" style="font-size: var(--font-size-4xl); color: var(--color-text-primary);">
              <?php the_title(); ?>
            </h1>
          </header>

          <div class="page-content__body" style="color: var(--color-text-secondary); line-height: var(--line-height-relaxed); font-size: var(--font-size-lg);">
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  </section>

</main><!-- #primary -->

<?php
get_footer();
