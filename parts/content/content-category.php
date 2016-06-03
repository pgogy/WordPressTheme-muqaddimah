<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="<?php muqaddimah_post_thumbnail_background(); ?>" >
	<header class="entry-header">
		<h2 style="<?PHP muqaddimah_post_title_background(); ?>" class="entry-title category-page">
			<a href="<?PHP echo get_permalink(); ?>" rel="bookmark">
				<?php muqaddimah_post_thumbnail(); ?>
				<?PHP 

					if(strlen(get_the_title())>50){
						?><span style='font-size:15px'><?PHP echo the_title(); ?></span><?PHP;
					}else{
						the_title();
					}		

				?>
			</a>
		</h2>
	</header><!-- .entry-header -->
</article><!-- #post-## -->