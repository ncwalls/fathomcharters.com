<?php /* Template Name: Splash Page */ get_header(); ?>

	<?php while( have_posts() ): the_post(); ?>
		<?php if($bg = get_field('splash_background_image')): ?>
			<div class="splash-bg" style="background-image:url(<?php echo $bg['url']; ?>)"></div>
		<?php endif; ?>

		<article <?php post_class('splash-main'); ?> id="post-<?php the_ID(); ?>">
			<div class="splash-content container">

				<h1><?php the_title(); ?></h1>

				<div class="wysiwyg">
					<?php the_content(); ?>
				</div>

				<div class="splash-contact">
					<ul class="splash-contact-list">
						<?php if($phone = get_field('phone_number', 'option')): ?>
							<li class="phone">
								<a title="Phone number" href="tel:<?php echo MakespaceChild::format_number_string($phone); ?>">
									<?php if($phone_display = get_field('phone_number_display', 'option')){
										echo '<strong>' . $phone_display . '</strong> <span>(' . $phone . ')</span>';
									}
									else{
										echo $phone;
									} ?>
								</a>
							</li>
						<?php endif; ?>
						<?php if($email = get_field('email_address', 'option')): ?>
							<li class="email"><a title="Email" href="mailto:<?php echo MakespaceChild::hide_email2($email); ?>"><?php echo MakespaceChild::hide_email($email); ?></a></li>
						<?php endif; ?>
						<?php if(have_rows('social_media_links', 'option')): ?>
							<li class="social">
								<ul>
									<?php while(have_rows('social_media_links', 'option' )): the_row(); ?>
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
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</article>

		<div class="splash-footer">
			<svg width="1400px" height="175px" viewBox="0 0 1400 175" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
				<path d="M-3.10862e-13 20C156 20 400 92 750 92C1100 92 1239 1.20459e-13 1400 -6.45317e-15C1400 95 1400 155 1400 155L-2.86576e-13 155C-2.86576e-13 155 -2.42861e-14 115 -3.10862e-13 20Z" id="Rectangle" fill="#95C3EC" fill-rule="evenodd" stroke="none" />
				<path d="M-2.86576e-13 30C156 30 330 100 680 100C1030 100 1239 35 1400 35C1400 130 1400 175 1400 175L-2.86576e-13 175C-2.86576e-13 175 0 125 -2.86576e-13 30Z" id="Rectangle" fill="#75ABDC" fill-rule="evenodd" stroke="none" />
				<path d="M-3.10862e-13 60C156 60 370 117 720 117C1070 117 1239 30 1400 30C1400 125 1400 175 1400 175L-2.86576e-13 175C-2.86576e-13 175 -2.42861e-14 155 -3.10862e-13 60Z" id="Rectangle" fill="#5E94C4" fill-rule="evenodd" stroke="none" />
			</svg>
		</div>	

	<?php endwhile; ?>

<?php get_footer();