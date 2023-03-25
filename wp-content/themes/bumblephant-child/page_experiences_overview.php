<?php /* Template Name: Experiences Overview */ get_header(); ?>
	
	<?php while( have_posts() ): the_post(); ?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<div class="container">

				<h1><?php the_title(); ?></h1>

				<div class="wysiwyg main">
					<?php the_content(); ?>
				</div>

			</div>

			<div class="container wide">
				<?php
					$subpages = get_posts(array(
						'post_type' => 'page',
						'post_parent' => get_the_ID(),
						'fields' => 'ids',
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page' => -1
					));
				?>
				<?php if($subpages): ?>
					<div class="expirences-list">
						<?php foreach ($subpages as $page_id): ?>
							<section class="expirence">
								<figure class="image">
									<a href="<?php echo get_permalink($page_id); ?>">
										<?php if(get_the_post_thumbnail_url( $page_id )): ?>
											<img src="<?php echo get_the_post_thumbnail_url( $page_id, 'large' ); ?>" class="experience-img" alt="">
										<?php elseif(get_field('experience_image', $page_id)): ?>
											<img src="<?php echo get_field('experience_image', $page_id)['sizes']['large']; ?>" class="experience-img" alt="">
										<?php endif; ?>
									</a>
								</figure>
								<div class="content">
									<div>
										<h2 class="section-title">
											<a href="<?php echo get_permalink($page_id); ?>"><?php echo get_the_title($page_id); ?></a>
										</h2>
										<div class="wysiwyg">
											<?php echo get_field('short_description', $page_id); ?>
										</div>
									</div>
									<a href="<?php echo get_permalink($page_id); ?>" class="button ghost">Learn More</a>
								</div>
							</section>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>

			<div class="experiences-cta">
				<div class="container">
					<?php if(get_field('experiences_cta_title') || get_field('experiences_cta_description') || get_field('experiences_cta_button')): ?>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/cta-icon.png" class="icon" alt="">
						<?php if(get_field('experiences_cta_title')): ?>
							<h2 class="title"><?php the_field('experiences_cta_title'); ?></h2>
						<?php endif; ?>
						<?php if(get_field('experiences_cta_description')): ?>
							<div class="wysiwyg">
								<?php the_field('experiences_cta_description'); ?>
							</div>
						<?php endif; ?>
						<?php if($cta_button = get_field('experiences_cta_button')): ?>
							<a href="<?php echo $cta_button['url']; ?>" target="<?php echo $cta_button['target']; ?>" class="button ghost light"><?php echo $cta_button['title']; ?></a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>

		</article>

	<?php endwhile; ?>

<?php get_footer();