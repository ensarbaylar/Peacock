<?php get_header(); ?>
<section class="site-container" id="content" role="main">
<header class="header">
<?php the_post(); ?>
<h1 class="entry-title author"><?php _e( 'Author Archives', 'peacock' ); ?>: <?php the_author_link(); ?></h1>
<?php if ( '' != get_the_author_meta( 'user_description' ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . get_the_author_meta( 'user_description' ) . '</div>' ); ?>
<?php rewind_posts(); ?>
</header>
<?php while ( have_posts() ) : the_post(); ?>
<?php
	if ( ( is_archive() || is_search() ) || !is_singular() ) {
		get_template_part('template-parts/entry', 'summary');
	}else {
		get_template_part('template-parts/entry', 'content');
	}
?>
<?php endwhile; ?>
<?php get_template_part( 'template-parts/nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>