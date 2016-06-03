<?php 

	global $query_string;
	query_posts( $query_string . '&order=ASC&orderby=title' );

	if ( have_posts() ) :

	muqaddimah_archive_title();

	while ( have_posts() ) : the_post();

		get_template_part( 'parts/content/content-category');

	endwhile;
	
	get_template_part('parts/pagination/pagination');
	
	muqaddimah_featured_posts_content("category", $_GET['cat']);
	
else :

	get_template_part( 'content', 'none' );

endif;

?>