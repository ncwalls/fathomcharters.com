<?php /* Template Name: Yacht */ get_header(); ?>
	
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
			</div>

		</article>

	<?php endwhile; ?>

<?php get_footer();