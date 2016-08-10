<?php
/* Setup theme */
add_action( 'after_setup_theme', 'peacock_setup' );
function peacock_setup()
{
	load_theme_textdomain( 'peacock' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	$args = array(
        'default-image'      => get_template_directory_uri() . 'assets/img/bg-default.jpg',
        'default-text-color' => '000',
        'width'              => 1200,
        'height'             => 800,
        'flex-width'         => true,
        'flex-height'        => true,
        'header-text'		 => false,
    );
    add_theme_support( 'custom-header', $args );

	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;

	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'peacock' ) )
	);

	// Register Custom Navigation Walker
	require_once('libs/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php');

}

/* Load css and javascript files */
add_action( 'wp_enqueue_scripts', 'peacock_load_scripts' );
function peacock_load_scripts()
{
	/* Load Normalize Css */
	wp_enqueue_style( 'normalize-min-css', get_template_directory_uri() . '/assets/css/normalize.min.css' );
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

	/* Add Google Font:Lato */
	wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Lato:400,300,700&subset=latin,latin-ext');
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
		$comments = get_comments( array('status' => 'approve', 'post_id' => $id ) );
		$comments_by_type = separate_comments( $comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

function peacock_posted_on() {
	
	global $author_id;
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