<?php

function muqaddimah_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'muqaddimah_add_editor_styles' );

function muqaddimah_setup() {

	load_theme_textdomain( 'muqaddimah', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );
	
	add_theme_support( 'post-thumbnails' );
	
	$chargs = array(
		'width' => 980,
		'height' => 300,
		'uploads' => true,
	);
	
	if ( ! isset( $content_width ) ) $content_width = 900;
	
	add_theme_support( 'custom-header', $chargs );
	
	set_post_thumbnail_size( 825, 510, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'muqaddimah' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
add_action( 'after_setup_theme', 'muqaddimah_setup' );

function muqaddimah_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area Right', 'muqaddimah' ),
		'id'            => 'sidebar-right',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'muqaddimah' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Widget Area Bottom', 'muqaddimah' ),
		'id'            => 'sidebar-bottom',
		'description'   => __( 'Add widgets here to appear in your footer.', 'muqaddimah' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'muqaddimah_widgets_init' );
 
function muqaddimah_scripts_admin() {

	wp_enqueue_style( 'muqaddimah-colour-picker', get_template_directory_uri() . '/css/colour-picker/jquery.minicolors.css' );
	wp_enqueue_style('thickbox');		
	wp_enqueue_script('thickbox');
	
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'muqaddimah-picture-remove', get_template_directory_uri() . '/js/category/picture-remove.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'muqaddimah-colour-picker', get_template_directory_uri() . '/js/colour_picker/jquery.minicolors.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'muqaddimah-colour-picker-init', get_template_directory_uri() . '/js/colour_picker/jquery.minicolors.init.js', array( 'muqaddimah-colour-picker' ) );
} 
 
function muqaddimah_scripts() {

	wp_enqueue_style( 'muqaddimah-style', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'muqaddimah-style-custom', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'muqaddimah-core-style', get_template_directory_uri() . '/css/wp_core.css' );
	wp_enqueue_style( 'muqaddimah-style-mobile-1000', get_template_directory_uri() . '/css/mobile1000.css' );
	wp_enqueue_style( 'muqaddimah-style-mobile-768', get_template_directory_uri() . '/css/mobile768.css' );
	wp_enqueue_style( 'muqaddimah-style-mobile-400', get_template_directory_uri() . '/css/mobile400.css' );
	wp_enqueue_style( 'muqaddimah-main-menu-style', get_template_directory_uri() . '/css/menu/main-menu.css' );
	wp_enqueue_style( 'muqaddimah-slide-menu-style', get_template_directory_uri() . '/css/menu/slide-menu.css' );

	wp_enqueue_script( 'muqaddimah-colour-fade', get_template_directory_uri() . '/js/colour_fade/colour_fade.js', array( 'jquery' ) );
	wp_enqueue_script( 'muqaddimah-table-fix', get_template_directory_uri() . '/js/display/table_fix.js', array( 'jquery' ) );
	wp_enqueue_script( 'muqaddimah-squares', get_template_directory_uri() . '/js/front_page/make_squares.js', array( 'jquery' ) );
	wp_enqueue_script( 'muqaddimah-comments', get_template_directory_uri() . '/js/show_comments/show_comments.js', array( 'jquery' ) );
	wp_enqueue_script( 'muqaddimah-main-menu', get_template_directory_uri() . '/js/menus/main-menu.js', array( 'jquery' ) );
	wp_enqueue_script( 'muqaddimah-slide-menu', get_template_directory_uri() . '/js/menus/slide-menu.js', array( 'jquery' ) );
	wp_enqueue_script( 'muqaddimah-search-form', get_template_directory_uri() . '/js/search/search-form.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-effects-core', array( 'jQuery' ) );
	wp_enqueue_script( 'jquery-effects-slide', array( 'jQuery-effects-core' ) );
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	
}
add_action( 'wp_enqueue_scripts', 'muqaddimah_scripts' );
add_action( 'admin_enqueue_scripts', 'muqaddimah_scripts_admin' );

function muqaddimah_picture_category_edit_form_fields ($term) {
	$term_id = $term->term_id;
	$post = get_default_post_to_edit( 'post', true );
	$post_ID = $post->ID;
	?>
        <tr class="form-field">
			<th>Featured Image for this category</th>
            <td>
            	<div id="postimagediv" class="postbox" style="width:95%;" >
                    <div class="inside">
                        <?php wp_enqueue_media( array('post' => $post_ID) ); ?>
                        <?php
							$thumbnail_id = get_option( 'muqaddimah_picture_'.$term_id.'_thumbnail_id', 0 );
                            echo _wp_post_thumbnail_html( $thumbnail_id, $post_ID );
                        ?>
                    </div>
                    <input type="hidden" name="muqaddimah_picture_post_id" id="muqaddimah_picture_post_id" value="<?php echo $post_ID; ?>" />
                    <input type="hidden" name="muqaddimah_picture_term_id" id="muqaddimah_picture_term_id" value="<?php echo $term_id; ?>" />
                </div>
        	</td>
		</tr>
	<?php	
}
add_action('category_edit_form_fields','muqaddimah_picture_category_edit_form_fields');
add_action('post_tag_edit_form_fields','muqaddimah_picture_category_edit_form_fields');

function muqaddimah_picture_taxonomies_save_meta( $term ) {

	if ( isset( $_POST['muqaddimah_picture_post_id'] ) && $_POST['muqaddimah_picture_post_id'] !=""  ) {
		$default = $_POST['muqaddimah_picture_post_id'];
	}else if ( isset( $_POST['muqaddimah_picture_term_id'] ) ) {
		$default = $_POST['muqaddimah_picture_term_id'];
	}
	
	$thumbnail = get_post_meta( $default, '_thumbnail_id', true );

	if($thumbnail){
		update_option( 'muqaddimah_picture_' . $term . '_thumbnail_id', $thumbnail );
	}
}
add_action('edited_category', 'muqaddimah_picture_taxonomies_save_meta', 10, 2 );  
add_action('edited_post_tag', 'muqaddimah_picture_taxonomies_save_meta', 10, 2 );    

function muqaddimah_picture_ajax_set_post_thumbnail() {

	delete_option( 'muqaddimah_picture_' . $_POST['term_id'] . '_thumbnail_id' );
		
	$return = _wp_post_thumbnail_html( null, $_POST['post_id']);

	echo $return;
	
	die(0);
	
}
add_action('wp_ajax_simulacra-category-remove-image', 'muqaddimah_picture_ajax_set_post_thumbnail' );  

function muqaddimah_category_edit_form_fields ($term) {
	$term_id = $term->term_id;
	?>
        <tr class="form-field">
			<th>Colour for this category</th>
            <td>
            	<div id="postimagediv" class="postbox" style="width:95%;" >
					<?PHP
						$colour = get_option( 'muqaddimah_' . $term_id . '_colour');
					?>
					<input type="text" name="muqaddimah_post_colour" id="inline" class="demo minicolors-input" data-inline="true" value="<?PHP echo $colour; ?>" size="7">
                    <input type="hidden" name="muqaddimah_term_id" id="muqaddimah_term_id" value="<?php echo $term_id; ?>" />
                </div>
        	</td>
		</tr>
	<?php	
}
add_action('category_edit_form_fields','muqaddimah_category_edit_form_fields');
add_action('post_tag_edit_form_fields','muqaddimah_category_edit_form_fields');

function muqaddimah_taxonomies_save_meta( $term ) {

	if(isset($_POST["muqaddimah_post_colour"])){
		update_option( 'muqaddimah_' . $term . '_colour', $_POST["muqaddimah_post_colour"] );
	}
	
}
add_action('edited_category', 'muqaddimah_taxonomies_save_meta', 10, 2 );  
add_action('edited_post_tag', 'muqaddimah_taxonomies_save_meta', 10, 2 );     

function muqaddimah_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function muqaddimah_extra_style(){

	?><style>
	
		html{
			background-color: <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>;
			color: <?PHP echo get_theme_mod('site_alltext_colour'); ?>;
		}
	
		.single article{
			background-color: <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>;
		}
		
		footer#colophon
		{
			background-color: <?PHP echo get_theme_mod('site_footer_colour'); ?>;
		}
		
		.site-navigation ul li a{
			color :  <?PHP echo get_theme_mod('site_menu_text_colour'); ?>;
		}
		
		.site-navigation li a:hover, 
		.site-navigation li a:focus {
			color: <?PHP echo get_theme_mod('site_menu_text_hover_colour'); ?>;
		}
		
		.site-navigation li:hover, 
		.site-navigation li:focus {
			background-color: <?PHP echo get_theme_mod('site_menu_background_hover_colour'); ?>;
		}

		<?PHP
			$hex = muqaddimah_hex2rgb(get_theme_mod('site_menu_background_colour'));
		?>

		.site-navigation{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1); 
		}
		
		.site-navigation ul{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.8); 
		}
		
		.nav-menu-slide ul{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1); 
		}
		
		<?PHP
			$hex = muqaddimah_hex2rgb(get_theme_mod('site_shadow_colour'));
		?>
		
		#searchform form input[type=text],
		#commentform input[type=text],
		#commentform input[type=email],
		#commentform input[type=url],
		textarea{
			-webkit-box-shadow: inset 4px 4px 19px -3px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75);
			-moz-box-shadow:    inset 4px 4px 19px -3px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75);
			box-shadow:         inset 4px 4px 19px -3px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75);
			background-color: <?PHP echo get_theme_mod('site_menu_background_colour'); ?>;
		}
		
		.home article,
		.category article,
		.tag article,
		.search article,
		.author article,
		#primary-navigation ul ul,
		#main .comment-list .comment article,
		.single .entry-header,
		.single .entry-content,
		.single .entry-footer,
		.single .widget-area aside,
		#show_comment_area,
		footer#colophon div div div aside,
		footer#colophon nav{
			-webkit-box-shadow: 4px 4px 19px -3px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75);
			-moz-box-shadow:    4px 4px 19px -3px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75);
			box-shadow:         4px 4px 19px -3px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75);
		}
	
		header#masthead{
			background-color: <?PHP echo get_theme_mod('site_header_colour'); ?>; 
		}		
		
		h1, h2, h3, h4, h5, h6, summary, p, label,
		#bodyContent h1,
		#bodyContent h2,
		#bodyContent h3,
		#bodyContent h4,
		#bodyContent h5,
		#bodyContent h6{
			color: <?PHP echo get_theme_mod('site_alltext_colour'); ?>;
		}

		a{
			color: <?PHP echo get_theme_mod('site_alllink_colour'); ?>;
		}
		
		.home .page-footer h1 span{
			background-color: <?PHP echo get_theme_mod('site_post_background_colour'); ?>;
		}
		
		#content a:hover,
		#content a:focus{
			color: <?PHP echo get_theme_mod('site_alllink_hover_colour'); ?>;
		}
		
		.site-navigation ul li .current-menu-item a{
			background: <?PHP echo get_theme_mod('site_menu_background_current_colour'); ?>;  
			background-color: <?PHP echo get_theme_mod('site_menu_background_current_colour'); ?>;  
		}
		
		<?PHP
			$hex = muqaddimah_hex2rgb(get_theme_mod('site_content_background_colour'));
		?>
		
		footer.page-footer h1.page-title span.more{
			border-right: 2px solid <?PHP echo get_theme_mod('site_allsite_colour'); ?>;
		}
		
		.page-footer h1 a{
			color: <?PHP echo $hex; ?>;
			background-color: <?PHP echo get_theme_mod('site_allsite_colour'); ?>;
		}
		
		input[type=submit]{
			color: <?PHP echo get_theme_mod('site_allsite_colour'); ?>;
		}
		
		article,
		footer#colophon div div div aside,
		footer#colophon nav{
			background-color: <?PHP echo get_theme_mod('site_post_background_colour'); ?>;
		}
		
		nav form input[type=submit]{
			background-color: <?PHP echo get_theme_mod("site_title_colour"); ?>;
			border-color: <?PHP echo get_theme_mod("site_title_colour"); ?>;
			color: <?PHP echo get_theme_mod('site_allsite_colour'); ?>;
		}
		
		header#masthead h1 a,
		header#masthead p a{
			color: <?PHP echo get_theme_mod("site_title_colour"); ?>;
		}
		
		
		.entry-footer div h6.meta_label,
		.comments-title,
		.comment-reply-title,
		input[type=submit],
		.page-header .page-title,
		.#featured-content .page-title{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1);
		}
		
		.page-footer .pagination,
		.page-title,
		.featured-content .page-title,
		li.pingback div.comment-body,
		.single .entry-header,
		.single .entry-content,
		.single .entry-footer,
		#show_comment_area,
		.single .widget-area aside,
		#main .comment-list .comment article{
			background-color: <?PHP echo get_theme_mod("site_post_background_colour"); ?>;
		}
		
		#page #sidebar{
			background-color: <?PHP echo get_theme_mod("site_header_colour"); ?>;
		}
		
		button,
		input[type=submit]{
			background-color:  <?PHP echo get_theme_mod("site_button_colour"); ?>;
			color:  <?PHP echo get_theme_mod("site_button_text_colour"); ?>;
		}
		
	</style><?PHP

}
add_action("wp_head", "muqaddimah_extra_style");

