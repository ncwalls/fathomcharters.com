<?php
/*
 * Template Name: Contact
 */
get_header(); ?>

<?php
	$primary_location = MakespaceChild::get_primary_location();

	$contact_address = '';
	$phone = '';
	$fax = '';
	$email = '';
	$contact_url = '';

	$map_location = '';
	$directions_link = '';

	if($primary_location){

		$address_1 = get_field('street_address_line_1', $primary_location->ID);
		$address_2 = get_field('street_address_line_2', $primary_location->ID);
		$address_city = get_field('city', $primary_location->ID);
		$address_state = get_field('state_region', $primary_location->ID);
		$address_zip = get_field('zip_postal_code', $primary_location->ID);
		$address_country = get_field('country', $primary_location->ID);


		if($address_1){
			$contact_address .= $address_1 . '<br>';
		}
		if($address_2){
			$contact_address .= $address_2 . '<br>';
		}
		if($address_city){
			$contact_address .= $address_city . ', ';
		}
		if($address_state){
			$contact_address .= $address_state;
		}
		if($address_zip){
			$contact_address .= ' ' . $address_zip . '<br>';
		}
		if($address_country){
			$contact_address .= $address_country;
		}
		
		$phone = get_field('phone', $primary_location->ID);
		$fax = get_field('fax', $primary_location->ID);
		$email = get_field('email', $primary_location->ID);
		$contact_url = get_field('url', $primary_location->ID);

		$map_location = get_field('google_map', $primary_location->ID);
		if($map_location){
			$directions_link = makespaceChild::get_google_directions_url( $map_location['address'] );
		}
	}
?>

	<?php while( have_posts() ): the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="container">
				<h1><?php the_title(); ?></h1>
				<div class="wysiwyg main">
					<?php the_content(); ?>
				</div>

				<section class="contact-page-form">
					<?php echo do_shortcode('[gravityform id="1" title="true" description="false" ajax="true"]'); ?>
				</section>
				
				<?php /* ?>
				<div class="contact-page-content">
					<section class="contact-info">
						<?php if($phone): ?>
							<p class="phone"><a title="Phone number" href="tel:<?php echo MakespaceChild::format_number_string($phone); ?>"><?php echo $phone; ?></a></p>
						<?php endif; ?>
						<?php if($fax): ?>
							<p class="fax">Fax: <a title="Fax Number" href="tel:<?php echo MakespaceChild::format_number_string($fax); ?>"><?php echo $fax; ?></a></p>
						<?php endif; ?>
						<?php if($email): ?>
							<p class="email"><a title="Email" href="mailto:<?php echo MakespaceChild::hide_email2($email); ?>"><?php echo MakespaceChild::hide_email($email); ?></a></p>
						<?php endif; ?>
						<?php if($contact_address): ?>
							<p class="address">
								<?php if($directions_link): ?>
									<a title="Get directions" href="<?php echo $directions_link; ?>" target="_blank"><?php echo $contact_address; ?><br>
									<span class="link">Directions</span></a>
								<?php else: ?>
									<?php echo $contact_address; ?>
								<?php endif; ?>
							</p>
						<?php endif; ?>
						<?php if($primary_location && have_rows('social_media_links', $primary_location->ID)): ?>
							<ul class="contact-social">
								<?php while(have_rows('social_media_links', $primary_location->ID)): the_row(); ?>
									<?php 
										$social_site_name = get_sub_field('site')['label'];
										$social_site_class = get_sub_field('site')['value'];
										$social_site_url = get_sub_field('url');
									?>
									<li>
										<a title="<?php echo $social_site_name ?>" href="<?php echo $social_site_url; ?>" target="_blank">
											<span class="fab fa-<?php echo $social_site_class; ?>"></span>
										</a>
									</li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</section>
				</div>
				*/ ?>
			</div>
		</article>
	<?php endwhile; ?>

<?php get_footer();
