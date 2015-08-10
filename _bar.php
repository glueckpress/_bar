<?php
/**
 * Plugin Name: _bar
 * Description: Update your site’s core language setting in WordPress via toolbar (aka admin bar).
 * Version:     0.1
 * Author:      Caspar Hübinger
 * Plugin URI:  https://github.com/glueckpress/_bar/
 * Author URI:  https://profiles.wordpress.org/glueckpress
 * License: GNU General Public License v3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: _bar
 * Domain Path: /languages
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Initialize plugin.
 *
 * @return void
 */
function _bar__load() {

	// Admins only.
	if ( ! current_user_can( 'manage_options' ) )
		return;

	$plugin_slug = plugin_basename( __FILE__ );
	load_plugin_textdomain(
		'_bar',
		false,
		dirname( $plugin_slug ) . '/languages/'
	);

	/**
	 * Modules
	 */
	$module_dir = dirname( __FILE__ ) . '/modules';

	// Site Language
	require_once( $module_dir . '/site-language/site-language.php' );

	// Plugins Menu
	require_once( $module_dir . '/plugins-menu/plugins-menu.php' );

}
add_action( 'plugins_loaded', '_bar__load' );

