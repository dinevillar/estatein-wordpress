<?php
/**
 * FAQ Section Template Part
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="faq-section" id="faq">
  <div class="container">
    <!-- Section Header -->
    <div class="faq__header">
      <div class="faq__header-text">
        <h2 class="faq__title">Frequently Asked <span class="text-accent">Questions</span></h2>
        <p class="faq__subtitle">
          Find answers to common questions about Estatein's services, property listings, and the real estate process. We're here to provide clarity and assist you every step of the way.
        </p>
      </div>
      <a href="<?php echo esc_url(get_permalink(get_page_by_path('faq'))); ?>" class="btn-outline">
        View All FAQ's
      </a>
    </div>

    <!-- FAQ Cards Grid -->
    <div class="faq__grid">
      <div class="faq-card">
        <h3 class="faq-card__question">How do I search for properties on Estatein?</h3>
        <p class="faq-card__answer">Learn how to use our user-friendly search tools to find properties that match your criteria.</p>
        <a href="#" class="faq-card__btn">Read More</a>
      </div>
      <div class="faq-card">
        <h3 class="faq-card__question">What documents do I need to sell my property through Estatein?</h3>
        <p class="faq-card__answer">Find out about the necessary documentation for listing your property with us.</p>
        <a href="#" class="faq-card__btn">Read More</a>
      </div>
      <div class="faq-card">
        <h3 class="faq-card__question">How can I contact an Estatein agent?</h3>
        <p class="faq-card__answer">Discover the different ways you can get in touch with our experienced agents.</p>
        <a href="#" class="faq-card__btn">Read More</a>
      </div>
    </div>

    <!-- Pagination Nav -->
    <div class="section-nav">
      <p class="section-nav__count"><span class="text-white">01</span> of 10</p>
      <div class="section-nav__buttons">
        <button class="section-nav__btn" aria-label="Previous FAQ">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </button>
        <button class="section-nav__btn section-nav__btn--active" aria-label="Next FAQ">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>
