<?php get_header(); ?>
<article class="site-container" id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="site-container">
	<?php 		
	if ( ( is_archive() || is_search() ) || !is_singular() ) {
		get_template_part('template-parts/entry', 'summary');
	}else {
		get_template_part('template-parts/entry', 'content');
	}
	?>
	<?php if ( is_singular() ) get_template_part( 'template-parts/entry', 'meta' ); ?>
	<?php if ( !is_search() ) get_template_part( 'template-parts/entry', 'footer' ); ?>
	</div>
</article>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
<footer class="footer">
<?php get_template_part( 'template-parts/nav', 'below-single' ); ?>
</footer>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>