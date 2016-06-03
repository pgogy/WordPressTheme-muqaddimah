<?php

get_header(); 

?>	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main"><?PHP

			query_posts( $query_string . '&order=ASC' );
		
			get_template_part( 'parts/category/all_posts'); 
	
		?></main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
