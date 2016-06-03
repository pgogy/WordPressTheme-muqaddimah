<?php if ( have_posts() ) : 

	muqaddimah_author_title();
	
	while ( have_posts() ) : the_post();

		get_template_part( 'parts/content/content-author');

	endwhile;
	
	muqaddimah_featured_posts_content("author", $_GET['author']);
	
	get_template_part('parts/pagination/pagination');
	
else :

	get_template_part( 'content', 'none' );

endif;

?>