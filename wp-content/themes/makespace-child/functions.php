<?php

class MakespaceChild {

	function __construct(){
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'acf/init', array( $this, 'msw_acf_init' ) );
		add_action( 'wp_loaded', array( $this, 'msw_loaded' ) );
		add_action( 'init', array( $this, 'msw_ajax_atc') );
		// add_action( 'pre_get_posts', array( $this, 'pre_get_posts') );

		add_filter( 'wpseo_breadcrumb_links', array( $this, 'add_cpt_archive_parent_breadcrumb' ), 10, 1);

		// add_shortcode( 'first_name_possessive', array( $this, 'fname_possessive') );
		// add_shortcode( 'first_name', array( $this, 'fname') );
		
		//$this->custom_post_types();
		$this->modify_pt(); //may need Yoast Test Helper plugin - Reset Indexables tables & migrations

	}

	function modify_pt(){
		//may need Yoast Test Helper plugin - Reset Indexables tables & migrations

		/* filters
		
		//staff
		( 'staff_module_slug', 'staff' )
		( 'staff_module_single_name', 'Staff Member' )
		( 'staff_module_plural_name', 'Staff Members' )
		( 'staff_module_menu_icon', 'dashicons-businessman' )
		( 'staff_module_taxonomy_slug', 'department' )
		( 'staff_module_taxonomy_single_name', 'Department' )
		( 'staff_module_taxonomy_plural_name', 'Departments' )
		
		//case studies
		( 'case_studies_module_slug', 'case-studies' )
		( 'case_studies_module_single_name', 'Case Study' )
		( 'case_studies_module_plural_name', 'Case Studies' )
		( 'case_studies_module_menu_icon', 'dashicons-analytics' )
		( 'case_studies_module_taxonomy_slug', 'industry' )
		( 'case_studies_module_taxonomy_single_name', 'Industry' )
		( 'case_studies_module_taxonomy_plural_name', 'Industries' )
		*/

		add_filter( 'staff_module_slug', function(){ return 'our-team'; }, 100, 1 );
		add_filter( 'staff_module_single_name', function(){ return 'Team Member'; }, 100, 1 );
		add_filter( 'staff_module_plural_name', function(){ return 'Our Team'; }, 100, 1 );

	}

	function add_cpt_archive_parent_breadcrumb( $crumbs ){
		$archive_crumbs = array();
		$post_type;


		// Section for adding the parent one level from the end
		if ( is_post_type_archive() || is_tax() ) {
			if ( is_tax() ) {
				$tax_name = get_queried_object()->taxonomy;
				$module_end = strpos($tax_name, "module") + strlen( "module" );
				$post_type = substr($tax_name, 0, $module_end );
			} else {
				$post_type = get_queried_object()->name;
			}
			$field_name = $post_type . '_parent';
			$archive_parent = get_field( $field_name, 'option' );

			if( $archive_parent ){
				array_push( $archive_crumbs, array('url' => get_permalink($archive_parent->ID), 'text' => $archive_parent->post_title, 'id' => $archive_parent->ID,), array_pop( $crumbs ) );
				$crumbs = array_merge( $crumbs, $archive_crumbs);
			}
		}

		// Section for adding the parent two levels from the end
		if ( is_singular() ) {
			$post_type = get_post_type();
			$field_name = $post_type . '_parent';
			$archive_parent = get_field( $field_name, 'option' );

			if( $archive_parent ){
				array_push( $archive_crumbs, array_pop( $crumbs ), array_pop( $crumbs ), array('url' => get_permalink($archive_parent->ID), 'text' => $archive_parent->post_title, 'id' => $archive_parent->ID) );
				$archive_crumbs = array_reverse( $archive_crumbs);
				$crumbs = array_merge( $crumbs, $archive_crumbs);
			}
		}
		return $crumbs;
	}

	function after_setup_theme(){
		remove_image_size('1536x1536');
		remove_image_size('2048x2048');
		// update_option( 'thumbnail_size_h', 0 );
		// update_option( 'thumbnail_size_w', 0 );
		update_option( 'medium_size_h', 768 );
		update_option( 'medium_size_w', 768 );
		update_option( 'medium_large_size_w', 1024 );
		update_option( 'medium_large_size_h', 1024 );
		update_option( 'large_size_h', 1400 );
		update_option( 'large_size_w', 1400 );

		add_image_size( 'mini', 300, 300, false );
		add_image_size( 'small', 480, 480, false );
		add_image_size( 'max', 2048, 2048, false );

		// add_theme_support( 'case-studies-module' );
		// add_theme_support( 'locations-module' );
		// add_theme_support( 'staff-module' );
	}

	function wp_enqueue_scripts(){
		$msw_object = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'home_url' => home_url(),
			'show_dashboard_link' => current_user_can( 'manage_options' ) ? 1 : 0,
			'site_url' => site_url(),
			'stylesheet_directory' => get_stylesheet_directory_uri(),
		);
		if ( get_theme_support( 'locations-module' ) ) {
		 	$msw_object['google_map_data'] = get_google_map_data();
		}

		if ( get_field( 'default_google_map_api_key', 'option' ) ) :
			$google_api_key = 'https://maps.googleapis.com/maps/api/js?key=' . get_field( 'default_google_map_api_key', 'option' );
			wp_enqueue_script('google-maps', $google_api_key, true);
		endif;

		wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/scripts.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/scripts.min.js' ) );
		wp_localize_script( 'theme', 'MSWObject', $msw_object );

		//wp_enqueue_style( 'google-fonts', '', [], null );
		wp_enqueue_style( 'theme', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
	}

	function msw_acf_init() {
		if ( get_field( 'default_google_map_api_key', 'option' ) ) :
			acf_update_setting('google_api_key', get_field( 'default_google_map_api_key', 'option' ));
		endif;
	}

	function msw_loaded() {
		// Custom Thumbnail Sizes
		add_theme_support( 'post-thumbnails' );
		// add_image_size( 'blog-image', 400, 300, true ); // Example
	}

	function msw_ajax_atc() {
		// Example use case for shop archive page
		/*remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'woocommerce_after_shop_loop_item', 'ms_ajax_shop', 10 );
		function ms_ajax_shop() {
			echo prepare_ajax_atc();
		}

		add_action( 'wp_ajax_ms_ajax_atc', 'ms_ajax_atc' );
		add_action( 'wp_ajax_nopriv_ms_ajax_atc', 'ms_ajax_atc' );
		function ms_ajax_atc() {
			do_ajax_atc( $_POST['woo_ajax_object'] );
		}*/
	}

	static function format_number_string( $input, $addcommas = false ){
		$num = preg_replace('/[^0-9]/', '', $input);
		if($addcommas == true){
			$numFormatted = number_format($num);
		}
		else{
			$numFormatted = $num;
			/*$numInt = intval($num);
			
			if($numInt >= 2147483647){ // http://php.net/manual/en/function.intval.php
				$numFormatted = $num;
			}
			else{
				$numFormatted = $numInt;
			}*/
		}
		return $numFormatted;
	}

	// for display no page
	static function hide_email($email){
		$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
		$key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999);
		for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];
		$script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
		$script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
		$script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';
		// $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; 
		$script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';
		return '<span id="'.$id.'">[javascript protected email address]</span>'.$script;
	}
	
	//for href
	static function hide_email2($email){
		$email = $email;
		$crackme = "";
		for ($i=0; $i<strlen($email); $i++){
			$crackme .= "&#" . ord($email[$i]) . ";";
		}
		return $crackme;
	}
	
	static function get_primary_location(){
		$locations = get_posts(array(
			'post_type' => 'locations_module',
			'meta_key' => 'primary_location',
			'meta_value' => '1'
		));

		return $locations[0] ?? null;
	}

	static function get_google_directions_url( $destination ){
		$url = "https://www.google.com/maps/dir/?api=1&destination=" . urlencode( $destination );
		return $url;
	}

	static function slugify($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}

	function custom_post_types() {

		// register_post_type( 'service', array(
		// 	'label' => 'Services',
		// 	'labels' => array(
		// 		'name' => 'Services',
		// 		'singular_name' => 'Service',
		// 	),
		// 	'has_archive' => true,
		// 	'hierarchical' => true,
		// 	'public' => true,
		// 	'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'page-attributes' ),
		// 	'menu_icon' => 'dashicons-lightbulb',
			// 'show_in_rest' => true,
		// 	'rewrite' => array(
		// 		'slug' =>  'services'
		// 	)
		// ) );

		// register_taxonomy( 'service_category', 'service', array(
		// 	'label' => 'Categories',
		// 	'labels' => array(
		// 		'name' => 'Categories',
		// 		'singular_name' => 'Category',
		// 	),
		// 	'hierarchical' => true,
		// 	'show_admin_column' => true,
			// 'show_in_rest' => true
		// ) );

		// acf_add_options_sub_page( array(
		// 	'page_title' => 'Services Settings',
		// 	'menu_title' => 'Services Settings',
		// 	'menu_slug' => 'service-archive-settings',
		// 	'parent_slug' => 'edit.php?post_type=service'
		// ) );
	}

	function pre_get_posts( $query ){
		// if( $query->is_main_query() && ! is_admin() ){

		// 	if ( is_post_type_archive( 'service' ) ){
		// 		$query->set( 'orderby', 'menu_order' );
		// 		$query->set( 'order', 'ASC' );
		// 		$query->set( 'posts_per_page', -1 );
		// 	}

		// }
	}

	function fname_possessive($atts){
		
		if(isset($atts['id'])){
			$id = $atts['id'];
		}
		else{
			$id = get_the_ID();
		}

		$names = get_the_title($id);
		$names_arr = preg_split('/\s+/', $names);
		$first_name = $names_arr[0];
		
		if(substr($first_name, -1) == 's'){
			$first_name_possessive = $first_name . '\'';
		}
		else{
			$first_name_possessive = $first_name . '\'s';
		}

		return $first_name_possessive;
	}

	function fname($atts){
		
		if(isset($atts['id'])){
			$id = $atts['id'];
		}
		else{
			$id = get_the_ID();
		}

		$names = get_the_title($id);
		$names_arr = preg_split('/\s+/', $names);
		$first_name = $names_arr[0];
		return $first_name;
	}


	static function get_post_info($id){

		$post_image = '';
		if( get_the_post_thumbnail_url($id) ){
			$post_image = get_the_post_thumbnail_url( $id, 'medium' );
		}
		elseif(get_field( 'default_placeholder_image', 'option' )){
			$post_image = get_field( 'default_placeholder_image', 'option' )['sizes']['medium'];
		}

		$blog_author_id = get_post($id)->post_author;
		$post_author = get_the_author_meta('display_name', $blog_author_id);

		$post_cat = '';
		if($post_categories = get_the_category($id)){
			// $first_cat = $post_categories[0]->name;
			if($post_categories[0]->name !== 'Uncategorized'){
				$post_cat = $post_categories[0]->name;
			}
		}

		// $post_obj = get_post($id);
		// $post_content = $post_obj->post_content;
		// $excerpt_content = strip_tags( $post_content, '<br>' );
		// $excerpt_content = substr( $excerpt_content, 0, 200 ) . ' [...]';
		// $post_excerpt = $excerpt_content;
		
		$post_excerpt = get_the_excerpt($id);

		$post_info = array(
			'title' => get_the_title($id),
			'date' => get_the_time( 'F j, Y', $id ),
			'permalink' => get_permalink($id),
			'read_time' => get_read_time($id),
			'image' => $post_image,
			'author' => $post_author,
			'category' => $post_cat,
			'excerpt' => $post_excerpt,
			'content' => get_the_content($id)
		);

		return $post_info;
	}

}

