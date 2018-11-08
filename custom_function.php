<?php

$theme = wp_get_theme();
$version = $theme->get( 'Version' );

register_sidebar(
	array(
		'name' => __("Slider Widget", "ascada"),
		'id' => 'sliderwidget',
		'description' => 'Front page only',
		'before_widget' => "<div class='jumbotron'>",
		'after_widget' => "</div>"
	)
);

register_sidebar(
	array(
		'name' => __("Social Share Widget", "ascada"),
		'id' => 'socialwidget',
		'description' => 'Post Page',
		'before_widget' => "<div class='social-share'>",
		'after_widget' => "</div>"
	)
);

register_sidebar(
	array(
		'name' => __("Contact Form Widget", "ascada"),
		'id' => 'contactform',
		'description' => 'Contact Form',
		'before_widget' => "<div class='contact-form'>",
		'after_widget' => "</div>"
	)
);

register_sidebar(
	array(
		'name' => __("Maps Widget", "ascada"),
		'id' => 'mapswidget',
		'description' => 'Maps Widget that will show on Contact Page',
		'before_widget' => "<div class='maps'>",
		'after_widget' => "</div>"
	)
);

function enqueue_styles_scripts() { 
	// wp_enqueue_style('gfonts', 'https://fonts.googleapis.com/css?family=Poly:400,400i|Source+Sans+Pro:400,400i,700,700i');
	wp_enqueue_style('Open Sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
	// wp_enqueue_style('Lato', 'https://fonts.googleapis.com/css?family=Lato:400,700,900');
	// // wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css');
	wp_enqueue_style('swiper', get_template_directory_uri().'/css/swiper.min.css');
	// wp_enqueue_style('swiper','https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css');
} 

add_action('wp_enqueue_scripts', 'enqueue_styles_scripts', null, $version, true);

function homepage_scripts(){
	wp_enqueue_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.1/js/swiper.min.js');
	// wp_enqueue_script('swiper', get_template_directory_uri().'/js/swiper.min.js');
	// wp_enqueue_script( 'jquery' );
	// wp_enqueue_script('jcookie', get_template_directory_uri() . '/js/jquery.cookie.js', null, $version, true);
	// wp_enqueue_script('scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'), $version, true);
	// wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), $version, true);
	wp_enqueue_script('nav', get_template_directory_uri() .'/js/custom.js', array('jquery'), 1, true);
}

add_action('wp_enqueue_scripts', 'homepage_scripts', null, $version, true);

// advanced search functionality
function advanced_search_query($query) {

    if( ! is_admin() && $query->is_main_query() && $query->is_search() ) {

        // Force to only search directory
        $query->set('post_type', 'directory');

        //area search
        if ( isset ( $_GET['s'] ) ) {
            $query->set( 'meta_key', 'area-2' );
            $query->set( 'meta_value', $_GET['s'] );
        }


        // //types term search
        // if ( isset ( $_GET['t'] ) ) {
        //     $query->set( 'types', $_GET['t'] );
        // }

        //price search
        if ( isset ( $_GET['p'] ) ) {
            $query->set( 'meta_key', 'price' );
            $query->set( 'meta_value', $_GET['p'] );
        }

        return $query;
    }

}

// add_action('pre_get_posts','advanced_search_query');

add_action('the_content', 'filter_content');

function filter_content($content){
	return sprintf($content);
}

function mg_news_pagination_rewrite() {
  add_rewrite_rule(get_option('category_base').'/page/?([0-9]{1,})/?$', 'index.php?pagename='.get_option('category_base').'&paged=$matches[1]', 'top');
}
add_action('init', 'mg_news_pagination_rewrite');

function search_query($query){

	$s = get_search_query();

	if($query->is_search()){
		$query->set('post_type', 'post');
		$query->set('post__not_in', [129]);
		$query->set('posts_per_page', 12);
	}
}
add_action('pre_get_posts','search_query');

//get listings for 'works at' on submit listing page
add_action('wp_ajax_nopriv_get_listing_names', 'ajax_listings');
add_action('wp_ajax_get_listing_names', 'ajax_listings');
 
function ajax_listings() {
	global $wpdb; //get access to the WordPress database object variable
 
	//get names of all businesses
	$name = $wpdb->esc_like(stripslashes($_POST['name'])).'%'; //escape for use in LIKE statement
	$sql = "select * 
		from $wpdb->posts 
		where post_title like %s 
		and post_type='post' and post_status='publish'";
 
	$sql = $wpdb->prepare($sql, $name);
	
	$results = $wpdb->get_results($sql);
 
	//copy the business titles to a simple array
	$titles = array();
	// foreach( $results as $r )
	// 	$titles[] = addslashes($r->post_title);
		
	echo json_encode($results); //encode into JSON format and output
 
	die(); //stop "0" from being output
}
?>