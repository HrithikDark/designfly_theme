<?php
/**
 * The template for displaying all single posts.
 *
 * @package Designfly
 */

get_header();
?>

<div id="primary" class="site-primary">
	<main id="main" class="site-main" role="main">
		<?php
		designfly_set_post_views( get_the_ID() );
		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
