<?php 

/**
 * Registers options with the Theme Customizer
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    peacock
 * @since      1.0.0
 * @version    1.0.0
 */

function peacock_register_theme_customizer( $wp_customize ) {
	
	$wp_customize->add_section(
		'peacock_mainheader_options',
		array(
			'title'     => 'Main Header Section',
			'priority'  => 20
		)
	);
	
	/* Background Image */
	$wp_customize->add_setting(
		'peacock_mainheader_image',
		array(
		    'default'     		 => get_template_directory_uri() . '/assets/img/bg-default.jpg',
			'sanitize_callback'  => 'peacock_sanitize_input',
		    'transport'   		 => 'refresh'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'peacock_mainheader_image',
			array(
			    'label'    => 'Background Image',
			    'settings' => 'peacock_mainheader_image',
			    'section'  => 'peacock_mainheader_options'
			)
		)
	);
	
	/* Home Cta Title */
	$wp_customize->add_setting(
		'peacock_mainheader_title',
		array(
			'default'            => 'Wordpress With Peacock',
			'sanitize_callback'  => 'peacock_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'peacock_mainheader_title',
		array(
			'section'  => 'peacock_mainheader_options',
			'label'    => 'Title',
			'type'     => 'text'
		)
	);
	
	/* Home Cta Subtitle */
	$wp_customize->add_setting(
		'peacock_mainheader_subtitle',
		array(
			'default'            => 'Life is short',
			'sanitize_callback'  => 'peacock_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'peacock_mainheader_subtitle',
		array(
			'section'  => 'peacock_mainheader_options',
			'label'    => 'Subtitle',
			'type'     => 'text'
		)
	);
	
} // end peacock_register_theme_customizer
add_action( 'customize_register', 'peacock_register_theme_customizer' );

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string    $input    The string to sanitize
 * @return     string              The sanitized string
 * @package    peacock
 * @since      1.0.0
 * @version    1.0.0
 */
function peacock_sanitize_input( $input ) {
	return strip_tags( stripslashes( $input ) );
} // end peacock_sanitize_input

function peacock_sanitize_copyright( $input ) {
	$allowed = array(
		's'			=> array(),
		'br'		=> array(),
		'em'		=> array(),
		'i'			=> array(),
		'strong'	=> array(),
		'b'			=> array(),
		'a'			=> array(
			'href'			=> array(),
			'title'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'form'		=> array(
			'id'			=> array(),
			'class'			=> array(),
			'action'		=> array(),
			'method'		=> array(),
			'autocomplete'	=> array(),
			'style'			=> array(),
		),
		'input'		=> array(
			'type'			=> array(),
			'name'			=> array(),
			'class' 		=> array(),
			'id'			=> array(),
			'value'			=> array(),
			'placeholder'	=> array(),
			'tabindex'		=> array(),
			'style'			=> array(),
		),
		'img'		=> array(
			'src'			=> array(),
			'alt'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
			'height'		=> array(),
			'width'			=> array(),
		),
		'span'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'p'			=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'div'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'blockquote' => array(
			'cite'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
	);
    return wp_kses( $input, $allowed );
} // end peacock_sanitize_copyright

/**
 * Writes styles out the `<head>` element of the page based on the configuration options
 * saved in the Theme Customizer.
 *
 * @since      1.0.0
 * @version    1.0.0
 */
function peacock_customizer_css() {
?>
	<style type="text/css">
		-moz-selection,
		::selection{
			background: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}
		body{
			webkit-tap-highlight-color: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}
		a:hover {
			color: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}
		.pager li>a:hover, .pager li>a:focus {
			color: #fff;
			background-color: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
			border: 1px solid <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}

		button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover {
			background: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
			border-color: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}

		button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		button:active,
		input[type="button"]:active,
		input[type="reset"]:active,
		input[type="submit"]:active {
			background: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
			border-color: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}
		
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		textarea:focus {
			border: 1px solid <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}
		
		.navbar-custom.is-fixed .nav li a:hover, .navbar-custom.is-fixed .nav li a:focus {
			color: <?php echo get_theme_mod( 'peacock_link_color' ); ?>;
		}
	</style>
<?php
} // end peacock_customizer_css
add_action( 'wp_head', 'peacock_customizer_css' );
/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 * @package    peacock
 * @since      1.0.0
 * @version    1.0.0
 */
function peacock_customizer_live_preview() {
	wp_enqueue_script(
		'peacock-theme-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		'1.0.0',
		true
	);
} // end peacock_customizer_live_preview
add_action( 'customize_preview_init', 'peacock_customizer_live_preview' );
