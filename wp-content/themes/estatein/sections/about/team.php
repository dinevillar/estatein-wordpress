<?php
/**
 * About Us - Meet the Estatein Team Section
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

$team_members = [
  [
    'name' => 'Max Mitchell',
    'role' => 'Founder',
    'image' => get_template_directory_uri() . '/assets/images/team/team-1.jpg',
  ],
  [
    'name' => 'Sarah Johnson',
    'role' => 'Chief Real Estate Officer',
    'image' => get_template_directory_uri() . '/assets/images/team/team-2.jpg',
  ],
  [
    'name' => 'David Brown',
    'role' => 'Head of Property Management',
    'image' => get_template_directory_uri() . '/assets/images/team/team-3.jpg',
  ],
  [
    'name' => 'Michael Turner',
    'role' => 'Legal Counsel',
    'image' => get_template_directory_uri() . '/assets/images/team/team-4.jpg',
  ],
];
?>
<section class="about-team" id="meet-the-team">
  <div class="container">
    <div class="about-team__header">
      <div class="section-star-decor" aria-hidden="true">
        <span class="star-dot star-dot--lg"></span>
        <span class="star-dot star-dot--md"></span>
        <span class="star-dot star-dot--sm"></span>
      </div>
      <h2 class="about-team__heading">Meet the Estatein Team</h2>
      <p class="about-team__paragraph">At Estatein, our success is driven by the dedication and expertise of our team. Get to know the people behind our mission to make your real estate dreams a reality.</p>
    </div>

    <div class="about-team__grid">
      <?php foreach ($team_members as $member) : ?>
      <div class="about-team__card">
        <div class="about-team__image-wrap">
          <img
            src="<?php echo esc_url($member['image']); ?>"
            alt="<?php echo esc_attr($member['name']); ?>"
            class="about-team__image"
          >
          <!-- LinkedIn / social badge overlay -->
          <div class="about-team__badge" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <rect x="2" y="9" width="4" height="12" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="4" cy="4" r="2" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
        <div class="about-team__info">
          <div class="about-team__name-wrap">
            <p class="about-team__name"><?php echo esc_html($member['name']); ?></p>
            <p class="about-team__role"><?php echo esc_html($member['role']); ?></p>
          </div>
          <a href="mailto:hello@estatein.com" class="about-team__say-hello">
            <span>Say Hello 👋</span>
            <div class="about-team__say-hello-btn" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 2L11 13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
