<?php 

/*
	
	archive page code:
	
	<?php
		$search_term = false;
		if(isset($_GET['s'])){
			$search_term = $_GET['s'];
		}
		$filter_args = array(
			'post_type' => 'post',
			'tax_1_slug' => 'research_category',
			'tax_1_title' => 'Category',
			'tax_2_slug' => 'research_topic',
			'tax_2_title' => 'Topic',
			'search_term' => $search_term
		);

		get_template_part( 'template', 'dual_filters', array($filter_args));
	?>
*/

	$template_args = $args[0];

	$post_type_slug = $template_args['post_type'];
	$post_type_url = get_post_type_archive_link($template_args['post_type']);
	$post_type_name = get_post_type_object( $template_args['post_type'] )->labels->name;
	$tax_1_slug = $template_args['tax_1_slug'];
	$tax_1_title = $template_args['tax_1_title'];
	$tax_2_slug = $template_args['tax_2_slug'];
	$tax_2_title = $template_args['tax_2_title'];
	$search_term = $template_args['search_term'];

	$tax_1_query = false;
	if(isset($_GET[$tax_1_slug])){
		$tax_1_query = $tax_1_slug . '=' . htmlentities($_GET[$tax_1_slug]);
	}
	$tax_2_query = false;
	if(isset($_GET[$tax_2_slug])){
		$tax_2_query = $tax_2_slug . '=' . htmlentities($_GET[$tax_2_slug]);
	}
?>
		
		<form action="<?php echo get_permalink( get_option('page_for_posts') ); ?>" method="get" role="search" id="blog-search-form" class="search-form">
			<label for="blog-search-input">Keyword Search</label>
			<div class="search-field">
				<input type="text" name="s" id="blog-search-input" placeholder="Search" value="<?php the_search_query(); ?>">
				<?php if($tax_1_query): ?>
					<input type="hidden" name="<?php echo $tax_1_slug; ?>" value="<?php echo htmlentities($_GET[$tax_1_slug]) ?>" />
				<?php endif; ?>
				<?php if($tax_2_query): ?>
					<input type="hidden" name="<?php echo $tax_2_slug; ?>" value="<?php echo htmlentities($_GET[$tax_2_slug]) ?>" />
				<?php endif; ?>
				<button type="submit" id="searchsubmit" form="blog-search-form" value="Search">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>

				<?php if(isset($_GET['s'])): ?>
					<?php
						$clear_search_url = get_permalink( get_option('page_for_posts') );

						if($tax_1_query && $tax_2_query){
							$clear_search_url .= '?' . $tax_1_query . '&' . $tax_2_query;
						}
						else{
							if($tax_1_query){
								$clear_search_url .= '?' . $tax_1_query;
							}
							if($tax_2_query){
								$clear_search_url .= '?' . $tax_2_query;
							}
						}
					?>
					<a href="<?php echo $clear_search_url; ?>" class="search-clear"><i class="fal fa-times"></i> Clear Search</a>
				<?php endif; ?>

			</div>
		</form>

		<div class="filter-container">
			<div class="filter-label">Filter By <?php echo $tax_1_title; ?></div>
			<div class="filter-dropdown">
				<div class="filter-display">
					<?php
						if( single_term_title( '', false ) && get_query_var('taxonomy') == $tax_1_slug){
							single_term_title();
						}
						elseif(isset($_GET[$tax_1_slug])){
							// echo htmlentities($_GET[$tax_1_slug]);

							$term_1_slug = $_GET[$tax_1_slug];
							$term_1 = get_term_by('slug', $term_1_slug, $tax_1_slug);

							echo $term_1->name;

						}
						else {
							echo 'All';
						}
					?>
				</div>
				<ul>
					<?php
						$tax_1_all_url = $post_type_url;

						if($tax_2_query){
							// $tax_1_all_url .= '?'.$tax_2_slug.'=' . htmlentities($_GET[$tax_2_slug]);
							$tax_1_all_url .= '?' . $tax_2_query;
						
							if($search_term){
								$tax_1_all_url .= '&s=' . $search_term;
							}
						}
						elseif($search_term){
							$tax_1_all_url .= '?s=' . $search_term;
						}
					?>
					<li><a title="View All <?php echo $post_type_name; ?>" href="<?php echo $tax_1_all_url; ?>">All</a></li>
					<?php
						$tax_1_terms = get_terms( array(
							'orderby' => 'name',
							'order'   => 'ASC',
							'taxonomy' => $tax_1_slug
						) );
						foreach( $tax_1_terms as $category ) {
							$catslug = $category->slug;
							$catname = $category->name;
							$accessibility_title = $catname . ' ' . $post_type_name;
							$caturl = get_post_type_archive_link($post_type_slug) .'?'.$tax_1_slug.'=' . $catslug;

							if(isset($_GET[$tax_2_slug])){
								$caturl .= '&'.$tax_2_slug.'=' . htmlentities($_GET[$tax_2_slug]);
							}
							if($search_term){
								$caturl .= '&s=' . $search_term;
							}
							echo '<li><a title="' . $accessibility_title . '" href="' . $caturl .'">' . $catname. '</a></li>';
						}
					?>
				</ul>
			</div>
		</div>
		<div class="filter-container">
			<div class="filter-label">Filter By <?php echo $tax_2_title; ?></div>
			<div class="filter-dropdown">
				<div class="filter-display">
					<?php
						if( single_term_title( '', false ) && get_query_var('taxonomy') == $tax_2_slug){
							single_term_title();
						}
						elseif(isset($_GET[$tax_2_slug])){
							// echo htmlentities($_GET[$tax_2_slug]);
							$term_2_slug = $_GET[$tax_2_slug];
							$term_2 = get_term_by('slug', $term_2_slug, $tax_2_slug);

							echo $term_2->name;
						}
						else {
							echo 'All';
						}
					?>
				</div>
				<ul>
					<?php
						$tax_2_all_url = $post_type_url;
						
						if($tax_1_query){
							// $tax_2_all_url .= '?'.$tax_1_slug.'=' . htmlentities($_GET[$tax_1_slug]);
							$tax_2_all_url .= '?'. $tax_1_query;
						
							if($search_term){
								$tax_2_all_url .= '&s=' . $search_term;
							}
						}
						elseif($search_term){
							$tax_2_all_url .= '?s=' . $search_term;
						}
					?>
					<li><a title="View All <?php echo $post_type_name; ?>" href="<?php echo $tax_2_all_url; ?>">All</a></li>
					<?php
						$tax_2_terms = get_terms( array(
							'orderby' => 'name',
							'order'   => 'ASC',
							'taxonomy' => $tax_2_slug
						) );

						foreach( $tax_2_terms as $category ) {
							$catslug = $category->slug;
							$catname = $category->name;
							$accessibility_title = $catname . ' ' . $post_type_name;
							$caturl = get_post_type_archive_link($post_type_slug) .'?'.$tax_2_slug.'=' . $catslug;

							if($tax_1_query){
								$caturl .= '&' . $tax_1_query;
							}
							if($search_term){
								$caturl .= '&s=' . $search_term;
							}
							echo '<li><a title="' . $accessibility_title . '" href="' . $caturl .'">' . $catname. '</a></li>';
						}
					?>
				</ul>
			</div>
		</div>