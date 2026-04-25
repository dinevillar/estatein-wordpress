<?php
/**
 * Single Property Template
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$property_id = get_the_ID();
$price = get_post_meta($property_id, 'property_price', true);
$bedrooms = get_post_meta($property_id, 'property_bedrooms', true);
$bathrooms = get_post_meta($property_id, 'property_bathrooms', true);
$sqft = get_post_meta($property_id, 'property_sqft', true);
$status = get_post_meta($property_id, 'property_status', true);
$address = get_post_meta($property_id, 'property_address', true);
$video_url = get_post_meta($property_id, 'property_video', true);
$virtual_tour = get_post_meta($property_id, 'property_virtual_tour', true);
$gallery = get_post_meta($property_id, 'property_gallery', true);

$terms = get_the_terms($property_id, 'property_type');
$property_type = !is_wp_error($terms) && $terms ? $terms[0]->name : '';

$location_terms = get_the_terms($property_id, 'property_location');
$locations = !is_wp_error($location_terms) && $location_terms ? $location_terms : array();
?>

<main id="primary" class="site-main single-property" style="padding: 3rem 0;">

  <div class="container">
    <!-- Property Header -->
    <div class="property-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2.5rem;">
      <div class="property-title-location">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
          <h1 class="property-title" style="font-size: 1.875rem; color: var(--color-text-primary); font-weight: 600; margin: 0;">
            <?php the_title(); ?>
          </h1>
        </div>
        <?php if ($address) : ?>
          <div class="property-location" style="display: flex; align-items: center; gap: 0.5rem; border: 1px solid var(--color-border); padding: 0.5rem 1rem; border-radius: var(--border-radius-full); width: fit-content;">
            <div style="color: var(--color-text-primary); display: flex; align-items: center;">
              <?php echo estatein_get_icon('location', 20); ?>
            </div>
            <span style="color: var(--color-text-secondary);"><?php echo esc_html($address); ?></span>
          </div>
        <?php endif; ?>
      </div>
      <div class="property-price" style="text-align: right;">
        <span style="display: block; font-size: 1.125rem; color: var(--color-text-secondary); margin-bottom: 0.25rem;">Price</span>
        <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);"><?php echo estatein_format_price($price); ?></span>
      </div>
    </div>

    <!-- Property Gallery -->
    <?php if ($gallery && is_array($gallery)) : ?>
      <div class="property-gallery-container" style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); padding: 2.5rem; border-radius: var(--border-radius-xl); margin-bottom: 4rem;">
        <!-- Thumbnails Row -->
        <div class="property-gallery-thumbs" style="background: var(--color-bg-primary); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--border-radius-lg); display: flex; gap: 1.25rem; margin-bottom: 1.5rem; overflow-x: auto;">
          <?php foreach (array_slice($gallery, 0, 9) as $image_id) :
            $thumb = wp_get_attachment_image_src($image_id, 'thumbnail');
            if ($thumb) :
          ?>
            <img src="<?php echo esc_url($thumb[0]); ?>" alt="" style="width: 100px; height: 80px; object-fit: cover; border-radius: var(--border-radius-sm); cursor: pointer; flex-shrink: 0; border: 1px solid transparent; transition: border-color 0.3s ease;" onmouseover="this.style.borderColor='var(--color-accent-primary)'" onmouseout="this.style.borderColor='transparent'">
          <?php endif; endforeach; ?>
        </div>
        
        <!-- Main Images Row -->
        <div class="property-gallery-main" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
          <?php 
          $main_img_1 = isset($gallery[0]) ? wp_get_attachment_image_src($gallery[0], 'large') : false;
          $main_img_2 = isset($gallery[1]) ? wp_get_attachment_image_src($gallery[1], 'large') : false;
          
          if ($main_img_1) : ?>
            <div style="border-radius: var(--border-radius-lg); overflow: hidden;">
              <img src="<?php echo esc_url($main_img_1[0]); ?>" alt="" style="width: 100%; height: 450px; object-fit: cover; display: block;">
            </div>
          <?php endif; ?>
          
          <?php if ($main_img_2) : ?>
            <div style="border-radius: var(--border-radius-lg); overflow: hidden;">
              <img src="<?php echo esc_url($main_img_2[0]); ?>" alt="" style="width: 100%; height: 450px; object-fit: cover; display: block;">
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

    <!-- Description and Features -->
    <div class="property-content-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 4rem;">
      
      <!-- Description Column -->
      <div class="property-description-card" style="border: 1px solid var(--color-border); border-radius: var(--border-radius-xl); padding: 2.5rem; display: flex; flex-direction: column;">
        <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary); margin-bottom: 1rem;">Description</h3>
        <div style="color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 2.5rem; flex-grow: 1;">
          <?php the_content(); ?>
        </div>
        
        <!-- Quick Stats -->
        <div class="property-quick-stats" style="display: flex; justify-content: space-between; border-top: 1px solid var(--color-border); padding-top: 1.5rem;">
          <?php if ($bedrooms) : ?>
          <div style="flex: 1; border-right: 1px solid var(--color-border); padding-right: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; color: var(--color-text-secondary);">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 7V21M22 7V21M2 17H22M4 7H20C21.1046 7 22 7.89543 22 9V17H2C2 17 2 9 2 9C2 7.89543 2.89543 7 4 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 11H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Bedrooms</span>
            </div>
            <div style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);"><?php echo sprintf('%02d', $bedrooms); ?></div>
          </div>
          <?php endif; ?>
          
          <?php if ($bathrooms) : ?>
          <div style="flex: 1; border-right: 1px solid var(--color-border); padding: 0 1rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; color: var(--color-text-secondary);">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 10C4 6.68629 6.68629 4 10 4H14C17.3137 4 20 6.68629 20 10V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 4V2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 4V2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 4V2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Bathrooms</span>
            </div>
            <div style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);"><?php echo sprintf('%02d', $bathrooms); ?></div>
          </div>
          <?php endif; ?>
          
          <?php if ($sqft) : ?>
          <div style="flex: 1; padding-left: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; color: var(--color-text-secondary);">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4H20C21.1046 4 22 4.89543 22 6V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V6C2 4.89543 2.89543 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 10H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Area</span>
            </div>
            <div style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);"><?php echo number_format($sqft); ?> Square Feet</div>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Features Column -->
      <div class="property-features-card" style="border: 1px solid var(--color-border); border-radius: var(--border-radius-xl); padding: 2.5rem;">
        <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary); margin-bottom: 1.5rem;">Key Features and Amenities</h3>
        <?php
        $features = get_the_terms($property_id, 'property_feature');
        if ($features && !is_wp_error($features)) :
        ?>
        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
          <?php foreach ($features as $feature) : ?>
            <div style="display: flex; align-items: center; gap: 0.75rem; background: var(--color-bg-tertiary); border-left: 3px solid var(--color-accent-primary); padding: 1rem 1.25rem; border-radius: 0 var(--border-radius-md) var(--border-radius-md) 0;">
              <div style="color: var(--color-text-primary);">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/>
                </svg>
              </div>
              <span style="color: var(--color-text-secondary); font-size: 1.125rem;"><?php echo esc_html($feature->name); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php else : ?>
          <p style="color: var(--color-text-secondary);">No features listed.</p>
        <?php endif; ?>
      </div>

    </div>

    <!-- Inquiry Form Section -->
    <div class="property-inquiry-section" style="display: grid; grid-template-columns: 1fr 2fr; gap: 3rem; margin-bottom: 5rem;">
      <div class="inquiry-content">
        <h2 style="font-size: 2.25rem; font-weight: 600; color: var(--color-text-primary); margin-bottom: 1rem;">Inquire About <?php echo esc_html(get_the_title()); ?></h2>
        <p style="color: var(--color-text-secondary); line-height: 1.6; font-size: 1.125rem;">
          Interested in this property? Fill out the form below, and our real estate experts will get back to you with more details, including scheduling a viewing and answering any questions you may have.
        </p>
      </div>
      
      <div class="inquiry-form-container" style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); border-radius: var(--border-radius-xl); padding: 3rem;">
        <form class="estatein-form" action="#">
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="form-group">
              <label style="display: block; color: var(--color-text-primary); font-weight: 500; margin-bottom: 0.75rem;">First Name</label>
              <input type="text" placeholder="Enter First Name" style="width: 100%; background: var(--color-bg-primary); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--border-radius-md); color: var(--color-text-primary);">
            </div>
            <div class="form-group">
              <label style="display: block; color: var(--color-text-primary); font-weight: 500; margin-bottom: 0.75rem;">Last Name</label>
              <input type="text" placeholder="Enter Last Name" style="width: 100%; background: var(--color-bg-primary); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--border-radius-md); color: var(--color-text-primary);">
            </div>
            <div class="form-group">
              <label style="display: block; color: var(--color-text-primary); font-weight: 500; margin-bottom: 0.75rem;">Email</label>
              <input type="email" placeholder="Enter your Email" style="width: 100%; background: var(--color-bg-primary); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--border-radius-md); color: var(--color-text-primary);">
            </div>
            <div class="form-group">
              <label style="display: block; color: var(--color-text-primary); font-weight: 500; margin-bottom: 0.75rem;">Phone</label>
              <input type="tel" placeholder="Enter Phone Number" style="width: 100%; background: var(--color-bg-primary); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--border-radius-md); color: var(--color-text-primary);">
            </div>
          </div>
          
          <div class="form-group" style="margin-bottom: 1.5rem;">
            <label style="display: block; color: var(--color-text-primary); font-weight: 500; margin-bottom: 0.75rem;">Selected Property</label>
            <div style="position: relative;">
              <input type="text" value="<?php echo esc_attr(get_the_title()); ?>, <?php echo esc_attr($address); ?>" readonly style="width: 100%; background: var(--color-bg-primary); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--border-radius-md); color: var(--color-text-primary);">
              <svg style="position: absolute; right: 1.25rem; top: 50%; transform: translateY(-50%); color: var(--color-text-secondary);" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
              </svg>
            </div>
          </div>
          
          <div class="form-group" style="margin-bottom: 2rem;">
            <label style="display: block; color: var(--color-text-primary); font-weight: 500; margin-bottom: 0.75rem;">Message</label>
            <textarea rows="4" placeholder="Enter your Message here.." style="width: 100%; background: var(--color-bg-primary); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--border-radius-md); color: var(--color-text-primary); resize: vertical;"></textarea>
          </div>
          
          <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <label style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary); cursor: pointer;">
              <input type="checkbox" style="width: 1.5rem; height: 1.5rem; accent-color: var(--color-accent-primary); border-radius: 4px; border: 1px solid var(--color-border); background: transparent;">
              <span>I agree with <a href="#" style="text-decoration: underline;">Terms of Use</a> and <a href="#" style="text-decoration: underline;">Privacy Policy</a></span>
            </label>
            <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.125rem;">Send Your Message</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Comprehensive Pricing Details Section -->
    <div class="property-pricing-details" style="margin-bottom: 5rem;">
      <div style="margin-bottom: 3rem;">
        <h2 style="font-size: 2.25rem; font-weight: 600; color: var(--color-text-primary); margin-bottom: 1rem;">Comprehensive Pricing Details</h2>
        <p style="color: var(--color-text-secondary); max-width: 900px; line-height: 1.6; font-size: 1.125rem;">
          At Estatein, transparency is key. We want you to have a clear understanding of all costs associated with your property investment. Below, we break down the pricing for <?php echo esc_html(get_the_title()); ?> to help you make an informed decision.
        </p>
      </div>

      <div style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); border-radius: var(--border-radius-md); padding: 1.5rem; display: flex; gap: 1.5rem; align-items: center; margin-bottom: 3rem;">
        <span style="font-weight: 600; color: var(--color-text-primary); border-right: 1px solid var(--color-border); padding-right: 1.5rem; font-size: 1.125rem;">Note</span>
        <span style="color: var(--color-text-secondary); font-size: 1.125rem;">The figures provided below are estimates and may vary depending on the property, location, and individual circumstances.</span>
      </div>

      <div style="display: grid; grid-template-columns: 250px 1fr; gap: 3rem;">
        <!-- Listing Price Sidebar -->
        <div>
          <div style="color: var(--color-text-secondary); margin-bottom: 0.5rem; font-weight: 500; font-size: 1.125rem;">Listing Price</div>
          <div style="font-size: 2.5rem; font-weight: 700; color: var(--color-text-primary);"><?php echo estatein_format_price($price); ?></div>
        </div>
        
        <!-- Pricing Tables Grid -->
        <div style="display: flex; flex-direction: column; gap: 3rem;">
          
          <!-- Additional Fees -->
          <div class="pricing-card" style="border: 1px solid var(--color-border); border-radius: var(--border-radius-xl); padding: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--color-border); padding-bottom: 1.5rem; margin-bottom: 2rem;">
              <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary); margin: 0;">Additional Fees</h3>
              <a href="#" class="btn btn-secondary" style="padding: 0.75rem 1.5rem; font-size: 1rem;">Learn More</a>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Property Transfer Tax</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$25,000</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Based on the sale price and local regulations</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Legal Fees</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$3,000</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Approximate cost for legal services, including title transfer</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Home Inspection</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$500</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Recommended for due diligence</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Property Insurance</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$1,200</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Annual cost for comprehensive property insurance</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Mortgage Fees</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">Varies</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">If applicable, consult with your lender for specific details</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Monthly Costs -->
          <div class="pricing-card" style="border: 1px solid var(--color-border); border-radius: var(--border-radius-xl); padding: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--color-border); padding-bottom: 1.5rem; margin-bottom: 2rem;">
              <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary); margin: 0;">Monthly Costs</h3>
              <a href="#" class="btn btn-secondary" style="padding: 0.75rem 1.5rem; font-size: 1rem;">Learn More</a>
            </div>
            <div style="display: grid; grid-template-columns: 1fr; gap: 3rem;">
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Property Taxes</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$1,250</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Approximate monthly property tax based on the sale price and local rates</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Homeowners' Association Fee</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$300</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Monthly fee for common area maintenance and security</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Total Initial Costs -->
          <div class="pricing-card" style="border: 1px solid var(--color-border); border-radius: var(--border-radius-xl); padding: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--color-border); padding-bottom: 1.5rem; margin-bottom: 2rem;">
              <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary); margin: 0;">Total Initial Costs</h3>
              <a href="#" class="btn btn-secondary" style="padding: 0.75rem 1.5rem; font-size: 1rem;">Learn More</a>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Listing Price</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);"><?php echo estatein_format_price($price); ?></span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Additional Fees</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$29,700</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Property transfer tax, legal fees, inspection, insurance</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Down Payment</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$250,000</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">20%</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Mortgage Amount</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$1,000,000</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">If applicable</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Monthly Expenses -->
          <div class="pricing-card" style="border: 1px solid var(--color-border); border-radius: var(--border-radius-xl); padding: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--color-border); padding-bottom: 1.5rem; margin-bottom: 2rem;">
              <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary); margin: 0;">Monthly Expenses</h3>
              <a href="#" class="btn btn-secondary" style="padding: 0.75rem 1.5rem; font-size: 1rem;">Learn More</a>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Property Taxes</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$1,250</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Homeowners' Association Fee</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$300</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Mortgage Payment</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">Varies</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Based on terms and interest rate</span>
                </div>
              </div>
              <div>
                <div style="color: var(--color-text-secondary); margin-bottom: 0.75rem; font-size: 1.125rem;">Property Insurance</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                  <span style="font-size: 1.5rem; font-weight: 600; color: var(--color-text-primary);">$100</span>
                  <span style="background: var(--color-bg-primary); padding: 0.5rem 0.75rem; border-radius: var(--border-radius-sm); border: 1px solid var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">Approximate monthly cost</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div> <!-- End Container -->

  <!-- FAQ Section -->
  <?php get_template_part('sections/faq'); ?>

</main><!-- #primary -->

<?php
get_footer();
