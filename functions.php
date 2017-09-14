<?php
/**
 * FitClub functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package FitClub
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
   $content_width = 870;
/**
 * $content_width global variable adjustment as per layout option.
 */
function fitclub_content_width() {
   global $post;
   global $content_width;
   if( $post ) { $layout_meta = get_post_meta( $post->ID, 'fitclub_page_layout', true ); }
   if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
   $fitclub_default_layout = get_theme_mod( 'fitclub_default_layout', 'right_sidebar' );
   if( $layout_meta == 'default_layout' ) {
      if ( $fitclub_default_layout == 'no_sidebar_full_width' ) { $content_width = 1200; /* pixels */ }
      else { $content_width = 870; /* pixels */ }
   }
   elseif ( $layout_meta == 'no_sidebar_full_width' ) { $content_width = 1200; /* pixels */ }
   else { $content_width = 870; /* pixels */ }
}
add_action( 'template_redirect', 'fitclub_content_width' );



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
	// Adds the support for the Custom Logo introduced in WordPress 4.5
	add_theme_support( 'custom-logo', array(
		'flex-width' => true,
		'flex-height' => true,
	));

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
 * Enqueue scripts and styles.
 */
function fitclub_scripts() {
	wp_enqueue_style( 'fitclub-google-font', '//fonts.googleapis.com/css?family=Open+Sans' );

	wp_enqueue_style( 'fitclub-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/fontawesome/css/font-awesome.css', array(), '4.2.1' );

	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), true );

	wp_enqueue_script( 'fitclub-custom', get_template_directory_uri() . '/js/fitclub-custom.js', array('jquery'), true );

	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.2', false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lte IE 8' );

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

/**
 * Custom Header
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load TGMPA Configs.
 */
require get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgm-plugin-activation/tgmpa-fitclub.php';

/**
 * Load Demo Importer Configs.
 */
if ( class_exists( 'TG_Demo_Importer' ) ) {
	require get_template_directory() . '/inc/demo-config.php';
}

/**
 * FitClub About Page
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-fitclub-admin.php';
}


/* Add Support for The Event Calendar Plugin by Modern Tribe */
if( class_exists( 'Tribe__Events__Main' ) ) {
	add_action( 'wp_footer', 'fitclub_events_scripts', 100 );
	add_action( 'tribe_events_before_list_widget', 'fitclub_events_opening_div');
	add_action( 'tribe_events_after_list_widget', 'fitclub_events_closing_div');
	// Loads custom widget for events
	require get_template_directory() . '/inc/event-widget.php';
}
/**
 * The Event Calendar Widget Integration
 */
function fitclub_events_scripts(){ ?>
<script type="text/javascript">
if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {
	jQuery('.tg-tribe-events-list-widget .tg-events-wrapper').bxSlider({
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

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once get_template_directory() . '/inc/jetpack.php';
}
