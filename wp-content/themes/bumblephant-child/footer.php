		</div><!-- /.wrapper -->

		<?php if(!is_page_template('page_splash.php')): ?>
			<?php
				//$primary_location = MakespaceChild::get_primary_location();
			?>
			<footer class="site-footer">
				<div class="container">
					<div class="site-footer__menu">
						<?php if($primary_location && have_rows('social_media_links', $primary_location->ID)): ?>
							<ul class="footer-social">
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
						<nav class="footer-inlinks">
							<p class="copyright" role="contentinfo">&copy;<?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>  All rights reserved.</p>
							<?php
								wp_nav_menu( array(
									'container' => 'nav',
									'container_id' => 'footer-nav',
									'theme_location' => 'footer'
								) );
							?>
						</nav>
					</div>
				</div>
			</footer>
		<?php endif; wp_footer(); ?>
	</body>
</html>
