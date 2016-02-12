<?php
/**
 * FitClub functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package FitClub
 */

if ( ! function_exists( 'fitclub_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fitclub_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on FitClub, use a find and replace
	 * to change 'fitclub' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'fitclub', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'fitclub' ),
		'social'  => esc_html__( 'Social Menu', 'fitclub' ),
		'footer'  => esc_html__( 'Footer Menu', 'fitclub' )
	) );
	// Register image sizes for use in widgets
	add_image_size( 'fitclub-about', 576, 341, true );
	add_image_size( 'fitclub-testimonial', 240, 240, true );
	add_image_size( 'fitclub-team', 375, 450, true );
	add_image_size( 'fitclub-featured-image', 380, 240, true );
	add_image_size( 'fitclub-featured-post', 870, 435, true);
	add_image_size( 'fitclub-slider-thumb', 75, 75, true );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fitclub_custom_background_args', array(
		'default-color' => '161616',
		'default-image' => '',
	) ) );

	// Add excerpt field for page
	add_post_type_support( 'page', 'excerpt' );
}
endif; // fitclub_setup
add_action( 'after_setup_theme', 'fitclub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fitclub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fitclub_content_width', 640 );
}
add_action( 'after_setup_theme', 'fitclub_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function fitclub_scripts() {
	wp_enqueue_style( 'fitclub-google-font', '//fonts.googleapis.com/css?family=Open+Sans' );

	wp_enqueue_style( 'fitclub-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/fontawesome/css/font-awesome.css', array(), '4.2.1' );

	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), true );

	wp_enqueue_script( 'fitclub-custom', get_template_directory_uri() . '/js/fitclub-custom.js', array('jquery'), true );

	$fitclub_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$fitclub_user_agent)) {
		wp_enqueue_script( 'html5', get_template_directory_uri() . 'js/html5shiv.min.js', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fitclub_scripts' );
/**
 * Enqeue scripts in admin section for widgets.
 */
add_action('admin_enqueue_scripts', 'fitclub_admin_scripts');

function fitclub_admin_scripts( $hook ) {
	global $post_type;

	if( $hook == 'widgets.php' || $hook == 'customize.php' ) {
		// Image Uploader
		wp_enqueue_media();
		wp_enqueue_script( 'fitclub-script', get_template_directory_uri() . '/js/image-uploader.js', false, '1.0', true );
		// Color Picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'fitclub-color-picker', get_template_directory_uri() . '/js/color-picker.js', array( 'wp-color-picker' ), false);
	}

	if( $post_type == 'page' ) {
		wp_enqueue_script( 'fitclub-meta-toggle', get_template_directory_uri() . '/js/metabox-toggle.js', false, '1.0', true );
	}
}
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Other Functions file.
 */
require get_template_directory() . '/inc/fitclub.php';

/**
 * Constant Definition
 */
define( 'FitClub_ADMIN_IMAGES_URL', get_template_directory_uri() . '/inc/admin/images');

/**
 * Design Related Metaboxes
 */
require get_template_directory() . '/inc/admin/meta-boxes.php';


/* Add Support for The Event Calendar Plugin by Modern Tribe */
if( class_exists( 'Tribe__Events__Main' ) ) {
	add_action( 'wp_footer', 'fitclub_events_scripts' );
	add_action( 'tribe_events_before_list_widget', 'fitclub_events_opening_div');
	add_action( 'tribe_events_before_list_widget', 'fitclub_events_closing_div');
	// Loads custom widget for events
	require get_template_directory() . '/inc/event-widget.php';
}
/**
 * The Event Calendar Widget Integration
 */
function fitclub_events_scripts(){ ?>
<script type="text/javascript">
if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {
	jQuery('.tg-events-wrapper').bxSlider({
		auto: true,
		pager: false,
		caption: true,
		nextText: '<i class="fa fa-angle-right"></i>',
		prevText: '<i class="fa fa-angle-left"></i>'
	});
}
</script>
<?php }
/**
 * The Event Calendar Div
 */
function fitclub_events_opening_div() {
	echo '<div class="tg-container">';
}

function fitclub_events_closing_div() {
	echo '</div>';
}
