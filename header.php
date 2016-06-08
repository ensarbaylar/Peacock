<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
	<!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'peacock' ); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<?php if ( is_front_page() && is_home() ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
            </div>
            <div class="hidden-xs" id="site-description"><?php bloginfo( 'description' ); ?></div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li>
			            <div id="search">
							<?php get_search_form(); ?>
						</div>
					</li>
					<?php wp_nav_menu( 
						array(
							'theme_location' => 'main-menu', 
							'items_wrap' => '%3$s', 
							'container' => false,
			                'depth' => 2,
			                'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
			                'walker' => new wp_bootstrap_navwalker()
                		) 
                	); ?>
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header>
<div id="container">
	<?php
	if( is_single() || is_page() ){

		$post_thumbnail = get_post_thumbnail_id($post->ID);
		
		if( ! empty( $post_thumbnail ) ){
		
			$headerimg = wp_get_attachment_url( $post_thumbnail );
		
		}elseif ( get_header_image() ) {

			$image = get_header_image();
			$headerimg = esc_url( $image );

		} else {
			
			$headerimg = get_template_directory_uri() . '/assets/img/bg-default.jpg';

		}
	}else{
		if ( get_header_image() ) {

			$image = get_header_image();
			$headerimg = esc_url( $image );
			
		} else {
			$headerimg = get_template_directory_uri() . '/assets/img/bg-default.jpg';
		} 
	}
	?>
	<!-- Page Header -->
    <header class="main-head-wrapper" style="background-color: #dedede; background-image: url('<?php echo $headerimg; ?>')">
        <div class="main-head-holder">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading cta-header">
                    <?php if( is_single() || is_page() ): ?>
	                    <h1><?php single_post_title(); ?></h1>
						<?php if ( function_exists( 'the_subtitle' ) ) {
                        	?><hr class="small"><?php
							the_subtitle( '<p class="subheading">', '</p>' );
						} ?>
					<?php elseif( is_search() ):?>
						<h1><?php esc_html_e( 'Search Results', 'peacock' ); ?></h1>
                        <hr class="small">
                        <p class="subheading"><?php printf( esc_html__( 'You searched for: "%s"', 'peacock' ), '<span>' . get_search_query() . '</span>' ); ?></p>
					<?php else:?>
						<?php if (get_theme_mod('peacock_mainheader_title') !='') { ?>
						<h2 class="homeintro"><?php echo get_theme_mod( 'peacock_mainheader_title' ); ?></h2>
						<?php } else { ?>
			                        <h2><?php esc_html_e( 'Wordpress With Peacock', 'peacock' ); ?></h2>
						<?php } ?>
			                        <hr class="small">
						<?php if (get_theme_mod('peacock_mainheader_subtitle') !='') { ?>
			                        <p class="subheading"><?php echo get_theme_mod( 'peacock_mainheader_subtitle' ); ?></p>
						<?php } else { ?>
			                        <p class="subheading"><?php esc_html_e( 'Life is short', 'peacock' ); ?></p>
						<?php } ?>
					<?php endif;?>
                    </div>
		    <!-- /.site-heading -->
                </div>
		<!-- /.col-lg-8.col-lg-offset-2.col-md-10.col-md-offset-1 -->
            </div>
	    <!-- /.row -->
        </div>
	<!-- /.container -->
    </header>