function muqaddimah_excerpt_more( $excerpt ) {
	$parts = explode(" ", $excerpt);
	array_pop($parts);
	$replace ='<a href="' . get_post_permalink() . '">' . _x("read more", "Read more of this post", "muqaddimah") . "</a>";
	return implode(" ", $parts) . "... " . $replace;
}
add_filter( 'excerpt_more', 'muqaddimah_excerpt_more' );

function muqaddimah_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'muqaddimah_excerpt_length', 999 );

function muqaddimah_init(){

	if(!get_option("muqaddimah_setup_theme")){
	
		set_theme_mod('site_allsite_background_colour','#fefefe');
		set_theme_mod('site_alllink_colour','#a50000');
		set_theme_mod('site_alllink_hover_colour','#ff9999');
		set_theme_mod('site_post_background_colour','#ffffff');
		set_theme_mod('site_alltext_colour','#555555');
		set_theme_mod('site_content_text_colour','#555555');
		set_theme_mod('site_footer_colour','#fefefe');
		set_theme_mod('site_menu_background_colour','#fefefe');
		set_theme_mod('site_menu_background_hover_colour','#aaaaaa');
		set_theme_mod('site_menu_background_current_colour','#888888');
		set_theme_mod('site_menu_text_colour','#000000');
		set_theme_mod('site_menu_text_hover_colour','#dddddd');
		set_theme_mod('site_header_colour','#fefefe');
		set_theme_mod('site_header_text_colour','#555555');
		set_theme_mod('site_title_colour','#000000');
		set_theme_mod('site_button_colour','#000000');
		set_theme_mod('site_button_text_colour','#ff0000');
		set_theme_mod('site_shadow_colour','#000000');
		set_theme_mod('site_fade_to_colour','#000000');

		add_option("muqaddimah_setup_theme", 1);
	
	}

}
add_action("init", "muqaddimah_init");

