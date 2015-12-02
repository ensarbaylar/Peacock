<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="site-container">
		<?php get_template_part( 'entry', ( ( is_archive() || is_search() ) || !is_singular() ? 'summary' : 'content' ) ); ?>
		<?php if ( is_singular() ) get_template_part( 'entry', 'meta' ); ?>
		<?php if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
	</div>
</article>