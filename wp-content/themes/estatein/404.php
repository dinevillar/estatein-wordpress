<?php
/**
 * 404 Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main" style="min-height: 60vh; display: flex; align-items: center;">

  <section class="error-404" style="padding: var(--spacing-4xl) 0; width: 100%;">
    <div class="container" style="text-align: center;">
      <h1 class="error-404__title" style="font-size: 8rem; font-weight: 700; color: var(--color-accent-primary); line-height: 1; margin-bottom: var(--spacing-md);">
        404
      </h1>
      <h2 class="error-404__subtitle" style="font-size: var(--font-size-3xl); color: var(--color-text-primary); margin-bottom: var(--spacing-lg);">
        Page Not Found
      </h2>
      <p class="error-404__description" style="font-size: var(--font-size-lg); color: var(--color-text-secondary); margin-bottom: var(--spacing-2xl); max-width: 600px; margin-left: auto; margin-right: auto;">
        The page you're looking for doesn't exist or has been moved. Let's get you back on track.
      </p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
        <?php echo estatein_get_icon('home', 18); ?>
        Back to Home
      </a>
    </div>
  </section>

</main>

<?php
get_footer();
