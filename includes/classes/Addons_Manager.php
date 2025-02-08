<?php
namespace AddonsKitElementor\Classes;
use AddonsKitElementor\Addons\Special_heading;
use AddonsKitElementor\Addons\Section_title;
use AddonsKitElementor\Addons\Pricing_Table;

defined( 'ABSPATH' ) || die();

class Addons_Manager {

    public static function init(){
        add_action('elementor/widgets/register', [__CLASS__, 'initiate_widgets']);
    }

    public static function initiate_widgets( $widgets_manager ){
		$widgets_manager->register( new Special_heading() );
		$widgets_manager->register( new Section_title() );
		$widgets_manager->register( new Pricing_Table() );
    }
}
