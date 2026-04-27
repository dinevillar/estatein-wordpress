<?php
/**
 * About Us - Navigating the Estatein Experience (6 Steps)
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

$steps = [
  [
    'number' => 'Step 01',
    'heading' => 'Discover a World of Possibilities',
    'text' => 'Your journey begins with exploring our carefully curated property listings. Use our intuitive search tools to filter properties based on your preferences, including location, type, size, and budget.',
  ],
  [
    'number' => 'Step 02',
    'heading' => 'Narrowing Down Your Choices',
    'text' => "Once you've found properties that catch your eye, save them to your account or make a shortlist. This allows you to compare and revisit your favorites as you make your decision.",
  ],
  [
    'number' => 'Step 03',
    'heading' => 'Personalized Guidance',
    'text' => 'Have questions about a property or need more information? Our dedicated team of real estate experts is just a call or message away.',
  ],
  [
    'number' => 'Step 04',
    'heading' => 'See It for Yourself',
    'text' => "Arrange viewings of the properties you're interested in. We'll coordinate with the property owners and accompany you to ensure you get a firsthand look at your potential new home.",
  ],
  [
    'number' => 'Step 05',
    'heading' => 'Making Informed Decisions',
    'text' => 'Before making an offer, our team will assist you with due diligence, including property inspections, legal checks, and market analysis. We want you to be fully informed and confident in your choice.',
  ],
  [
    'number' => 'Step 06',
    'heading' => 'Getting the Best Deal',
    'text' => "We'll help you negotiate the best terms and prepare your offer. Our goal is to secure the property at the right price and on favorable terms.",
  ],
];
?>
<section class="about-experience" id="estatein-experience">
  <div class="container">
    <div class="about-experience__header">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/abstract-design.svg'); ?>" alt="Abstract Design" class="section-star-decor">
      <h2 class="about-experience__heading">Navigating the Estatein Experience</h2>
      <p class="about-experience__paragraph">At Estatein, we've designed a straightforward process to help you find and purchase your dream property with ease. Here's a step-by-step guide to how it all works.</p>
    </div>

    <div class="about-experience__steps">
      <div class="about-experience__row">
        <?php foreach (array_slice($steps, 0, 3) as $step) : ?>
        <div class="about-experience__step">
          <div class="about-experience__step-label">
            <span><?php echo esc_html($step['number']); ?></span>
          </div>
          <div class="about-experience__step-card">
            <h3 class="about-experience__step-heading"><?php echo esc_html($step['heading']); ?></h3>
            <p class="about-experience__step-text"><?php echo esc_html($step['text']); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="about-experience__row">
        <?php foreach (array_slice($steps, 3, 3) as $step) : ?>
        <div class="about-experience__step">
          <div class="about-experience__step-label">
            <span><?php echo esc_html($step['number']); ?></span>
          </div>
          <div class="about-experience__step-card">
            <h3 class="about-experience__step-heading"><?php echo esc_html($step['heading']); ?></h3>
            <p class="about-experience__step-text"><?php echo esc_html($step['text']); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