$MakespaceChild = new MakespaceChild();

/*************************************************
 * MSW Calendar 
 *************************************************/
// require_once( 'msw-calendar/msw-calendar.php' );
/*************************************************/

/* Change excerpt more */
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/* Limit excerpt word count  */
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 * https://www.awesomeacf.com/responsive-images-wordpress-acf/
 *
 * example:
 * <img <?php awesome_acf_responsive_image(get_field( 'image_field' ),'xlarge','2049px'); ?> alt="">
 */

function awesome_acf_responsive_image($image_id,$image_size,$max_width){

	// check the image ID is not blank
	if($image_id != '') {

		if(is_array($image_id)){
			$image_id = $image_id['ID'];
		}

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		// generate the markup for the responsive image
		echo 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';

	}
}


/*************************************************
add field type class
**************************************************/
add_filter( 'gform_field_css_class', 'custom_class', 10, 3 );
function custom_class( $classes, $field, $form ) {
    $classes .= ' field_type_' . $field->type;

    return $classes;
}


/*************************************************
some spam blocks for the default contact form
************************************************/
add_filter( 'gform_validation', 'custom_validation' );
function custom_validation( $validation_result ) {
	$form = $validation_result['form'];

	if($form['id'] == 1){

		$firstname = rgpost( 'input_1' );
		$lastname = rgpost( 'input_2' );
		$email = rgpost( 'input_3' );
		$phone = rgpost( 'input_4' );
		$textarea = rgpost( 'input_5' );

		if ( $firstname == $lastname ) {

			// set the form validation to false
			$validation_result['is_valid'] = false;

			foreach( $form['fields'] as &$field ) {

				if ( $field->id == '1' || $field->id == '2' ) {
					$field->failed_validation = true;
					$field->validation_message = 'This field is invalid!';

					if ( $field->id == '2' ) {
						break;
					}
				}
			}
		}

		
		elseif(strpos($firstname, 'typodar') !== false){
			$validation_result['is_valid'] = false;

			foreach( $form['fields'] as &$field ) {

				if ( $field->id == '1' ) {
					$field->failed_validation = true;
					$field->validation_message = 'This field is invalid!';
					break;
				}
			}
		}

		elseif(strpos($lastname, 'typodar') !== false){
			$validation_result['is_valid'] = false;

			foreach( $form['fields'] as &$field ) {

				if ( $field->id == '2' ) {
					$field->failed_validation = true;
					$field->validation_message = 'This field is invalid!';
					break;
				}
			}
		}

		elseif(
			$email == "eric.jones.z.mail@gmail.com" ||
			$email == "waddoudszosense@gmail.com" ||
			$email == "fabianv8projection@gmail.com" ||
			$email == "kesleyxszqr73@gmail.com" ||
			strpos($email, 'sibicomail.com') !== false ||
			strpos($email, 'marketingguruco') !== false ||
			strpos($email, 'marketvalue') !== false ||
			strpos($email, 'waddoudszosense') !== false ||
			strpos($email, 'fabianv8projection') !== false
		){
			$validation_result['is_valid'] = false;

			foreach( $form['fields'] as &$field ) {
				if ( $field->id == '3' ) {
					$field->failed_validation = true;
					$field->validation_message = 'This email is invalid!';
					break;
				}
			}
		}

		elseif (
			strpos($textarea, '.ru') !== false ||
			strpos($textarea, 'youtube.com') !== false ||
			strpos($textarea, 'youtu.be') !== false ||
			strpos($textarea, 'porn') !== false ||
			strpos($textarea, 'sex') !== false ||
			strpos($textarea, 'SEO') !== false ||
			strpos($textarea, 'PPC') !== false ||
			strpos($textarea, 'crypto') !== false ||
			strpos($textarea, 'http') !== false ||
			strpos($textarea, 'www') !== false ||
			strpos($textarea, '@') !== false ||
			strpos($textarea, 'nutricompany') !== false ||
			strpos($textarea, 'marketingguruco') !== false || 
			strpos($textarea, 'marketvalue') !== false
		) {
			$validation_result['is_valid'] = false;
			
			foreach( $form['fields'] as &$field ) {
				if ( $field->id == '5' ) {
					$field->failed_validation = true;
					$field->validation_message = 'Contains invalid content! No spam, URLs, or email allowed';
					break;
				}
			}
		}
	}

	//Assign modified $form object back to the validation result
	$validation_result['form'] = $form;
	return $validation_result;
}




/*************************************************
Change inline font-size to rem
**************************************************/
add_filter( 'the_content', 'filter_the_content', 1 );
 
function filter_the_content( $content ) {

	if(strpos($content, 'style="font-size:')){
		preg_match('/font-size:(.+?)px/', $content, $edit);

		$content = preg_replace_callback(
			'/font-size:(.+?)px/',
	        function ($matches) {
	        	$edit = str_replace('font-size:', '', $matches[0]);
	        	$edit = str_replace('px', '', $edit);
	        	$edit = ($edit / 10);

				return 'font-size:' . $edit  . 'rem';
			},
			$content
		);
		return $content;
	}
 
    return $content;
}