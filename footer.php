</div><!-- .site-content -->
	<?PHP
		
		switch(get_theme_mod('menu_type')){
			case 'menu_standard' : get_template_part( 'parts/header/menu/standard'); break;
			case 'menu_slide' : get_template_part( 'parts/header/menu/slide'); break;
			default : get_template_part( 'parts/header/menu/standard');  break;
		}
	
	?>
	<?PHP
		get_template_part( 'parts/search-form/standard');
		
	?>	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="footer-content">
			<?PHP
				get_sidebar("sidebar-bottom");
			?>
		</div>
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
