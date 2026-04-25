<?php
/**
 * About Us - Our Achievements Section
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

$achievements = [
  [
    'heading' => '3+ Years of Excellence',
    'text' => "With over 3 years in the industry, we've amassed a wealth of knowledge and experience, becoming a go-to resource for all things real estate.",
  ],
  [
    'heading' => 'Happy Clients',
    'text' => 'Our greatest achievement is the satisfaction of our clients. Their success stories fuel our passion for what we do.',
  ],
  [
    'heading' => 'Industry Recognition',
    'text' => "We've earned the respect of our peers and industry leaders, with accolades and awards that reflect our commitment to excellence.",
  ],
];
?>
<section class="about-achievements" id="our-achievements">
  <div class="container">
    <div class="about-achievements__header">
      <div class="section-star-decor" aria-hidden="true">
        <span class="star-dot star-dot--lg"></span>
        <span class="star-dot star-dot--md"></span>
        <span class="star-dot star-dot--sm"></span>
      </div>
      <h2 class="about-achievements__heading">Our Achievements</h2>
      <p class="about-achievements__paragraph">Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.</p>
    </div>

    <div class="about-achievements__cards">
      <?php foreach ($achievements as $achievement) : ?>
      <div class="about-achievements__card">
        <h3 class="about-achievements__card-heading"><?php echo esc_html($achievement['heading']); ?></h3>
        <p class="about-achievements__card-text"><?php echo esc_html($achievement['text']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
