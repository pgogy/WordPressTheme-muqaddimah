<article id="post-<?php the_ID(); ?>" <?php post_class("home-page"); ?> style="<?php muqaddimah_post_thumbnail_background(); ?>" >
	<header class="entry-header">
		<h2 style="<?PHP muqaddimah_post_title_background(); ?>" class="entry-title">
			<a href="<?PHP echo get_permalink(); ?>" rel="bookmark"><?PHP echo the_title(); ?></a>
		</h2>
	</header><!-- .entry-header -->
</article><!-- #post-## -->