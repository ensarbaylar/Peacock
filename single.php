<?php get_header(); ?>
<article class="site-container" id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
<footer class="footer">
<?php get_template_part( 'nav', 'below-single' ); ?>
</footer>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>