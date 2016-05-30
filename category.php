<?php get_header(); ?>
<section class="site-container" id="content" role="main">
<header class="header">
<h1 class="entry-title"><?php _e( 'Category Archives: ', 'peacock' ); ?><?php single_cat_title(); ?></h1>
<?php if ( '' != category_description() ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . category_description() . '</div>' ); ?>
</header>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 
	if ( ( is_archive() || is_search() ) || !is_singular() ) {
		get_template_part('template-parts/entry', 'summary');
	}else {
		get_template_part('template-parts/entry', 'content');
	}
?>
<?php endwhile; endif; ?>
<?php get_template_part( 'template-parts/nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>