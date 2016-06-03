<?php

function muqaddimah_sanitize_text($str){
	return sanitize_text_field($str);
}

function muqaddimah_customize_register_modify( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->get_section( 'header_image' )->title = __( 'Site Image', 'muqaddimah' );
	$wp_customize->remove_section( 'colors' );
	
}

function muqaddimah_customize_register_home_page_layout( $wp_customize ){

	$wp_customize->add_section( 'home_page_layout' , array(
		'title'      => __( 'Home Page', 'muqaddimah' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'home_page',
		array(
			'default' => 'all_posts',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	 
	$wp_customize->add_control(
		'home_page',
		array(
			'type' => 'radio',
			'label' => 'Home page layout',
			'section' => 'home_page_layout',
			'choices' => array(
				'all_posts' => 'All Posts',
				'all_categories' => 'All Categories',			
				'featured_posts' => 'Featured Posts',			
				'featured_c' => 'Selected Categories (see below)',
				'featured_c_and_p' => 'Selected Categories (see below) and featured posts',		
				'featured_p_and_c' => 'Selected Categories (see below) and featured posts',		
			),
		)
	);
	
	$post_categories = get_categories( array('exclude' => get_option("muqaddimah_featured"), 'hide_empty' => 0) );
	
	foreach($post_categories as $c){
	
		$cat = get_category( $c );
				
		$wp_customize->add_setting(
			'category_' . $c->term_id,
			array(
				'default' => 'on',
				'sanitize_callback' => 'muqaddimah_sanitize_text',
			)
		);
		 
		$wp_customize->add_control(
			'category_' . $c->term_id,
			array(
				'type' => 'radio',
				'label' => 'Display Category - ' . $cat->name,
				'section' => 'home_page_layout',
				'choices' => array(
					"on" => "Display",
					"off" => "Don't display"
				),
			)
		);

	}
	
}

function muqaddimah_customize_register_long_description( $wp_customize ){

	$wp_customize->add_section( 'long_description_area' , array(
		'title'      => __( 'Site Description', 'muqaddimah' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'long_description',
		array(
			'default' => 'Enter a description here',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	 
	$wp_customize->add_control(
		'long_description',
		array(
			'type' => 'textarea',
			'label' => 'Home page site description',
			'section' => 'long_description_area',
		)
	);
	
}

function muqaddimah_customize_register_non_index_menu( $wp_customize ){

	$wp_customize->add_section( 'non_front_menu' , array(
		'title'      => __( 'Non-front page Menu', 'muqaddimah' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'non_front_menu',
		array(
			'default' => 'Enter HTML here',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	 
	$wp_customize->add_control(
		'non_front_menu',
		array(
			'type' => 'textarea',
			'label' => 'Extra menu for every page bar the front',
			'section' => 'non_front_menu',
		)
	);
	
}


function muqaddimah_customize_register_page_layout( $wp_customize ){

	$wp_customize->add_section( 'page_layout' , array(
		'title'      => __( 'Page Layout', 'muqaddimah' ),
		'priority'   => 2,
	) );
	
	$wp_customize->add_setting(
		'menu_type',
		array(
			'default' => 'menu_standard',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	 
	$wp_customize->add_control(
		'menu_type',
		array(
			'type' => 'radio',
			'label' => 'Menu Type',
			'section' => 'page_layout',
			'choices' => array(
				'menu_standard' => 'Menu standard drop down',
				'menu_slide' => 'Menu slides in from left'		
			),
		)
	);
	
	$wp_customize->add_setting(
		'pagination',
		array(
			'default' => 'on',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	 
	$wp_customize->add_control(
		'pagination',
		array(
			'type' => 'radio',
			'label' => 'Display pagination',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	$wp_customize->add_setting(
		'search',
		array(
			'default' => 'on',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	 
	$wp_customize->add_control(
		'search',
		array(
			'type' => 'radio',
			'label' => 'Display Search',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	$wp_customize->add_setting(
		'author',
		array(
			'default' => 'on',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	 
	$wp_customize->add_control(
		'author',
		array(
			'type' => 'radio',
			'label' => 'Display Author',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
}

function muqaddimah_customize_register_fav_icon( $wp_customize ){
	
	$wp_customize->add_section( 'fav_icon' , array(
		'title'      => __( 'Fav Icon', 'muqaddimah' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'fav_icon_url',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'fav_icon_url',
			array(
				'label' => 'Fav Icon',
				'section' => 'fav_icon',
				'settings' => 'fav_icon_url'
			)
		)
	);
	
}

function muqaddimah_customize_register_add_site_colours( $wp_customize ) {
	
	$wp_customize->add_section( 'site_colours' , array(
		'title'      => __( 'Site Colours', 'muqaddimah' ),
		'priority'   => 30,
	) );
	
	$wp_customize->add_setting(
		'site_allsite_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_allsite_background_colour',
			array(
				'label' => 'Site background colour',
				'section' => 'site_colours',
				'settings' => 'site_allsite_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alllink_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alllink_colour',
			array(
				'label' => 'Site Link Colour',
				'section' => 'site_colours',
				'settings' => 'site_alllink_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alllink_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alllink_hover_colour',
			array(
				'label' => 'Site Link Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_alllink_hover_colour'
			)
		)
	);

	
	$wp_customize->add_setting(
		'site_post_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_post_background_colour',
			array(
				'label' => 'Site Post Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_post_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alltext_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alltext_colour',
			array(
				'label' => 'Site Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_alltext_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_content_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_content_text_colour',
			array(
				'label' => 'Site Content Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_content_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_footer_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_footer_colour',
			array(
				'label' => 'Site Footer Colour',
				'section' => 'site_colours',
				'settings' => 'site_footer_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_background_colour',
			array(
				'label' => 'Site Menu Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_background_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_background_hover_colour',
			array(
				'label' => 'Site Menu Background Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_background_hover_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_background_current_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_background_current_colour',
			array(
				'label' => 'Site Menu Current Page Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_background_current_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_text_colour',
			array(
				'label' => 'Site Menu Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_text_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_text_hover_colour',
			array(
				'label' => 'Site Menu Text Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_text_hover_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_header_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_header_colour',
			array(
				'label' => 'Site Header Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_header_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_header_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_header_text_colour',
			array(
				'label' => 'Site Header Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_header_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_title_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_colour',
			array(
				'label' => 'Site Title Colour',
				'section' => 'site_colours',
				'settings' => 'site_title_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_button_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_button_colour',
			array(
				'label' => 'Site Button Colour',
				'section' => 'site_colours',
				'settings' => 'site_button_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_button_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_button_text_colour',
			array(
				'label' => 'Site Button Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_button_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_shadow_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_shadow_colour',
			array(
				'label' => 'Site Shadow Colour',
				'section' => 'site_colours',
				'settings' => 'site_shadow_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_fade_to_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'muqaddimah_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_fade_to_colour',
			array(
				'label' => 'Site Fade to Colour',
				'section' => 'site_colours',
				'settings' => 'site_fade_to_colour'
			)
		)
	);
	
}

function muqaddimah_customize_register( $wp_customize ) {

	muqaddimah_customize_register_modify( $wp_customize );
	muqaddimah_customize_register_long_description( $wp_customize );
	muqaddimah_customize_register_add_site_colours( $wp_customize );
	muqaddimah_customize_register_page_layout( $wp_customize );
	muqaddimah_customize_register_home_page_layout( $wp_customize );
	muqaddimah_customize_register_fav_icon( $wp_customize );
	muqaddimah_customize_register_non_index_menu( $wp_customize );
	
}
add_action( 'customize_register', 'muqaddimah_customize_register' );


function muqaddimah_customize_preview_js() {
	wp_enqueue_script( 'muqaddimah_customizer', get_template_directory_uri() . '/js/muqaddimah_customiser.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'muqaddimah_customize_preview_js' );

