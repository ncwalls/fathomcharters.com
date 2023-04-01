<?php /* Template Name: Destinations */ get_header(); ?>
	
	<?php while( have_posts() ): the_post(); ?>
		
		<article <?php post_class($page_class); ?> id="post-<?php the_ID(); ?>">
			<div class="main-content">
				<div class="container">

					<h1><?php the_title(); ?></h1>

					<div class="wysiwyg main">
						<?php the_content(); ?>
					</div>

				</div>
			</div>

			<section class="destinations-container">
				<div class="bg-pattern"></div>
				<div class="bg-fade"></div>
				<div class="locations">
					<div class="inner">
						<h2 class="locations-title"><?php the_field('locations_title'); ?></h2>
						<ul class="locations-list">
							<?php $location_count = 0; while(have_rows('locations')): the_row(); $location_count++; ?>
								<li class="<?php echo get_sub_field('content') ? 'has-content' : '' ?>" id="location-item-<?php echo $location_count; ?>">
									<h3 class="title" data-action="destination-location"><?php the_sub_field('title'); ?></h3>
									<?php if(get_sub_field('content')): ?>
										<div class="content"><?php the_sub_field('content'); ?></div>
									<?php endif; ?>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
				<div class="map">
					<div class="map-img">
						<?php if(get_field('map_image')): ?>
							<img src="<?php echo get_field('map_image')['url']; ?>" alt="">
						<?php endif; ?>
						<ul class="map-locations">
							<?php $location_count = 0; while(have_rows('locations')): the_row(); $location_count++; ?>
								<li class="location <?php the_sub_field('icon_side') ?>" style="left:<?php the_sub_field('position_x'); ?>%; top:<?php the_sub_field('position_y'); ?>%" data-action="destination-map-location" data-target="<?php echo $location_count; ?>">
									<div class="icon">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 72 112" style="enable-background:new 0 0 72 112;" xml:space="preserve">
											<path d="M68.3,62.2c-5.6-10.3-8.8-22.1-8.8-34.7c0-3.8,0.3-7.5,0.8-11.1c-2.8,7.7-4.3,16-4.3,24.7c0,6.9,1,13.6,2.8,20
												c-1.7,0.1-3.3,0.4-4.9,0.8c-1.8,0.5-3.5,1.1-5.1,1.9c-3,1.5-5.7,3.5-8,5.9c-1.3-1.4-2.2-3.3-2.2-5.4c0-4.3,3.5-7.8,7.8-7.8
												c-5.5-18.1-9-37-10.4-56.5c-1.3,19.5-4.9,38.4-10.4,56.5c4.3,0,7.7,3.5,7.8,7.7v0.2c0,2.1-0.8,3.9-2.2,5.3c-2.3-2.4-5-4.4-8-5.9
												c-1.6-0.8-3.3-1.4-5.1-1.9c-1.6-0.4-3.2-0.7-4.9-0.8c1.8-6.3,2.8-13,2.8-20c0-8.7-1.5-17-4.3-24.7c0.6,3.6,0.8,7.3,0.8,11.1
												c0,12.6-3.2,24.4-8.8,34.7c-1.1,2.1-2.4,4.1-3.7,6c2-0.5,4.1-0.7,6.3-0.7c1.6,0,3.1,0.1,4.6,0.4c3.5,0.6,6.7,1.9,9.6,3.6
												c7.7,4.7,12.8,13.2,12.9,22.9l0,17.6c1.7-0.3,3.4-0.7,5.1-1l0-16.4c0-9.8,5.2-18.3,12.9-23.1c2.9-1.8,6.1-3,9.6-3.6
												c1.5-0.3,3.1-0.4,4.6-0.4c2.2,0,4.3,0.3,6.3,0.7C70.7,66.3,69.4,64.3,68.3,62.2"/>
										</svg>
									</div>
									<div class="name"><?php the_sub_field('name'); ?></div>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			</section>

			<section class="destination-custom">
				<div class="container">
					<img class="icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cta-icon.png" alt="">
					<?php if(get_field('custom_destination_title')): ?>
						<h2 class="title"><?php the_field( 'custom_destination_title' ); ?></h2>
					<?php endif; ?>
					<?php if(get_field('custom_destination_content')): ?>
						<div class="content">
							<?php echo get_field('custom_destination_content'); ?>
						</div>
					<?php endif; ?>
					<?php if($custom_destination_button = get_field('custom_destination_button')): ?>
						<a href="<?php echo $custom_destination_button['url']; ?>" target="<?php echo $custom_destination_button['target']; ?>" class="button ghost light"><?php echo $custom_destination_button['title']; ?></a>
					<?php endif; ?>
				</div>
			</section>

		</article>

	<?php endwhile; ?>

<?php get_footer();