<?php
/**
 * ascada Theme Customizer
 *
 * @package ascada
 */

function sanitize_textarea( $text ) {

    return esc_html__( $text );

}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ascada_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ascada_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ascada_customize_partial_blogdescription',
		) );
	}

	do_action( 'ascada_customize_before_register', $wp_customize );

	$wp_customize->add_panel( 'ascada_options',
		array(
			'priority'       => 22,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '',
		    'title'          => esc_html__( 'Location', 'ascada' ),
		    'description'    => '',
		)
	);

	// $wp_customize->add_section( 'ascada_location_section' ,
	// 	array(
	// 		'priority'    => 3,
	// 		'title'       => esc_html__( 'Location', 'ascada' ),
	// 		'description' => '',
	// 		'panel'       => 'ascada_options',
	// 	)
	// );

	/* Location Settings
	----------------------------------------------------------------------*/
	$wp_customize->add_section( 'ascada_location_section' ,
		array(
			'priority'    => 1,
			'title'       => esc_html__( 'Location', 'ascada' ),
			'description' => '',
			'panel'       => 'ascada_options',
		)
	);
		
	    $wp_customize->add_setting(
	    	'ascada_company_name',
	    	array(
	    		'sanitize_callback' => 'ascada_sanitize_text',
	    		'transport' => 'refresh',
	    		'default' => __('PT Ascada Music Indonesia', 'ascada'),
	    	)
	    );

	    $wp_customize->add_control(
	    	'ascada_company_name',
	    	array(
	    		'label' => __('Company Name', 'ascada'),
	    		'section' => 'ascada_location_section',
	    		'type' => 'text'
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_company_location',
	    	array(
	    		'sanitize_callback' => 'sanitize_textarea',
	    		'transport' => 'refresh',
	    		'default' => __('PT Ascada Music Indonesia', 'ascada'),
	    	)
	    );

	    $wp_customize->add_control(
	    	new WP_Customize_Control(
	    		$wp_customize,
	    		'ascada_company_location',
	    		array(
	    			'label'		=> __('Company Address', 'ascada'),
	    			'section'	=> 'ascada_location_section',
	    			'setting'	=> 'ascada_company_location',
	    			'type'		=> 'textarea'
	    		)
	    	)
	    );

	/* Footer Settings
	----------------------------------------------------------------------*/
	$wp_customize->add_section( 'ascada_footer_section' ,
		array(
			'priority'    => 3,
			'title'       => esc_html__( 'Footer Content', 'ascada' ),
			'description' => '',
			'panel'       => 'ascada_options',
		)
	);

		// Specialities Slider Image Title
	    $wp_customize->add_setting(
	    	'ascada_footer_copyright',
	    	array(
	    		'sanitize_callback' => 'ascada_sanitize_text',
	    		'transport' => 'refresh',
	    		'default' => __('Copyright', 'ascada'),
	    	)
	    );

	    $wp_customize->add_control(
	    	'ascada_footer_copyright',
	    	array(
	    		'label' => __('Copyright', 'ascada'),
	    		'section' => 'ascada_footer_section',
	    		'type' => 'text'
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_facebook_image',
	    	array(
	    		'transport'	=> 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	new WP_Customize_Upload_Control(
	    		$wp_customize,
	    		'ascada_facebook_image',
	    		array(
	    			'label'	=> __('Facebook Image', 'ascada'),
	    			'section' => 'ascada_footer_section',
	    			'setting' => 'ascada_facebook_image'
	    		)
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_facebook_link',
	    	array(
	    		'sanitize_callback' => 'ascada_sanitize_text',
	    		'transport' => 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	'ascada_facebook_link',
	    	array(
	    		'label' => __('Facebook Link', 'ascada'),
	    		'section' => 'ascada_footer_section',
	    		'type' => 'text'
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_twitter_image',
	    	array(
	    		'transport'	=> 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	new WP_Customize_Upload_Control(
	    		$wp_customize,
	    		'ascada_twitter_image',
	    		array(
	    			'label'	=> __('Twitter Image', 'ascada'),
	    			'section' => 'ascada_footer_section',
	    			'setting' => 'ascada_twitter_image'
	    		)
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_twitter_link',
	    	array(
	    		'sanitize_callback' => 'ascada_sanitize_text',
	    		'transport' => 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	'ascada_twitter_link',
	    	array(
	    		'label' => __('Twitter Link', 'ascada'),
	    		'section' => 'ascada_footer_section',
	    		'type' => 'text'
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_instagram_image',
	    	array(
	    		'transport'	=> 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	new WP_Customize_Upload_Control(
	    		$wp_customize,
	    		'ascada_instagram_image',
	    		array(
	    			'label'	=> __('Instagram Image', 'ascada'),
	    			'section' => 'ascada_footer_section',
	    			'setting' => 'ascada_instagram_image'
	    		)
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_instagram_link',
	    	array(
	    		'sanitize_callback' => 'ascada_sanitize_text',
	    		'transport' => 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	'ascada_instagram_link',
	    	array(
	    		'label' => __('Instagram Link', 'ascada'),
	    		'section' => 'ascada_footer_section',
	    		'type' => 'text'
	    	)
	    );





	    $wp_customize->add_setting(
	    	'ascada_youtube_image',
	    	array(
	    		'transport'	=> 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	new WP_Customize_Upload_Control(
	    		$wp_customize,
	    		'ascada_youtube_image',
	    		array(
	    			'label'	=> __('Youtube Image', 'ascada'),
	    			'section' => 'ascada_footer_section',
	    			'setting' => 'ascada_youtube_image'
	    		)
	    	)
	    );

	    $wp_customize->add_setting(
	    	'ascada_youtube_link',
	    	array(
	    		'sanitize_callback' => 'ascada_sanitize_text',
	    		'transport' => 'refresh'
	    	)
	    );

	    $wp_customize->add_control(
	    	'ascada_youtube_link',
	    	array(
	    		'label' => __('Youtube Link', 'ascada'),
	    		'section' => 'ascada_footer_section',
	    		'type' => 'text'
	    	)
	    );

}
add_action( 'customize_register', 'ascada_customize_register' );

function ascada_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ascada_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ascada_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ascada_customize_preview_js() {
	wp_enqueue_script( 'ascada-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ascada_customize_preview_js' );
