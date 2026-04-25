<?php
/**
 * Template Name: About Us Page
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="about-page">

  <?php get_template_part('sections/about/hero'); ?>
  <?php get_template_part('sections/about/values'); ?>
  <?php get_template_part('sections/about/achievements'); ?>
  <?php get_template_part('sections/about/experience'); ?>
  <?php get_template_part('sections/about/team'); ?>
  <?php get_template_part('sections/about/clients'); ?>
  <?php get_template_part('sections/cta'); ?>

</main>

<?php get_footer(); ?>
