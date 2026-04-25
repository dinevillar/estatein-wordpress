<?php
/**
 * Template Name: Contact Page
 *
 * @package EstateIn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="primary" class="site-main page-contact">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		
		<!-- Hero Section -->
		<section class="contact-hero section-padding">
			<div class="container">
				<div class="contact-hero__content">
					<h1 class="contact-hero__title">Get in Touch with Estatein</h1>
					<p class="contact-hero__description">
						Welcome to Estatein's Contact Us page. We're here to assist you with any inquiries, requests, or feedback you may have. Whether you're looking to buy or sell a property, explore investment opportunities, or simply want to say hello, we'd love to hear from you. Fill out the form below, and our dedicated team will get back to you promptly.
					</p>
				</div>
				<div class="contact-hero__cards">
					<div class="contact-card">
						<div class="contact-card__icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
							</svg>
						</div>
						<p class="contact-card__text">info@estatein.com</p>
					</div>
					<div class="contact-card">
						<div class="contact-card__icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
							</svg>
						</div>
						<p class="contact-card__text">+1 (123) 456-7890</p>
					</div>
					<div class="contact-card">
						<div class="contact-card__icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
							</svg>
						</div>
						<p class="contact-card__text">Main Headquarters</p>
					</div>
					<div class="contact-card">
						<div class="contact-card__icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
						</div>
						<p class="contact-card__text">Social Profiles</p>
					</div>
				</div>
			</div>
		</section>

		<!-- Let's Connect Form Section -->
		<section class="contact-form-section section-padding">
			<div class="container">
				<div class="section-header">
					<h2 class="section-title">Let's Connect</h2>
					<p class="section-description">We're excited to connect with you and learn more about your real estate goals. Use the form below to get in touch with Estatein. Whether you're a prospective client, partner, or simply curious about our services, we're here to answer your questions and provide the assistance you need.</p>
				</div>
				<div class="contact-form-wrapper">
					<!-- Form Placeholder -->
					<form class="estatein-form">
						<div class="form-row">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="text" id="first_name" name="first_name" placeholder="Enter First Name">
							</div>
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" id="last_name" name="last_name" placeholder="Enter Last Name">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" id="email" name="email" placeholder="Enter your Email">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="tel" id="phone" name="phone" placeholder="Enter Phone Number">
							</div>
							<div class="form-group">
								<label for="inquiry">Inquiry Type</label>
								<select id="inquiry" name="inquiry">
									<option value="">Select Inquiry Type</option>
									<option value="buy">Buy Property</option>
									<option value="sell">Sell Property</option>
									<option value="rent">Rent Property</option>
								</select>
							</div>
							<div class="form-group">
								<label for="hear_about">How did you hear about us?</label>
								<select id="hear_about" name="hear_about">
									<option value="">Select</option>
									<option value="social">Social Media</option>
									<option value="friend">Friend / Family</option>
									<option value="search">Search Engine</option>
								</select>
							</div>
						</div>
						<div class="form-group full-width">
							<label for="message">Message</label>
							<textarea id="message" name="message" placeholder="Enter your Message"></textarea>
						</div>
						<div class="form-actions">
							<label class="checkbox-label">
								<input type="checkbox" name="agree">
								I agree with Terms of Use and Privacy Policy
							</label>
							<button type="submit" class="btn btn-primary">Send Your Message</button>
						</div>
					</form>
				</div>
			</div>
		</section>

		<!-- Office Locations Section -->
		<section class="office-locations section-padding">
			<div class="container">
				<div class="section-header">
					<h2 class="section-title">Discover Our Office Locations</h2>
					<p class="section-description">Estatein is here to serve you across multiple locations. Whether you're looking to meet our team, discuss real estate opportunities, or simply drop by for a chat, we have offices conveniently located to serve your needs. Explore our categories below to find the Estatein office nearest to you.</p>
				</div>
				
				<div class="tabs-container">
					<button class="tab-btn active">All</button>
					<button class="tab-btn">Regional</button>
					<button class="tab-btn">International</button>
				</div>

				<div class="locations-grid">
					<!-- Location Card 1 -->
					<div class="location-card">
						<div class="location-card__content">
							<span class="badge">Main Headquarters</span>
							<h3 class="location-card__title">123 Estatein Plaza, City Center, New York</h3>
							<p class="location-card__desc">Our main headquarters serve as the heart of Estatein's operations. Drop by to learn more about our services and meet our dedicated team.</p>
							
							<div class="location-card__contact">
								<div class="contact-item">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
									</svg>
									<span>info@estatein.com</span>
								</div>
								<div class="contact-item">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
									</svg>
									<span>+1 (123) 456-7890</span>
								</div>
								<div class="contact-item">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
										<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
									</svg>
									<span>New York, NY</span>
								</div>
							</div>
							<a href="#" class="btn btn-secondary full-width">Get Direction</a>
						</div>
					</div>

					<!-- Location Card 2 -->
					<div class="location-card">
						<div class="location-card__content">
							<span class="badge">Regional Office</span>
							<h3 class="location-card__title">456 Regional Blvd, Business Park, Los Angeles</h3>
							<p class="location-card__desc">Our regional office provides local expertise and tailored services to clients in the area. We're here to help with all your real estate needs.</p>
							
							<div class="location-card__contact">
								<div class="contact-item">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
									</svg>
									<span>info@estatein.com</span>
								</div>
								<div class="contact-item">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
									</svg>
									<span>+1 (123) 456-7890</span>
								</div>
								<div class="contact-item">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
										<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
									</svg>
									<span>Los Angeles, CA</span>
								</div>
							</div>
							<a href="#" class="btn btn-secondary full-width">Get Direction</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Gallery Section -->
		<section class="gallery-section section-padding">
			<div class="container">
				<!-- Add Gallery Implementation Here -->
				<div class="gallery-grid">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/property-placeholder.svg'); ?>" alt="Gallery Image" style="background:#1A1A1A; min-height:400px; width:100%; object-fit:contain; border-radius:12px;">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/property-placeholder.svg'); ?>" alt="Gallery Image" style="background:#1A1A1A; min-height:400px; width:100%; object-fit:contain; border-radius:12px;">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/property-placeholder.svg'); ?>" alt="Gallery Image" style="background:#1A1A1A; min-height:400px; width:100%; object-fit:contain; border-radius:12px;">
				</div>
			</div>
		</section>

		<?php
		// CTA Section
		get_template_part('components/cta');
		?>

	<?php endwhile; // End of the loop. ?>
</main>

<?php
get_footer();
