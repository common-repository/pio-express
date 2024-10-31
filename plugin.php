<?php

/**
 * Plugin Name: PIO - Express
 * Plugin URI: https://programmers.io/pio-express/
 * Description: Want to make your WordPress login page look more professional and credible with your authentic logo and theme? PIO-Express is an important plugin to manage your login page, admin bar, and API resources effortlessly.
 * Version: 2.0
 * Requires PHP: 7.0 or higher
 * Author: Programmers.io
 * Author URI: https://programmers.io/
 */

if (!defined('PIO_EXPRESS_URL')) {
    define('PIO_EXPRESS_URL', plugin_dir_url(__FILE__));
}
if (!defined('PIO_EXPRESS_PATH')) {
    define('PIO_EXPRESS_PATH', plugin_dir_path(__FILE__));
}
if (!defined('PIO_EXPRESS_PLUGIN_VERSION')) {
    define('PIO_EXPRESS_PLUGIN_VERSION' , 2.0);
}

 // pio express plugin activation to change key name to support previous version
function pio_express_plugin_activate() {
    if (get_option('pio_hide_wpadminbar') !==  false && get_option('pio_express_hide_wpadminbar') == false){
        update_option('pio_express_hide_wpadminbar', get_option('pio_hide_wpadminbar'));
        delete_option('pio_hide_wpadminbar');
    }
    if (get_option('pio_logo_height') !==  false && get_option('pio_express_logo_height') == false){
        update_option('pio_express_logo_height', get_option('pio_logo_height'));
        delete_option('pio_logo_height');
    }
    if (get_option('pio_logo_width') !==  false && get_option('pio_express_logo_width') == false){
        update_option('pio_express_logo_width', get_option('pio_logo_width'));
        delete_option('pio_logo_width');
    }
    if (get_option('pio_login_logo') !==  false && get_option('pio_express_login_logo') == false){
        update_option('pio_express_login_logo', get_option('pio_login_logo'));
        delete_option('pio_login_logo');
    }
}
register_activation_hook( __FILE__, 'pio_express_plugin_activate' );

// Check for plugin update scripts
function pio_express_plugin_check_version() {
    if (PIO_EXPRESS_PLUGIN_VERSION !== get_option('pio_express_plugin_version')){
        pio_express_plugin_activate();
    }
}

add_action('plugins_loaded', 'pio_express_plugin_check_version');

// function for restore default
function pio_express_restore_defaults($keys){
    foreach($keys as $key){
        delete_option($key);
    }
}

// including custom stylesheet file
add_action('admin_enqueue_scripts','pio_express_reg_stylesheet');

function pio_express_reg_stylesheet(){
    wp_enqueue_style('custom_stylesheet',PIO_EXPRESS_URL . 'assets/custom_style.css');
}

require_once(PIO_EXPRESS_PATH . 'includes/admin-menu.php');
/**
 * Faq page screen handler
 */
require_once(PIO_EXPRESS_PATH . 'includes/faq.php');


/**
 * Action Hook to perform
 * the hideadminbar action
 */
require_once(PIO_EXPRESS_PATH . 'includes/admin-bar.php');


/** Function to show the
 * api options
 */

require_once(PIO_EXPRESS_PATH . 'includes/manage-api.php');


/** Function to show the
 * logo updation options
 */
require_once(PIO_EXPRESS_PATH . 'includes/manage-login-page.php');
?>