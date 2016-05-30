<?php get_header(); ?>
<section class="site-container" id="content" role="main">
<header class="header">
<h1 class="entry-title"><?php 
if ( is_day() ) { printf( __( 'Daily Archives: %s', 'peacock' ), get_the_time( get_option( 'date_format' ) ) ); }
elseif ( is_month() ) { printf( __( 'Monthly Archives: %s', 'peacock' ), get_the_time( 'F Y' ) ); }
elseif ( is_year() ) { printf( __( 'Yearly Archives: %s', 'peacock' ), get_the_time( 'Y' ) ); }
else { _e( 'Archives', 'peacock' ); }
?></h1>
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