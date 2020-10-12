<?php
/**
 * Customizer.
 *
 * @package Designfly
 */

namespace Designfly\Inc;

use Designfly\Inc\Traits\Singleton;

/**
 * Class Customizer
 */
class Customizer {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'customize_register', [ $this, 'customize_register' ] );
		add_action( 'customize_preview_init', [ $this, 'enqueue_customizer_scripts' ] );

	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action customize_register
	 */
	public function customize_register( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				[
					'selector'        => '.site-title a',
					'render_callback' => [ $this, 'customize_partial_blog_name' ],
				]
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				[
					'selector'        => '.site-description',
					'render_callback' => [ $this, 'customize_partial_blog_description' ],
				]
			);

		}


		/**
			 * Theme Options
			 */

			$wp_customize->add_section(
				'designfly-footer-section',
				array(
					'title'      => __( 'Footer settings', 'designfly' ),
					'priority'   => 140,
					'capability' => 'edit_theme_options',
				)
			);

			/* Enable Header Search --------- */

			$wp_customize->add_setting(
				'designfly-footer-contact',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'Street 21 Planet, A-11, california Tel: 91234 42354',
					'sanitize_callback' => array( __CLASS__, 'sanitize_textarea' ),
				)
			);

			$wp_customize->add_control(
				'designfly-footer-contact',
				array(
					'type'     => 'textarea',
					'section'  => 'designfly-footer-section',
					'priority' => 10,
					'label'    => __( 'Contact Information', 'designfly' ),
				)
			);

	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_name() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_description() {
		bloginfo( 'description' );
	}

	/**
	 * Enqueue customizer scripts.
	 *
	 * @action customize_preview_init
	 */
	public function enqueue_customizer_scripts() {

		Assets::get_instance()->register_script( 'designfly-customizer', 'js/admin/customizer.js', [ 'customize-preview' ] );

		wp_enqueue_script( 'designfly-customizer' );
	}

	public function sanitize_textarea($input) {
        return filter_var( $input, FILTER_SANITIZE_STRING );
    }

}