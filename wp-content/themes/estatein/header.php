<?php
/**
 * Header Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php wp_head(); ?>
</head>

<body <?php body_class('body'); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="header">
  <!-- Top Banner Bar -->
  <div class="header__banner">
    <div class="header__banner-inner">
      <span class="header__banner-text">
        ✨ Discover Your Dream Property with Estatein.
      </span>
      <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="header__banner-link">Learn More</a>
    </div>
    <button class="header__banner-close" aria-label="Close banner">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
  </div>

   <!-- Navigation Bar -->
   <nav class="header__nav" role="navigation" aria-label="Main navigation">
     <!-- Logo -->
     <div class="header__logo">
       <?php if (has_custom_logo()) : ?>
         <?php the_custom_logo(); ?>
       <?php else : ?>
         <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo-link">
           <span class="header__logo-symbol">
             <svg width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
               <rect width="48" height="48" rx="8" fill="#703BF7"/>
               <path d="M24 8L8 20V40H20V28H28V40H40V20L24 8Z" fill="white"/>
             </svg>
           </span>
           <span class="header__logo-text">Estatein</span>
         </a>
       <?php endif; ?>
     </div>

     <!-- Mobile Toggle -->
     <button class="header__mobile-toggle" aria-label="Toggle navigation">
       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
         <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
       </svg>
     </button>

     <!-- Navigation Links (Centered) -->
     <?php
     wp_nav_menu(array(
       'theme_location' => 'primary',
       'menu_class' => 'header__nav-links',
       'menu_id' => 'primary-menu',
       'container' => false,
       'fallback_cb' => 'estatein_fallback_menu',
       'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
       'walker' => new EstateIn_Nav_Walker(),
     ));
     ?>

     <!-- CTA Button - Contact Us (Right Side) -->
     <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="header__cta-btn">
       Contact Us
     </a>
   </nav>
</header>

<!-- Fallback menu if no menu is set -->
<?php
function estatein_fallback_menu() {
    ?>
    <ul class="header__nav-links">
      <li class="current-menu-item"><a href="<?php echo esc_url(home_url('/')); ?>" class="header__nav-link current">Home</a></li>
      <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="header__nav-link">About Us</a></li>
      <li><a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="header__nav-link">Properties</a></li>
      <li><a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="header__nav-link">Services</a></li>
    </ul>
    <?php
}
?>
