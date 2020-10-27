<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Designfly
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<hr />
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<aside>
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</aside>
		<?php } ?>
		<div class="footer-content">
			<div class = "footer__post">
				<?php
					// the query.
					$designfly_the_query = new WP_Query(
						array(
							'posts_per_page' => 1,
						)
					);

					if ( $designfly_the_query->have_posts() ) :
						$designfly_the_query->the_post();
						?>
						<p class="post__title"><a href="<?php echo esc_url( get_post_permalink() ); ?>"><?php echo wp_kses_post( get_the_title() ); ?> </a></p>

						<?php
						designfly_the_excerpt( 200 );
						if ( has_excerpt() ) {
							printf( '<br>' );
							designfly_excerpt_more();
						}
						wp_reset_postdata();

					else :
						__( 'No Posts found', 'designfly' );
					endif;
					?>
			</div>
			<div class="footer__contact">
				<p class="contact__title"><?php esc_html_e( 'Contact Us', 'designfly' ); ?></p>
				<p class = "contact__info">
					<span class="contact__address"><?php echo wp_kses_post( get_theme_mod( 'designfly-footer-address' ) ); ?></span><br>
					Tel: <span class="contact__telephone"><?php echo wp_kses_post( get_theme_mod( 'designfly-footer-telephone' ) ); ?></span>
					Fax: <span class="contact__fax"><?php echo wp_kses_post( get_theme_mod( 'designfly-footer-fax' ) ); ?></span><br>
					Email: <span class="contact__email"><?php echo wp_kses_post( get_theme_mod( 'designfly-footer-email' ) ); ?></span><br>
					<div>
						<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'designfly-social-facebook-url' ) ); ?>">
							<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-social-facebook-icon' ) ) ); ?> "/>
						</a>
						<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'designfly-social-google-url' ) ); ?>">
							<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-social-google-icon' ) ) ); ?> "/>
						</a>
						<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'designfly-social-linkedin-url' ) ); ?>">
							<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-social-linkedin-icon' ) ) ); ?> "/>
						</a>
						<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'designfly-social-pinterest-url' ) ); ?>">
							<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-social-pinterest-icon' ) ) ); ?> "/>
						</a>
						<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'designfly-social-twitter-url' ) ); ?>">
							<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-social-twitter-icon' ) ) ); ?> "/>
						</a>
					</div>
				</p>
			</div>
		</div>
		<hr />
		<div class="site-info text-center">
			<span><?php designfly_copyright_text(); ?></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
