<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kalon
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="https://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'kalon' ); ?></a>

    <?php kalon_mobile_header(); ?>
	<?php kalon_site_header(); 

    if( is_front_page() ){
        if( get_theme_mod( 'kalon_ed_slider' ) ) do_action( 'kalon_slider' );
    }    
    ?>
	<div id="content" class="site-content">
	   	<div class="container">
            <?php do_action( 'kalon_header' ); // Intro header for Archive and Search page ?>
               <div class="row">
