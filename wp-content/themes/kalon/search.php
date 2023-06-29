<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Kalon
 */

get_header(); ?>

    <section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

            the_posts_pagination( array(
                'prev_text'          => __( 'Previous', 'kalon' ),
                'next_text'          => __( 'Next', 'kalon' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'kalon' ) . ' </span>',
            ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
                
<?php 
get_footer();