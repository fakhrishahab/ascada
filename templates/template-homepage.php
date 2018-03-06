<?php
/**
*Template Name: Home Page
*/
	get_header();
?>
	<?php
	if ( is_front_page() && is_dynamic_sidebar('sliderwidget') ) {
		dynamic_sidebar('sliderwidget');
		// dynamic_sidebar('sliderwidget');
		// dynamic_sidebar('sliderwidget');
	}
		
	get_template_part('section-parts/section', 'latest-release');

	get_template_part('section-parts/section', 'artist-slider');

	get_template_part('section-parts/section', 'footer');
	?>
<?php
	get_footer();
?>