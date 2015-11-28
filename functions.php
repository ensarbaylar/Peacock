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