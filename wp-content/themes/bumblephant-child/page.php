<?php get_header(); ?>
	
	<?php while( have_posts() ): the_post(); ?>
		<?php
			$page_class = '';
			if(get_page_template_slug(wp_get_post_parent_id()) == 'page_experiences_overview.php'){
				$page_class = 'experience-detail';
			} 
		?>
		<article <?php post_class($page_class); ?> id="post-<?php the_ID(); ?>">

			<div class="container">

				<h1><?php the_title(); ?></h1>

				<div class="wysiwyg main">
					<?php the_content(); ?>
				</div>

				<?php if(have_rows('team_sections')): ?>
					<div class="team-sections-list">
						<?php while(have_rows('team_sections')): the_row(); ?>
							<section class="team-section">
								<h2 class="section-title"><?php the_sub_field('section_title'); ?></h2>
								<ul class="team-list">
									<?php while(have_rows('team_members')): the_row(); ?>
										<li>
											<figure class="image">
												<?php if(get_sub_field('image')): ?>
													<img src="<?php echo get_sub_field('image')['sizes']['medium']; ?>" alt="">
												<?php endif; ?>
											</figure>
											<?php if(get_sub_field('name')): ?>
												<h3 class="name"><?php the_sub_field('name'); ?></h3>
											<?php endif; ?>
											<?php if(get_sub_field('bio')): ?>
												<div class="bio wysiwyg">
													<?php the_sub_field('bio'); ?>
												</div>
											<?php endif; ?>
										</li>
									<?php endwhile; ?>
								</ul>
							</section>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if(get_page_template_slug(wp_get_post_parent_id()) == 'page_experiences_overview.php'): ?>
				<div class="container wide">
					<?php if(get_field('experience_image')): ?>
						<img src="<?php echo get_field('experience_image')['sizes']['large']; ?>" class="experience-img" alt="">
					<?php elseif(get_the_post_thumbnail_url( get_the_ID() )): ?>
						<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" class="experience-img" alt="">
					<?php endif; ?>
					<?php if(get_field('details_content')): ?>
						<div class="experience-details">
							<?php if(get_field('details_title')): ?>
								<h2 class="experience-details-title"><?php the_field('details_title'); ?></h2>
							<?php endif; ?>
							<div class="experience-details-content">
								<?php if(have_rows('details_list')): ?>
									<div class="experience-details-list">
										<ul>
											<?php while(have_rows('details_list')): the_row(); ?>
												<li><?php the_sub_field('item'); ?></li>
											<?php endwhile; ?>
										</ul>
									</div>
								<?php endif; ?>
								<?php if(get_field('details_content')): ?>
									<div class="experience-details-wysiwyg wysiwyg">
										<?php the_field('details_content'); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if($booking_link = get_field('booking_link')): ?>
						<div class="booking-button">
							<a href="<?php echo $booking_link['url']; ?>" target="<?php echo $booking_link['target']; ?>" class="button"><?php echo $booking_link['title']; ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>

<?php get_footer();