<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
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
	<?php peacock_header(); ?>