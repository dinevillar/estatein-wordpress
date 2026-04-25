<?php
/**
 * About Us - Our Valued Clients Section
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

$clients = [
  [
    'since' => 'Since 2019',
    'name' => 'ABC Corporation',
    'url' => '#',
    'domain' => 'Commercial Real Estate',
    'category' => 'Luxury Home Development',
    'quote' => "Estatein's expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs.",
  ],
  [
    'since' => 'Since 2018',
    'name' => 'GreenTech Enterprises',
    'url' => '#',
    'domain' => 'Commercial Real Estate',
    'category' => 'Retail Space',
    'quote' => "Estatein's ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth.",
  ],
];
?>
<section class="about-clients" id="our-clients">
  <div class="container">
    <div class="about-clients__header">
      <div class="section-star-decor" aria-hidden="true">
        <span class="star-dot star-dot--lg"></span>
        <span class="star-dot star-dot--md"></span>
        <span class="star-dot star-dot--sm"></span>
      </div>
      <h2 class="about-clients__heading">Our Valued Clients</h2>
      <p class="about-clients__paragraph">At Estatein, we have had the privilege of working with a diverse range of clients across various industries. Here are some of the clients we've had the pleasure of serving</p>
    </div>

    <div class="about-clients__grid">
      <?php foreach ($clients as $client) : ?>
      <div class="about-clients__card">
        <div class="about-clients__card-top">
          <div class="about-clients__card-info">
            <p class="about-clients__card-since"><?php echo esc_html($client['since']); ?></p>
            <h3 class="about-clients__card-name"><?php echo esc_html($client['name']); ?></h3>
          </div>
          <a href="<?php echo esc_url($client['url']); ?>" class="btn-secondary btn-sm">Visit Website</a>
        </div>

        <div class="about-clients__details">
          <div class="about-clients__detail">
            <div class="about-clients__detail-label">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
              <span>Domain</span>
            </div>
            <p class="about-clients__detail-value"><?php echo esc_html($client['domain']); ?></p>
          </div>
          
          <div class="about-clients__divider" aria-hidden="true"></div>

          <div class="about-clients__detail">
            <div class="about-clients__detail-label">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
              <span>Category</span>
            </div>
            <p class="about-clients__detail-value"><?php echo esc_html($client['category']); ?></p>
          </div>
        </div>

        <div class="about-clients__quote-box">
          <p class="about-clients__quote-label">What They Said 🤗</p>
          <p class="about-clients__quote-text"><?php echo esc_html($client['quote']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Pagination/Slider Nav -->
    <div class="section-nav">
      <p class="section-nav__count"><span class="text-white">01</span> of 10</p>
      <div class="section-nav__buttons">
        <button class="section-nav__btn" aria-label="Previous">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </button>
        <button class="section-nav__btn section-nav__btn--active" aria-label="Next">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>
