<?php

namespace AddonsKitElementor\Classes;

defined('ABSPATH') || die();

class Assets_Manager {

	/**
	 * Bind hook and run internal methods here
	 */
	public static function init() {
		// Frontend scripts
		add_action('wp_enqueue_scripts', [__CLASS__, 'frontend_register']);
		add_action('wp_enqueue_scripts', [__CLASS__, 'frontend_enqueue'], 100);

		// Edit and preview enqueue
		add_action('elementor/preview/enqueue_styles', [__CLASS__, 'enqueue_preview_styles']);

		// Enqueue editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [__CLASS__, 'editor_enqueue']);
	}

	/**
	 * Register frontend assets.
	 *
	 * Frontend assets handler will be used in widgets map
	 * to load widgets assets on demand.
	 *
	 * @return void
	 */
	public static function frontend_register() {

		wp_register_style(
			'addonskit-special-heading',
			ADDONSKIT_ASSETS . '/css/special-heading.css',
			null,
			ADDONSKIT_PLUGIN_VERSION
		);

		wp_register_style(
			'addonskit-section-title',
			ADDONSKIT_ASSETS . '/css/section-title.css',
			null,
			ADDONSKIT_PLUGIN_VERSION
		);

		wp_register_style(
			'addonskit-service',
			ADDONSKIT_ASSETS . '/css/addonskit-service.css',
			null,
			ADDONSKIT_PLUGIN_VERSION
		);

		wp_register_style(
			'addonskit-pricing-table',
			ADDONSKIT_ASSETS . '/css/pricing-table.css',
			null,
			ADDONSKIT_PLUGIN_VERSION
		);

		wp_register_style(
			'addonskit-animation',
			ADDONSKIT_ASSETS . '/css/addonskit-animation.css',
			null,
			ADDONSKIT_PLUGIN_VERSION
		);

		wp_register_script(
			'gsap',
			ADDONSKIT_ASSETS . 'js/gsap.min.js',
			[],
			'3.2.3'
		);

		wp_register_script(
			'anime',
			ADDONSKIT_ASSETS . 'js/anime.min.js',
			[],
			'2.0.2'
		);

		wp_register_script(
			'addonskit-animation',
			ADDONSKIT_ASSETS . 'js/addonskit-animation.js',
			['gsap', 'anime'],
			ADDONSKIT_PLUGIN_VERSION
		);


	}

	/**
	 * Enqueue fontend assets
	 *
	 * @return void
	 */
	public static function frontend_enqueue() {

		//Localize scripts
		wp_localize_script(
			'addonskit-elementor',
			'addonskit',
			[
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce('addonskit_core_nonce'),
			]
		);
	}

	/**
	 * Enqueue editor assets
	 *
	 * @return void
	 */
	public static function editor_enqueue() {

	}

	/**
	 * Enqueue stylesheets only for preview window
	 * editing mode basically.
	 *
	 * @return void
	 */
	public static function enqueue_preview_styles() {

	}

}
