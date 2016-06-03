<article id="post-<?php the_ID(); ?>">
	<header class="entry-header" style="<?php muqaddimah_post_colour_background(); ?>">
		<h1 class="entry-title">
			<?PHP
				echo sprintf(
					 __( 'Sorry, Nothing found for %s', 'muqaddimah' ), $_GET['s']
				);
			?>
		</h1>
	</header>
</article><!-- #post-## -->
