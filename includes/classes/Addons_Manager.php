<?php
namespace AddonsKit\Elementor;

defined( 'ABSPATH' ) || die();

class Addons_Manager {

    public $extensions_data = [];

    public static $all_feature_array;
    public static $all_feature_settings;
    public static $is_activated_feature;
    public static $default_addons = [];
    public static $default_extensions = [];

    public static function init()
    {
        self::widget_manager();
        self::activated_features();
        add_action('elementor/widgets/register', [__CLASS__, 'initiate_widgets']);
    }

    public static function widget_manager(){
        self::$default_addons = array_merge( self::widget_map_free(), self::widget_map_pro() );
    }

    public static function initiate_widgets( $widgets_manager ){

        require_once ADDONSKIT_ADDONS . 'special-heading/special-heading.php';
		require_once ADDONSKIT_ADDONS . 'section-title/section-title.php';
		require_once ADDONSKIT_ADDONS . 'pricing-table/pricing-table.php';
	
		$widgets_manager->register( new \AddonsKit\Elementor\Widget\Special_heading() );
		$widgets_manager->register( new \AddonsKit\Elementor\Widget\Section_title() );
		$widgets_manager->register( new \AddonsKit\Elementor\Widget\Pricing_Table() );
    }

    public static function activated_features(){
        self::$all_feature_array = array_merge( array_keys( self::$default_addons ), array_keys( self::$default_extensions ) );
        self::$all_feature_settings  = array_fill_keys( self::$all_feature_array, true );
        self::$is_activated_feature = get_option( 'wbea_save_settings', self::$all_feature_settings );
    }

    public static function widget_map_free() {
        return [
            'section-heading'  => [
                'title'  => __( 'Testimonial Slider', 'addonskit-elementor' ),
                'class'  => 'ADDONSKIT\Elementor\Addons\Testimonial_Slider',
                'demo_link' => '#',
                'tags'   => 'free',
                'is_pro' => false
            ],
        ];

    }

    public static function widget_map_pro()
    {
        return [];
    }

    public static function extensions_map_free()
    {
        return [
            // ... free extensions ...
        ];
    }

    public static function extensions_map_pro()
    {
        return [];
    }
}

Addons_Manager::init();
