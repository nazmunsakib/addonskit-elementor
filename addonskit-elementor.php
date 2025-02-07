<?php
/**
 * Plugin Name: AddonsKit Elementor
 * Description: The AddonsKit plugin you install after Elementor!
 * Plugin URI: https://addonskit.com/
 * Author: nazmunsakib
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author URI: https://nazmunsakib.com/
 * Text Domain: addonskit-elementor
 * Domain Path: /languages
 * Elementor tested up to: 3.19.2
 * Elementor Pro tested up to: 3.19.2
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined('ABSPATH') || die();

/**
 * Defining plugin constants.
 *
 * @since 1.0.0
 */
if ( defined( 'WP_ENVIRONMENT_TYPE' ) && 'development' == wp_get_environment_type() ) {
	define('ADDONSKIT_PLUGIN_VERSION', time() );
} else {
	define('ADDONSKIT_PLUGIN_VERSION', '1.0.0');
}

define('ADDONSKIT_PLUGIN_FILE', __FILE__ );
define('ADDONSKIT_DIR_PATH', plugin_dir_path( ADDONSKIT_PLUGIN_FILE ) );
define('ADDONSKIT_DIR_URL', plugin_dir_url( ADDONSKIT_PLUGIN_FILE ) );
define('ADDONSKIT_PLUGIN_BASENAME', plugin_basename( ADDONSKIT_PLUGIN_FILE ) );
define('ADDONSKIT_ASSETS', trailingslashit( ADDONSKIT_DIR_URL . 'assets'));
define('ADDONSKIT_ADMIN_URL', trailingslashit( ADDONSKIT_DIR_URL . 'admin'));
define('ADDONSKIT_ADMIN', ADDONSKIT_DIR_PATH . 'admin/');
define('ADDONSKIT_ADDONS', ADDONSKIT_DIR_PATH . 'addons/');

define('ADDONSKIT_MINIMUM_ELEMENTOR_VERSION', '3.5.0');
define('ADDONSKIT_MINIMUM_PHP_VERSION', '5.4');

/**
 * The journey starts here.
 *
 * @return void Some voids are not really void, you have to explore to figure out why not!
 */
function addonskit_start(){
    /**
     * Check for required PHP version
     */
    if ( version_compare( PHP_VERSION, ADDONSKIT_MINIMUM_PHP_VERSION, '<' ) ){
        add_action('admin_notices', 'addonskit_admin_notice_required_php_version');
        return;
    }

    /**
     * Check if Elementor installed and activated
     */
    if ( ! did_action('elementor/loaded') ) {
        add_action('admin_notices', 'addonskit_admin_notice_elementor_missing');
        return;
    }

    /**
     * Check for required Elementor version
     */
    if ( ! version_compare( ELEMENTOR_VERSION, ADDONSKIT_MINIMUM_ELEMENTOR_VERSION, '>=' ) ){
        add_action('admin_notices', 'addonskit_admin_notice_required_elementor_version');
        return;
    }

    require ADDONSKIT_DIR_PATH . 'Addons_Kit.php';
    \AddonsKit\Elementor\Addons_Kit::instance();
}

add_action('plugins_loaded', 'addonskit_start');

/**
 * Admin notice for required php version
 *
 * @return void
 */
function addonskit_admin_notice_required_php_version() {
    $notice = sprintf(
        /* translators: 1: Plugin name, 2: PHP, 3: Required PHP version */
        esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'addonskit-elementor'),
        '<strong>' . esc_html__('AddonsKit Elementor', 'addonskit-elementor') . '</strong>',
        '<strong>' . esc_html__('PHP', 'addonskit-elementor') . '</strong>',
        ADDONSKIT_MINIMUM_PHP_VERSION
    );

    printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', wp_kses_post( $notice ) );
}

/**
 * Admin notice for elementor if missing
 *
 * @return void
 */
function addonskit_admin_notice_elementor_missing() {
    if( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php') ) {
        $notice_title = __('Activate Elementor', 'addonskit-elementor');
        $notice_url = wp_nonce_url('plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php');
    } else {
        $notice_title = __('Install Elementor', 'addonskit-elementor');
        $notice_url = wp_nonce_url( self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor' );
    }

    $notice = sprintf(
        /* translators: 1: Plugin name, 2: Elementor, 3:  Elementor installation link */
        esc_html__('%1$s requires %2$s to be installed and activated to function properly. %3$s', 'addonskit-elementor'),
        '<strong>' . esc_html__('AddonsKit Elementor', 'addonskit-elementor') . '</strong>',
        '<strong>' . esc_html__('Elementor', 'addonskit-elementor') . '</strong>',
        '<a href="' . esc_url( $notice_url ) . '">' . $notice_title . '</a>'
    );

    printf('<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', wp_kses_post( $notice ) );
}

/**
 * Admin notice for required elementor version
 *
 * @return void
 */
function addonskit_admin_notice_required_elementor_version() {
    $notice_title = __('Update Elementor', 'addonskit-elementor');
    $notice_url = wp_nonce_url( self_admin_url('update.php?action=upgrade-plugin&plugin=elementor/elementor.php'), 'upgrade-plugin_elementor/elementor.php');

    $notice = sprintf(
        /* translators: 1: Plugin name, 2: Elementor, 3: Required Elementor version */
        esc_html__('"%1$s" requires "%2$s" version %4$s or greater. %3$s', 'addonskit-elementor'),
        '<strong>' . esc_html__('AddonsKit Elementor', 'addonskit-elementor') . '</strong>',
        '<strong>' . esc_html__('Elementor', 'addonskit-elementor') . '</strong>',
        '<a href="' . esc_url( $notice_url ) . '">' . $notice_title . '</a>',
        ADDONSKIT_MINIMUM_ELEMENTOR_VERSION
    );

    printf('<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', esc_html( $notice ) );
}




