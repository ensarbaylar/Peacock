<section class="entry-summary">
	<section>
		<p class="meta"><?php peacock_posted_on(); ?></p>
	</section>
	<?php if ( has_post_thumbnail() ) :
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
    <header class="summary-head-wrapper" style="background-color: #404040; background-image: url('<?php echo $feat_image; ?>')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading cta-header">
                        <h2 class="entry-title"><?php the_title(); ?></h2>
						<?php if ( function_exists( 'the_subtitle' ) ) {
							the_subtitle( '<h2 class="subheading">', '</h2>' );
						} ?>
                    </div>
                </div>
            </div>
    </header>
    </a>
	<?php else:?>
		<?php echo '<h2 class="entry-title">'; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a><?php echo '</h2>'; edit_post_link(); ?>
	<?php endif;?>
	<?php the_excerpt(); ?>
	<?php if( is_search() ) { ?><div class="entry-links"><?php wp_link_pages(); ?></div><?php } ?>
</section>