<?php
namespace AddonsKitElementor\Classes;

defined( 'ABSPATH' ) || die();

/**
 * Class Addons_Manager
 *
 * Manages the registration and initialization of custom Elementor addons.
 * This class is responsible for loading and registering all the addons
 * defined in the `$addons` array.
 *
 * @package AddonsKitElementor\Classes
 */
class Addons_Manager {

    /**
     * Array of widget class names to be registered.
     *
     * @var array
     */
    private static $addons = [
      \AddonsKitElementor\Addons\Special_Heading::class,
      \AddonsKitElementor\Addons\Section_Title::class,
      \AddonsKitElementor\Addons\Pricing_Table::class,
      \AddonsKitElementor\Addons\Animated_Heading::class,
    ];

    /**
     * Initialize the addons Manager.
     *
     * Hooks into Elementor's addons registration process to load custom widgets.
     *
     * @return void
     */
    public static function init() {
        add_action('elementor/widgets/register', [__CLASS__, 'initiate_addons']);
    }

    /**
     * Register custom widgets with Elementor.
     *
     * This method loops through the `$widgets` array and registers each widget
     * with Elementor's widget manager. It ensures the widget class exists before
     * attempting to register it.
     *
     * @param \Elementor\Widgets_Manager $addons_manager The Elementor widget manager instance.
     * @return void
     */
    public static function initiate_addons( $addons_manager ) {
        foreach ( self::$addons as $addons_class ) {
            if ( class_exists( $addons_class ) ) {
                $addons_manager->register( new $addons_class() );
            }
        }
    }
}