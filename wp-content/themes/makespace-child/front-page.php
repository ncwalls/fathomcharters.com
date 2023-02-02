<?php get_header(); ?>

	<?php while( have_posts() ): the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="hero">
				<?php $hero_type = get_field('hero_type'); ?>
				
				<?php if($hero_type == 'image' && get_field('hero_image')): ?>
					<div class="hero-bg" style="background-image:url(<?php echo get_field('hero_image')['url']; ?>)"></div>

				<?php elseif($hero_type == 'slider' && have_rows('hero_slider')): ?>
					<div class="hero-slider">
						<?php while(have_rows('hero_slider')): the_row(); ?>
							<div class="slide">
								<div class="img" style="background-image:url(<?php echo get_sub_field('image')['url']; ?>)"></div>
							</div>
						<?php endwhile; ?>
					</div>

				<?php elseif($hero_type == 'video_file' && get_field('hero_video_file')): ?>
					<div class="hero-video">
						<?php $video_url = get_field('hero_video_file')['url']; ?>
						<video src="<?php echo $video_url; ?>" poster="<?php //echo $hero_bg; ?>" autoplay muted loop playsinline ></video>
					</div>

				<?php elseif($hero_type == 'video_embed' && get_field('hero_video_embed')): ?>
					<?php 
						$video = get_field( 'hero_video_embed' );

						// Add autoplay functionality to the video code
						if ( preg_match('/src="(.+?)"/', $video, $matches) ) {
							// Video source URL
							$src = $matches[1];

							// get youtube video id
							preg_match('/embed\/(.*?)\?/', $src, $vid_id_arr);
							
							if(is_array($vid_id_arr) && count($vid_id_arr) > 0){
								if(isset($vid_id_arr[1])){
									$playlist_id = $vid_id_arr[1];
								}
								else{
									$playlist_id = $vid_id_arr[0];
								}
							}
							else{
								$playlist_id = '';
							}

							// Add option to hide controls, enable HD, and do autoplay -- depending on provider
							$params = array(
								'controls'    => 0,
				                'muted' => 1,
				                'mute' => 1,
				                'playsinline' => 1,
								'hd'  => 1,
								'background' => 1,
								'loop' => 1,
								'title' => 0,
								'byline' => 0,
								'autoplay' => 1,
				                'playlist' => $playlist_id // required to loop youtube
							);

							
							$new_src = add_query_arg($params, $src);
							
							$video = str_replace($src, $new_src, $video);
							
							// add extra attributes to iframe html
							$attributes = 'frameborder="0" autoplay muted loop playsinline webkit-playsinline allow="autoplay; fullscreen"';
							 
							$video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video);
						}
					?>
					<div class="hero-video"><?php echo $video ?></div>

				<?php endif; ?>

				<div class="hero-content">
					
				</div>
			</div>

			<section class="home-section">
				<div class="container">
					<?php if(get_field('section_title')): ?>
						<h2 class="section-title"><?php the_field( 'section_title' ); ?></h2>
					<?php endif; ?>
					<?php if(get_field('section_subtitle')): ?>
						<h3 class="section-subtitle"><?php the_field( 'section_subtitle' ); ?></h3>
					<?php endif; ?>
					<?php if(get_field('section_description')): ?>
						<div class="description">
							<?php the_field('section_description'); ?>
						</div>
					<?php endif; ?>
					<?php if($section_button = get_field('section_button')): ?>
						<a href="<?php echo $section_button['url']; ?>" target="<?php echo $section_button['target']; ?>" class="button"><?php echo $section_button['title']; ?></a>
					<?php endif; ?>
				</div>
			</section>

		</article>
	<?php endwhile; ?>
<?php get_footer();