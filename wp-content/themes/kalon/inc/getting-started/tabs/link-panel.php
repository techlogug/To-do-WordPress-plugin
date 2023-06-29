<?php
/**
 * Right Buttons Panel.
 *
 * @package Kalon
 */
?>
<div class="panel-right">
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Upgrade To Pro', 'kalon' ); ?></h4>
		<p><?php esc_html_e( 'The Pro version of the theme allows you to change the look and feel of the website with just a few clicks. You can easily change the color, background image and pattern, as well as fonts of the website with the Pro theme. The Pro version comes with multiple layouts to help you create an attractive and engaging website. Furthermore, the premium themes are WPML and Polylang compatible to allow you to create a multilingual website with ease.', 'kalon' ); ?></p>
		<p><?php esc_html_e( 'Also, the premium theme gets regular updates and has a dedicated support team to solve your queries.', 'kalon' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/kalon-pro/' ); ?>" title="<?php esc_attr_e( 'View Premium Version', 'kalon' ); ?>" target="_blank">
            <?php esc_html_e( 'Read more about the features here', 'kalon' ); ?>
        </a>
	</div><!-- .panel-aside Theme Support -->
	<!-- Knowledge base -->
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Visit the Knowledge Base', 'kalon' ); ?></h4>
		<p><?php esc_html_e( 'Need help with WordPress and our theme as quickly as possible? Visit our well-organized documentation.', 'kalon' ); ?></p>
		<p><?php esc_html_e( 'Our documentation comes with a step-by-step guide from installing WordPress to customizing our theme to creating an attractive and engaging website.', 'kalon' ); ?></p>

		<a class="button button-primary" href="<?php echo esc_url( 'https://docs.rarathemes.com/docs/' . KALON_THEME_TEXTDOMAIN . '/' ); ?>" title="<?php esc_attr_e( 'Visit the knowledge base', 'kalon' ); ?>" target="_blank"><?php esc_html_e( 'Visit the Knowledge Base', 'kalon' ); ?></a>
	</div><!-- .panel-aside knowledge base -->
</div><!-- .panel-right -->