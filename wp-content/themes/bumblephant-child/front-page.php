<?php get_header(); ?>

	<?php while( have_posts() ): the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="hero">
				<?php if($hero_bg = get_field('hero_image')): ?>
					<div class="bg" style="background-image:url(<?php echo $hero_bg['url']; ?>);"></div>
				<?php endif; ?>
				
				<h1 class="title"><?php the_field('hero_title'); ?></h1>

				<?php if($hero_button = get_field('hero_button')): ?>
					<div class="content">
						<a href="<?php echo $hero_button['url']; ?>" target="<?php echo $hero_button['target']; ?>" class="button"><?php echo $hero_button['title']; ?></a>
					</div>
				<?php endif; ?>

				<div class="waves">
					<svg width="1400px" height="175px" viewBox="0 0 1400 175" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
						<path d="M-3.10862e-13 20C156 20 400 92 750 92C1100 92 1239 1.20459e-13 1400 -6.45317e-15C1400 95 1400 155 1400 155L-2.86576e-13 155C-2.86576e-13 155 -2.42861e-14 115 -3.10862e-13 20Z" id="Rectangle" fill="#95C3EC" fill-rule="evenodd" stroke="none" />
						<path d="M-2.86576e-13 30C156 30 330 100 680 100C1030 100 1239 35 1400 35C1400 130 1400 175 1400 175L-2.86576e-13 175C-2.86576e-13 175 0 125 -2.86576e-13 30Z" id="Rectangle" fill="#75ABDC" fill-rule="evenodd" stroke="none" />
						<path d="M-3.10862e-13 60C156 60 370 117 720 117C1070 117 1239 30 1400 30C1400 125 1400 175 1400 175L-2.86576e-13 175C-2.86576e-13 175 -2.42861e-14 155 -3.10862e-13 60Z" id="Rectangle" fill="#5E94C4" fill-rule="evenodd" stroke="none" />
					</svg>
				</div>
			</div>

			<?php if($intro_bg = get_field('intro_background')): ?>
				<style type="text/css">
					.home-intro .bg.visible{
						background-image: url(<?php echo $intro_bg['sizes']['large']; ?>);
					}
				</style>
			<?php endif; ?>
			<section class="home-section home-intro">
				<?php if($intro_bg): ?>
					<div class="bg lazy-background"></div>
				<?php endif; ?>
				<div class="container">
					<?php if(get_field('intro_title')): ?>
						<h2 class="section-title"><?php the_field( 'intro_title' ); ?></h2>
					<?php endif; ?>
					<?php if(get_field('intro_content')): ?>
						<div class="section-content">
							<?php the_field('intro_content'); ?>
						</div>
					<?php endif; ?>
					<?php if($intro_button = get_field('intro_button')): ?>
						<a href="<?php echo $intro_button['url']; ?>" target="<?php echo $intro_button['target']; ?>" class="button ghost light"><?php echo $intro_button['title']; ?></a>
					<?php endif; ?>
				</div>
			</section>

			<section class="home-section home-experiences">
				<div class="container">
					<?php if(get_field('experiences_title')): ?>
						<h2 class="section-title"><?php the_field( 'experiences_title' ); ?></h2>
					<?php endif; ?>
					<?php if(get_field('experiences_content')): ?>
						<div class="section-content">
							<?php the_field('experiences_content'); ?>
						</div>
					<?php endif; ?>
				</div>
				<?php
					$experiences_subpages = get_posts(array(
						'post_type' => 'page',
						'post_parent' => get_field('experiences_overview_page'),
						'fields' => 'ids',
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page' => -1
					));
				?>
				<?php if($experiences_subpages): ?>
					<ul class="home-experiences-list">
						<?php foreach ($experiences_subpages as $page_id): ?>
							<li class="experience">
								<a href="<?php echo get_permalink($page_id); ?>" class="permalink">
									<figure class="bg">
										<?php if(get_the_post_thumbnail_url( $page_id )): ?>
											<img src="<?php echo get_the_post_thumbnail_url( $page_id, 'large' ); ?>" alt="" loading="lazy">
										<?php elseif(get_field('experience_image', $page_id)): ?>
											<img src="<?php echo get_field('experience_image', $page_id)['sizes']['large']; ?>" alt="" loading="lazy">
										<?php endif; ?>
									</figure>
									<div class="content">
										<h3 class="title"><?php echo get_the_title($page_id); ?></h3>
										<span class="button">Learn More</span>
									</div>
								</a>
							</li>
						<?php endforeach; ?>
						<li class="custom">
							<div>
								<img class="icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cta-icon.png" alt="">
								<?php if(get_field('custom_experience_title')): ?>
									<h3 class="title"><?php the_field( 'custom_experience_title' ); ?></h3>
								<?php endif; ?>
								<?php if(get_field('custom_experience_description')): ?>
									<div class="content">
										<?php echo get_field('custom_experience_description'); ?>
									</div>
								<?php endif; ?>
								<?php if($custom_experience_button = get_field('custom_experience_button')): ?>
									<a href="<?php echo $custom_experience_button['url']; ?>" target="<?php echo $custom_experience_button['target']; ?>" class="button ghost light"><?php echo $custom_experience_button['title']; ?></a>
								<?php endif; ?>
							</div>
						</li>
					</ul>
				<?php endif; ?>
			</section>

			<section class="home-section home-destinations">
				<div class="container">
					<?php if(get_field('destinations_title')): ?>
						<h2 class="section-title"><?php the_field( 'destinations_title' ); ?></h2>
					<?php endif; ?>
					<?php if(get_field('destinations_content')): ?>
						<div class="section-content">
							<?php the_field('destinations_content'); ?>
						</div>
					<?php endif; ?>
					<?php if(have_rows('destinations_slider')): ?>
						<div class="destinations-slider">
							<?php while(have_rows('destinations_slider')): the_row(); ?>
								<div class="slide">
									<?php if(get_sub_field('image')): ?>
										<div class="image" style="background-image:url(<?php echo get_sub_field('image')['sizes']['large']; ?>)">
										</div>
									<?php endif; ?>
									<?php if(get_sub_field('title')): ?>
										<h3 class="title"><?php the_sub_field( 'title' ); ?></h3>
									<?php endif; ?>
									<?php if(get_sub_field('description')): ?>
										<div class="description">
											<?php the_sub_field('description'); ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
					<?php if($destinations_button = get_field('destinations_button')): ?>
						<a href="<?php echo $destinations_button['url']; ?>" target="<?php echo $destinations_button['target']; ?>" class="button"><?php echo $destinations_button['title']; ?></a>
					<?php endif; ?>
				</div>
			</section>

			<?php if($about_bg = get_field('about_background')): ?>
				<style type="text/css">
					.home-about .bg.visible{
						background-image: url(<?php echo $about_bg['sizes']['large']; ?>);
					}
				</style>
			<?php endif; ?>
			<section class="home-section home-about">
				<?php if($about_bg): ?>
					<div class="bg lazy-background"></div>
				<?php endif; ?>
				<div class="container">
					<?php if(get_field('about_title')): ?>
						<h2 class="section-title"><?php the_field( 'about_title' ); ?></h2>
					<?php endif; ?>
					<?php if(get_field('about_content')): ?>
						<div class="section-content">
							<?php the_field('about_content'); ?>
						</div>
					<?php endif; ?>
					<?php if($about_button = get_field('about_button')): ?>
						<a href="<?php echo $about_button['url']; ?>" target="<?php echo $about_button['target']; ?>" class="button"><?php echo $about_button['title']; ?></a>
					<?php endif; ?>
				</div>
			</section>

		</article>
	<?php endwhile; ?>
<?php get_footer();