function muqaddimah_featured_category_create(){

	if(!get_option("muqaddimah_featured")){

		$id = wp_create_category(_x("Featured Content", "Content chosen to be featured", "muqaddimah"));
		add_option("muqaddimah_featured", $id);
	
	}
		
}
add_action("admin_head", "muqaddimah_featured_category_create");

function muqaddimah_post_colour(){
	add_meta_box( "muqaddimah_post_colour", "Post Colour", "muqaddimah_post_colour_set", "post", "side");
}	
add_action("admin_head", "muqaddimah_post_colour");

function muqaddimah_save_post_colour(){
	if(isset($_POST["muqaddimah_post_colour"])){
		global $post;
		update_post_meta($post->ID, "muqaddimah_post_colour", $_POST["muqaddimah_post_colour"]);
	}
}
add_action("save_post", "muqaddimah_save_post_colour");

function muqaddimah_post_colour_set(){
	global $post;
	
	$colour = get_post_meta($post->ID, "muqaddimah_post_colour", true);
	?><input type="text" name="muqaddimah_post_colour" id="inline" class="demo minicolors-input" data-inline="true" value="<?PHP echo $colour; ?>" size="7"><?PHP
}

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/menus/Walker_Menu.php';
require get_template_directory() . '/inc/menus/Walker_Menu_Slide.php';
