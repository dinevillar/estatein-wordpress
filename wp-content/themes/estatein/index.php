<?php
/**
 * The main template file
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">

  <!-- Hero Section -->
  <?php get_template_part('sections/hero'); ?>

  <!-- Features Grid Section -->
  <?php get_template_part('sections/features'); ?>

  <!-- Featured Properties Section -->
  <?php get_template_part('sections/properties'); ?>

  <!-- Testimonials Section -->
  <?php get_template_part('sections/testimonials'); ?>

  <!-- FAQ Section -->
  <?php get_template_part('sections/faq'); ?>

  <!-- CTA Section -->
  <?php get_template_part('sections/cta'); ?>

</main><!-- #primary -->

<?php
get_footer();
