<?php /* Template Name: Yacht */ get_header(); ?>
	
	<?php while( have_posts() ): the_post(); ?>

		<article <?php post_class($page_class); ?> id="post-<?php the_ID(); ?>">

			<div class="container">

				<h1><?php the_title(); ?></h1>

				<div class="wysiwyg main">
					<?php the_content(); ?>
				</div>
			</div>

			<div class="media-gallery">
				<h2 class="section-title"><?php the_field('galleries_title'); ?></h2>
				<ul class="media-gallery-nav">
					<?php $gallery_count = 0; while(have_rows('galleries')): the_row(); ?>
						<li>
							<button data-action="gallery-nav" data-target="<?php echo $gallery_count; ?>" class="<?php echo $gallery_count === 0 ? 'current' : ''; ?>">
								<?php the_sub_field('gallery_title'); ?>
							</button>
						</li>
					<?php $gallery_count++; endwhile; ?>
				</ul>
				<div class="media-gallery-slider">
					<?php while(have_rows('galleries')): the_row(); ?>
						<div class="slide">
							<?php if(get_sub_field('gallery_type') == 'images'): ?>
								<?php $images = get_sub_field('images'); ?>
								<ul class="img-gallery">
									<?php foreach($images as $img): ?>
										<li>
											<a href="<?php echo $img['url']; ?>">
												<span class="img" style="background-image:url(<?php echo $img['sizes']['medium']; ?>"></span>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php elseif(get_sub_field('gallery_type') == 'video'): ?>
								<div class="video">
									<div class="responsive-video">
										<?php the_sub_field('video'); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>

			<div class="yacht-slider">
				<?php while(have_rows('yacht_slider')): the_row(); ?>
					<figure class="slide">
						<?php if(get_sub_field('image')): ?>
							<img class="img" src="<?php echo get_sub_field('image')['sizes']['large']; ?>" alt="">
						<?php endif; ?>
						<?php if(get_sub_field('caption')): ?>
							<figcaption class="caption"><?php the_sub_field('caption'); ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endwhile; ?>
			</div>

		</article>

	<?php endwhile; ?>

<?php get_footer();