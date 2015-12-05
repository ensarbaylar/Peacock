<?php
add_action( 'after_setup_theme', 'peacock_setup' );
function peacock_setup()
{
	load_theme_textdomain( 'peacock', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;

	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'peacock' ) )
	);

	// Register Custom Navigation Walker
	require_once('libs/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php');
}

add_action( 'wp_enqueue_scripts', 'peacock_load_scripts' );
function peacock_load_scripts()
{
	/* Load Twitter Bootstrap */
	wp_enqueue_style( 'bootstrap-min-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	/* Load Main Style Sheet */
	wp_enqueue_style( 'peacock-style', get_stylesheet_uri() );

	/* Load jQuery */
	wp_enqueue_script( 'jquery' );
	/* Load Bootstrap JavaScript */
	wp_enqueue_script( 'bootstrap-min-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ) );
	/* Load Main JavaScript */
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ) );
}

add_action('wp_print_styles', 'load_fonts');
function load_fonts() {
	wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Lato:400,300,700');
	wp_enqueue_style( 'googleFonts');
}

add_action( 'comment_form_before', 'peacock_enqueue_comment_reply_script' );
function peacock_enqueue_comment_reply_script()
{
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'peacock_title' );
function peacock_title( $title ) 
{
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'peacock_filter_wp_title' );
function peacock_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'peacock_widgets_init' );
function peacock_widgets_init()
{
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'peacock' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

function peacock_custom_pings( $comment )
{
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}

add_filter( 'get_comments_number', 'peacock_comments_number' );
function peacock_comments_number( $count )
{
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

if( ! function_exists( 'peacock_header' ) ) :
/*
 * Add the fullscreen Image To the top of the page
 */
function peacock_header() 
{	
	if(is_single()) { ?>
	
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
	<?php
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
	<section>
		<p class="meta"><?php peacock_posted_on(); ?></p>
	</section>
    <header class="main-head-wrapper" style="background-color: #404040; background-image: url('<?php echo $feat_image; ?>')">
        <div class="main-head-holder">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading cta-header">
                        <h1><?php single_post_title(); ?></h1>
			<?php if ( function_exists( 'the_subtitle' ) ) {
				the_subtitle( '<p class="subheading">', '</p>' );
			} ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
	
	<?php } elseif(is_page()) { ?>
	
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
	<?php
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
    <header class="main-head-wrapper" style="background-color: #404040; background-image: url('<?php echo $feat_image; ?>')">
        <div class="main-head-holder">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading cta-header">
                        <h1><?php single_post_title(); ?></h1>
                        <hr class="small">
			<?php if ( function_exists( 'the_subtitle' ) ) {
				the_subtitle( '<p class="subheading">', '</p>' );
			} ?>
                    </div>
					<!-- /.site-heading -->
                </div>
				<!-- /.col-lg-8.col-lg-offset-2.col-md-10.col-md-offset-1 -->
            </div>
			<!-- /.row -->
        </div>
		<!-- /.container -->
    </header>
	
	<?php } elseif(is_search()) { ?>
	
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
	<?php if (get_theme_mod('peacock_homepage_image') !='') { ?>
	<?php $headerimg = get_theme_mod( 'peacock_homepage_image' ); ?>
	<?php } else { ?>
	<?php $headerimg = get_theme_mod( 'peacock_mainheader_image' ); ?>
	<?php } ?>
    <header class="main-head-wrapper" style="background-color: #404040; background-image: url('<?php echo $headerimg; ?>')">
        <div class="main-head-holder">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading cta-header">
                        <h1><?php esc_html_e( 'Search Results', 'peacock' ); ?></h1>
                        <hr class="small">
                        <p class="subheading"><?php printf( esc_html__( 'You searched for: "%s"', 'peacock' ), '<span>' . get_search_query() . '</span>' ); ?></p>
                    </div>
		    <!-- /.site-heading -->
                </div>
		<!-- /.col-lg-8.col-lg-offset-2.col-md-10.col-md-offset-1 -->
            </div>
	<!-- /.row -->
        </div>
	<!-- /.container -->
    </header>
	
	<?php } else { ?>
	
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
	<?php if (get_theme_mod('peacock_mainheader_image') !='') { ?>
	<?php $headerimg = get_theme_mod( 'peacock_mainheader_image' ); ?>
	<?php } else { ?>
	<?php $headerimg = get_template_directory_uri() . '/assests/img/bg-default.jpg'; ?>
	<?php } ?>
    <header class="main-head-wrapper" style="background-color: #dedede; background-image: url('<?php echo $headerimg; ?>')">
        <div class="main-head-holder">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading cta-header">
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
                    </div>
		    <!-- /.site-heading -->
                </div>
		<!-- /.col-lg-8.col-lg-offset-2.col-md-10.col-md-offset-1 -->
            </div>
	    <!-- /.row -->
        </div>
	<!-- /.container -->
    </header>

	<?php } ?>
	
<?php 
}
endif;

function peacock_posted_on() {
	
	$author_id;
	if (is_singular()) {
		$author_id = get_queried_object()->post_author;
	}
	
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'peacock' ),
		$time_string
	);

	$byauthor = sprintf('<a class="author-header-url" href="%1$s" title="%2$s" rel="author"><span class="author vcard">%3$s</span></a>',
		esc_url( get_author_posts_url( get_the_author_meta('ID', $author_id) ) ),
		esc_attr( get_the_author_meta("display_name", $author_id) ),
		get_the_author_meta("display_name", $author_id)
	);

	$author_avatar = sprintf('<a class="author-header-avatar" href="%1$s" title="%2$s" rel="author">%3$s</a>',
		esc_url( get_author_posts_url( get_the_author_meta('ID', $author_id) ) ),
		esc_attr( get_the_author_meta("display_name", $author_id) ),
		get_avatar( $author_id )
	);

	echo '<section class="site-container"><div class="header-blocks">' . $author_avatar . '</div><div class="header-blocks">' .  $byauthor . '<span class="posted-on">' . $posted_on . '</span></div></section><div class="clearfix"></div>'; // WPCS: XSS OK.

}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';