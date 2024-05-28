<?php
/*
	Plugin Name: UX Flat
	Plugin URI: https://uxflat.com
	Description: This plugin will create new elements for Flatsome > v3.16 <code>Flatsome / Advanced / UX Flat</code>
	Version: 3.2
	Author: Tien COP
	Author URI: https://profiles.wordpress.org/wpvncom/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Text Domain: uxflat
	Domain Path: /languages
*/

if (!defined('ABSPATH')) { exit; }

define('UXF_PATH', plugin_dir_path(__FILE__));
define('UXF_URL', plugins_url('/', __FILE__));

//Warning
add_action( 'admin_notices', 'uxf_warning' );
function uxf_warning () {
	if ( wp_get_theme()->template !== 'flatsome' ) {
		echo '<div class="error"><p>' . __( 'Warning: Please install the "Flatsome" parent theme or deactive UX Flat', 'uxflat' ).'</p></div>';
	}
}

//Load translations
function uxf_plugins_loaded() {
	load_plugin_textdomain('uxflat', false, dirname(plugin_basename( __FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'uxf_plugins_loaded');

//Settings link in plugins table
function uxf_action_links($actions, $plugin_file) {
	if(plugin_basename(__FILE__) == $plugin_file) {
		$settings_url = admin_url('admin.php?page=optionsframework#of-option-uxflat');
		$settings_link = array('settings' => '<a href="' . $settings_url . '">' . __('Settings') . '</a>');
		$actions = array_merge($settings_link, $actions);
	}
	return $actions;
}
add_filter('plugin_action_links', 'uxf_action_links', 10, 5);

require_once UXF_PATH . 'inc/of_options.php';
require_once UXF_PATH . 'inc/init.php';
