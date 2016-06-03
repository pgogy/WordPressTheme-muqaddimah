<article id="post-<?php the_ID(); ?>">
	<header class="entry-header" style="<?php muqaddimah_post_colour_background(); ?>">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'muqaddimah' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'muqaddimah' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'muqaddimah' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer" style="<?php muqaddimah_post_colour_background(); ?>">
		<?php muqaddimah_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'muqaddimah' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?PHP

	get_sidebar('sidebar-right');

?>