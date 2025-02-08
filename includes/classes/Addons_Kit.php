<?php
/**
 * Plugin Main class
 *
 * @package AddonsKit
 */
namespace AddonsKitElementor\Classes;

use Elementor\Controls_Manager;
use Elementor\Elements_Manager;

final class Addons_Kit {
    /**
	 * Plugin instance
	 */
    private static $instance = null;
	
    const CATEGORY_SLUG = 'addonskit';

    const TEXT_DOMAIN = 'addonskit-elementor';

	private function __construct() {
		add_action( 'init', [ $this, 'load_textdomain' ] );
	}

    /**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * @access public
     * 
     * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'addonskit-elementor',
			false,
			dirname( ADDONSKIT_PLUGIN_BASENAME ) . '/languages'
		);
	}

    /**
	 * Plugin instence
	 *
	 * @access public
	 * @static
	 *
	 * @return \Addons_Kit
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init();
		}

		return self::$instance;
	}

    /**
	 * Inisialize Plugin
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function init() {
		$this->includes();

        /**
         * Register custom category
        */
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_new_category' ] );
        
        /**
         * Register custom controls
        */
		add_action( 'elementor/controls/controls_registered', [ $this, 'register_new_controls' ] );

		do_action( 'addonskit_loaded' );

	}

	public function includes() {
		Addons_Manager::init();
		Assets_Manager::init();
    }

    /**
	 *Add custom category.
	 *
     * @param $elements_manager
	 * @access public
	 *
	 * @return void
	 */
	public function add_new_category( Elements_Manager $elements_manager ) {
		$elements_manager->add_category(
			self::CATEGORY_SLUG,
			[
				'title' => __( 'AddonsKit', 'addonskit-elementor' ),
				'icon' => 'fa fa-smile-o',
			]
		);

	}

	/**
	 * Register controls
	 *
     * @access public
	 * @param Controls_Manager $controls_Manager
     * 
     * @return void
	 */
	public function register_new_controls( Controls_Manager $controls_Manager ) {

	}

}