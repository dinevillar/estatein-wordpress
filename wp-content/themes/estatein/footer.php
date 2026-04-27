<?php
/**
 * Footer Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Footer -->
<footer class="footer">
  <div class="footer__main">
    <div class="container">
      <div class="footer__grid">

        <!-- Brand + Email Subscription -->
        <div class="footer__brand">
          <div class="footer__logo">
            <?php if (has_custom_logo()) : ?>
              <?php the_custom_logo(); ?>
            <?php else : ?>
              <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo-link">
                <span class="footer__logo-symbol">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" alt="Estatein Logo" class="footer__logo-img" width="32" height="32" />
                </span>
                <span class="footer__logo-text">Estatein</span>
              </a>
            <?php endif; ?>
          </div>
          <!-- Email Subscribe -->
          <div class="footer__subscribe">
            <div class="footer__email-input">
              <svg class="footer__email-icon" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
              </svg>
              <input type="email" placeholder="Enter Your Email" class="footer__email-field">
              <button class="footer__send-btn" aria-label="Subscribe">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Footer Columns -->
        <div class="footer__columns">
          <!-- Home -->
          <div class="footer__column">
            <h4 class="footer__column-label">Home</h4>
            <ul class="footer__links">
              <li><a href="<?php echo esc_url(home_url('/')); ?>#hero" class="footer__link">Hero Section</a></li>
              <li><a href="<?php echo esc_url(home_url('/')); ?>#features" class="footer__link">Features</a></li>
              <li><a href="<?php echo esc_url(home_url('/')); ?>#properties" class="footer__link">Properties</a></li>
              <li><a href="<?php echo esc_url(home_url('/')); ?>#testimonials" class="footer__link">Testimonials</a></li>
              <li><a href="<?php echo esc_url(home_url('/')); ?>#faq" class="footer__link">FAQ's</a></li>
            </ul>
          </div>

          <!-- About Us -->
          <div class="footer__column">
            <h4 class="footer__column-label">About Us</h4>
            <ul class="footer__links">
              <li><a href="#" class="footer__link">Our Story</a></li>
              <li><a href="#" class="footer__link">Our Works</a></li>
              <li><a href="#" class="footer__link">How It Works</a></li>
              <li><a href="#" class="footer__link">Our Team</a></li>
              <li><a href="#" class="footer__link">Our Clients</a></li>
            </ul>
          </div>

          <!-- Properties -->
          <div class="footer__column">
            <h4 class="footer__column-label">Properties</h4>
            <ul class="footer__links">
              <li><a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="footer__link">Portfolio</a></li>
              <li><a href="#" class="footer__link">Categories</a></li>
            </ul>
          </div>

          <!-- Services -->
          <div class="footer__column">
            <h4 class="footer__column-label">Services</h4>
            <ul class="footer__links">
              <li><a href="#" class="footer__link">Valuation Mastery</a></li>
              <li><a href="#" class="footer__link">Strategic Marketing</a></li>
              <li><a href="#" class="footer__link">Negotiation Wizardry</a></li>
              <li><a href="#" class="footer__link">Closing Success</a></li>
              <li><a href="#" class="footer__link">Property Management</a></li>
            </ul>
          </div>

          <!-- Contact Us -->
          <div class="footer__column">
            <h4 class="footer__column-label">Contact Us</h4>
            <ul class="footer__links">
              <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="footer__link">Contact Form</a></li>
              <li><a href="#" class="footer__link">Our Offices</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer__bottom">
    <div class="container">
      <div class="footer__bottom-inner">
        <div class="footer__bottom-left">
          <p class="footer__copyright">@<?php echo date('Y'); ?> Estatein. All Rights Reserved.</p>
          <a href="#" class="footer__terms">Terms &amp; Conditions</a>
        </div>
        <div class="footer__social">
          <!-- Facebook -->
          <a href="#" class="footer__social-btn" aria-label="Facebook">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
            </svg>
          </a>
          <!-- LinkedIn -->
          <a href="#" class="footer__social-btn" aria-label="LinkedIn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/>
              <rect x="2" y="9" width="4" height="12"/>
              <circle cx="4" cy="4" r="2"/>
            </svg>
          </a>
          <!-- Twitter/X -->
          <a href="#" class="footer__social-btn" aria-label="Twitter">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
            </svg>
          </a>
          <!-- YouTube -->
          <a href="#" class="footer__social-btn" aria-label="YouTube">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.4a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/>
              <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
