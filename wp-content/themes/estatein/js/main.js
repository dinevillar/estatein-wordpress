/**
 * Main JavaScript
 *
 * @package EstateIn
 */

(function() {
  'use strict';

  // DOM ready
  document.addEventListener('DOMContentLoaded', function() {
    initMobileMenu();
    initSmoothScroll();
    initSearchForm();
    initTestimonialSlider();
    initScrollAnimations();
  });

  /**
   * Mobile Navigation Toggle
   */
  function initMobileMenu() {
    const toggle = document.querySelector('.header__mobile-toggle');
    const navLinks = document.querySelector('.header__nav-links');
    const bannerClose = document.querySelector('.header__banner-close');

    if (!toggle || !navLinks) return;

    // Toggle menu
    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      navLinks.classList.toggle('active');
      toggle.setAttribute('aria-expanded', navLinks.classList.contains('active'));
    });

    // Close menu on link click
    navLinks.querySelectorAll('.header__nav-link').forEach(function(link) {
      link.addEventListener('click', function() {
        navLinks.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });

    // Close banner
    if (bannerClose) {
      bannerClose.addEventListener('click', function() {
        const banner = document.querySelector('.header__banner');
        if (banner) {
          banner.style.display = 'none';
        }
      });
    }
  }

  /**
   * Smooth Scrolling for anchor links
   */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
      anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;

        e.preventDefault();
        const target = document.querySelector(href);

        if (target) {
          const headerHeight = document.querySelector('.header') ? document.querySelector('.header').offsetHeight : 0;
          const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  /**
   * Hero Search Form
   */
  function initSearchForm() {
    const form = document.getElementById('property-search-form');
    if (!form) return;

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(form);
      const params = new URLSearchParams();

      if (formData.get('location')) params.append('location', formData.get('location'));
      if (formData.get('property_type')) params.append('property_type', formData.get('property_type'));

      // Redirect to properties page with query parameters
      let url = '<?php echo esc_url(get_post_type_archive_link('property')); ?>';
      if (params.toString()) {
        url += '?' + params.toString();
      }
      window.location.href = url;
    });
  }

  /**
   * Testimonial Slider (Simple implementation)
   */
  function initTestimonialSlider() {
    const grid = document.querySelector('.testimonials__grid');
    const prevBtn = document.querySelector('.testimonial-prev');
    const nextBtn = document.querySelector('.testimonial-next');

    if (!grid || !prevBtn || !nextBtn) return;

    const cards = grid.querySelectorAll('.testimonial-card');
    if (cards.length <= 3) return;

    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth;
    const gap = 32; // Equivalent to var(--spacing-2xl) in pixels

    function updateSlider() {
      const offset = -(currentIndex * (cardWidth + gap));
      grid.style.transform = 'translateX(' + offset + 'px)';
      grid.style.transition = 'transform 0.5s ease';
    }

    prevBtn.addEventListener('click', function() {
      if (currentIndex > 0) {
        currentIndex--;
        updateSlider();
      }
    });

    nextBtn.addEventListener('click', function() {
      if (currentIndex < cards.length - 3) {
        currentIndex++;
        updateSlider();
      }
    });

    // Reset on window resize
    window.addEventListener('resize', function() {
      const newCardWidth = cards[0].offsetWidth;
      if (newCardWidth !== cardWidth) {
        updateSlider();
      }
    });
  }

  /**
   * Scroll Animations
   */
  function initScrollAnimations() {
    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observe sections
    document.querySelectorAll('section').forEach(function(section) {
      observer.observe(section);
    });

    // Observe cards
    document.querySelectorAll('.property-card, .testimonial-card, .service-card').forEach(function(card) {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(card);
    });
  }

  // Add visible class styles dynamically
  const style = document.createElement('style');
  style.textContent = '.is-visible { opacity: 1 !important; transform: translateY(0) !important; }';
  document.head.appendChild(style);

})();
