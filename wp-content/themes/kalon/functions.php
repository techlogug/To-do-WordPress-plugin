<?php
/**
 * Kalon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kalon
 */

$kalon_theme_data = wp_get_theme();
if( ! defined( 'KALON_THEME_VERSION' ) ) define( 'KALON_THEME_VERSION', $kalon_theme_data->get( 'Version' ) );
if( ! defined( 'KALON_THEME_NAME' ) ) define( 'KALON_THEME_NAME', $kalon_theme_data->get( 'Name' ) );
if( ! defined( 'KALON_THEME_TEXTDOMAIN' ) ) define( 'KALON_THEME_TEXTDOMAIN', $kalon_theme_data->get( 'TextDomain' ) );

if ( ! function_exists( 'kalon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kalon_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Kalon, use a find and replace
	 * to change 'kalon' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kalon', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'kalon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
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
		'link',
        'image',
		'quote',
        'video'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kalon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    //Custom Image Sizes
    add_image_size( 'kalon-slider', 1400, 507, true);
    add_image_size( 'kalon-without-sidebar', 1170, 460, true);
    add_image_size( 'kalon-with-sidebar', 848, 461, true);
    
    /* Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

    /* WooCommerce Support */
    if( kalon_is_woocommerce_activated() ){
    	global $woocommerce;

	    add_theme_support( 'woocommerce' );

	    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
	        add_theme_support( 'wc-product-gallery-zoom' );
	        add_theme_support( 'wc-product-gallery-lightbox' );
	        add_theme_support( 'wc-product-gallery-slider' );
	    }
    }
}
endif;
add_action( 'after_setup_theme', 'kalon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kalon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kalon_content_width', 848 );
}
add_action( 'after_setup_theme', 'kalon_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function kalon_template_redirect_content_width() {
	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = kalon_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1170;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1170;
	}
}
add_action( 'template_redirect', 'kalon_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kalon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'kalon' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	    register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'kalon' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'kalon' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'kalon' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kalon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kalon_scripts() {
	$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1' );
    wp_enqueue_style( 'owl-theme-default', get_template_directory_uri(). '/css' . $build . '/owl.theme.default' . $suffix . '.css', array(), '2.2.1' );

	if( get_theme_mod( 'ed_localgoogle_fonts',false ) && ! is_customize_preview() && ! is_admin() ){
        if ( get_theme_mod( 'ed_preload_local_fonts',false ) ) {
			kalon_load_preload_local_fonts( kalon_get_webfont_url( kalon_fonts_url() ) );
        }
        wp_enqueue_style( 'kalon-google-fonts', kalon_get_webfont_url( kalon_fonts_url() ) );
    }else{
		wp_enqueue_style( 'kalon-google-fonts', kalon_fonts_url() );
	}
	
    if( kalon_is_woocommerce_activated() ){
    	wp_enqueue_style( 'kalon-woocommerce-style', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array('kalon-style'), '1.0.0' );
    }
	
	wp_enqueue_style( 'kalon-style', get_stylesheet_uri() );
    
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array('jquery'), '2.2.1', true ); 
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array('jquery'), '0.2.1', true ); 
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'kalon-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), KALON_THEME_VERSION, true );
    wp_register_script( 'kalon-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), '20151228', true );
   
    $kalon_slider_auto      = get_theme_mod( 'kalon_slider_auto', '1' );
    $kalon_slider_loop      = get_theme_mod( 'kalon_slider_loop', '1' );
    $kalon_slider_control   = get_theme_mod( 'kalon_slider_control', '1' );
    $kalon_slider_animation = get_theme_mod( 'kalon_slider_animation', 'slide' );
    $kalon_slider_speed     = get_theme_mod( 'kalon_slider_speed', '7000' );
    
    $kalon_array = array(
        'auto'      => esc_attr( $kalon_slider_auto ),
        'loop'      => esc_attr( $kalon_slider_loop ),
        'control'   => esc_attr( $kalon_slider_control ),
        'animation' => esc_attr( $kalon_slider_animation ),
        'speed'     => absint( $kalon_slider_speed ),
        'rtl'       => is_rtl(),
    );
    
    wp_localize_script( 'kalon-custom', 'kalon_data', $kalon_array );
    wp_enqueue_script( 'kalon-custom' );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kalon_scripts' );

if( ! function_exists( 'kalon_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function kalon_admin_scripts(){
    wp_enqueue_style( 'kalon-admin', get_template_directory_uri() . '/inc/css/admin.css', '', KALON_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'kalon_admin_scripts' );

if( ! function_exists( 'kalon_block_editor_styles' ) ) :
    /**
     * Enqueue editor styles for Gutenberg
     */
    function kalon_block_editor_styles() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    // Block styles.
    wp_enqueue_style( 'kalon-block-editor-style', get_template_directory_uri() . '/css' . $build . '/editor-block' . $suffix . '.css' );

    // Add custom fonts.
    wp_enqueue_style( 'kalon-google-fonts', kalon_fonts_url(), array(), null );

}
endif;
add_action( 'enqueue_block_editor_assets', 'kalon_block_editor_styles' );

if( ! function_exists( 'kalon_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function kalon_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'kalon_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'kalon' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'kalon' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=kalon-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'kalon' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?kalon_admin_notice=1"><?php esc_html_e( 'Dismiss', 'kalon' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'kalon_admin_notice' );

if( ! function_exists( 'kalon_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function kalon_update_admin_notice(){
    if ( isset( $_GET['kalon_admin_notice'] ) && $_GET['kalon_admin_notice'] = '1' ) {
        update_option( 'kalon_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'kalon_update_admin_notice' );

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Post Meta Box
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Widget Recent Post
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Widget Popular Post
 */
require get_template_directory() . '/inc/widget-popular-post.php';

/**
 * Widget Featured Post
 */
require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Widget Social Links
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Theme Information
 */
require get_template_directory() . '/inc/info.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
* Recommended Plugins
*/
require_once get_template_directory() . '/inc/tgmpa/recommended-plugins.php';
