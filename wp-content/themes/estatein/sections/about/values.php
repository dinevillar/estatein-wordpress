<?php
/**
 * About Us - Our Values Section
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

$values = [
  [
    'icon' => 'shield-check',
    'heading' => 'Trust',
    'text' => 'Trust is the cornerstone of every successful real estate transaction.',
  ],
  [
    'icon' => 'star',
    'heading' => 'Excellence',
    'text' => 'We set the bar high for ourselves. From the properties we list to the services we provide.',
  ],
  [
    'icon' => 'heart',
    'heading' => 'Client-Centric',
    'text' => 'Your dreams and needs are at the center of our universe. We listen, understand.',
  ],
  [
    'icon' => 'handshake',
    'heading' => 'Our Commitment',
    'text' => 'We are dedicated to providing you with the highest level of service, professionalism, and support.',
  ],
];
?>
<section class="about-values" id="our-values">
  <div class="container">
    <div class="about-values__inner">

      <!-- Left: Section Header -->
      <div class="about-values__header">
        <div class="section-star-decor" aria-hidden="true">
          <span class="star-dot star-dot--lg"></span>
          <span class="star-dot star-dot--md"></span>
          <span class="star-dot star-dot--sm"></span>
        </div>
        <h2 class="about-values__heading">Our Values</h2>
        <p class="about-values__paragraph">Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.</p>
      </div>

      <!-- Right: 2x2 Values Grid -->
      <div class="about-values__grid-wrap">
        <div class="about-values__row">
          <?php foreach (array_slice($values, 0, 2) as $i => $value) : ?>
          <div class="about-values__item">
            <div class="about-values__item-header">
              <div class="about-values__icon-wrap">
                <?php echo estatein_about_icon($value['icon']); ?>
              </div>
              <h3 class="about-values__item-heading"><?php echo esc_html($value['heading']); ?></h3>
            </div>
            <p class="about-values__item-text"><?php echo esc_html($value['text']); ?></p>
          </div>
          <?php if ($i === 0) : ?>
          <div class="about-values__divider about-values__divider--vertical" aria-hidden="true"></div>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>

        <div class="about-values__divider about-values__divider--horizontal" aria-hidden="true"></div>

        <div class="about-values__row">
          <?php foreach (array_slice($values, 2, 2) as $i => $value) : ?>
          <div class="about-values__item">
            <div class="about-values__item-header">
              <div class="about-values__icon-wrap">
                <?php echo estatein_about_icon($value['icon']); ?>
              </div>
              <h3 class="about-values__item-heading"><?php echo esc_html($value['heading']); ?></h3>
            </div>
            <p class="about-values__item-text"><?php echo esc_html($value['text']); ?></p>
          </div>
          <?php if ($i === 0) : ?>
          <div class="about-values__divider about-values__divider--vertical" aria-hidden="true"></div>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>
