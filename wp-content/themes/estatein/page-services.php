<?php
/**
 * Template Name: Services Page
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="services-page">

  <?php get_template_part('sections/services/hero'); ?>
  <?php get_template_part('sections/services/unlock-value'); ?>
  <?php get_template_part('sections/services/effortless-management'); ?>
  <?php get_template_part('sections/services/investments'); ?>
  <?php get_template_part('sections/cta'); ?>

</main>

<?php get_footer(); ?>
