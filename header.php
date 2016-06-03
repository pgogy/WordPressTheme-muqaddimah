<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<?PHP
	get_template_part( 'parts/header/main');
?>
<body <?php body_class(muqaddimah_body_class()); ?>>
	<div id="page" class="hfeed site">
		<div id="header-area" class="sidebar sidebar-centre">
			<header id="masthead" class="site-header" role="banner" <?PHP muqaddimah_header_image(); ?>>
				<div class="site-branding">
				<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?PHP echo get_bloginfo('name'); ?></a></h1>
						<p class="description"><?PHP echo get_theme_mod("long_description"); ?></p>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?PHP echo get_bloginfo('name'); ?></a></p>
					<?php endif;
				?>
				</div><!-- .site-branding -->
			</header><!-- .site-header -->
			<?PHP
				if(!is_home()){
					?><div class="non_front_menu"><?PHP
						echo get_theme_mod("non_front_menu");
					?></div><?PHP
				}
			?>
		</div><!-- .sidebar -->
		<div id="content" class="site-content">
