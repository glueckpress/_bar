<?php
/**
 * Plugin Name:       _bar
 * Description:       Handy toolbar menus for the lazy WordPress developer.
 * Version:           0.5
 * Author:            Caspar Hübinger
 * Plugin URI:        https://github.com/glueckpress/_bar/
 * GitHub Plugin URI: https://github.com/glueckpress/_bar
 * Author URI:        https://profiles.wordpress.org/glueckpress
 * License:           GNU General Public License v3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       _bar
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die( 'Bah.' );

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
	require_once( $module_dir . '/plugins/plugins.php' );

	// Trim default menu items
	require_once( $module_dir . '/icons/icons.php' );

}
add_action( 'plugins_loaded', '_bar__load' );

/**
 * Retrieve data from file header.
 *
 * @return array Plugin file headers
 */
function _bar__plugin_data() {

	// List of headers to retrieve.
	$headers = array(
		'name'       => 'Plugin Name',
		'version'    => 'Version',
		'plugin_uri' => 'Plugin URI',
	);

	// Beacause get_plugin_data() will only work in wp-admin.
	$file_data = get_file_data( __FILE__, $headers );

	return $file_data;
}
