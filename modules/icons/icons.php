<?php
/**
 * Module Name: Icons
 * Description: Trim toolbar parent menu items with dashicons to icons only.
 */

add_action( 'wp_enqueue_scripts', '_bar__icons__enqueue_scripts' );
add_action( 'admin_enqueue_scripts', '_bar__icons__enqueue_scripts' );

/**
 * Stylesheet.
 *
 * @return void
 */
function _bar__icons__enqueue_scripts() {

	$plugin_data = _bar__plugin_data();

	// This.
	wp_register_style(
		'_bar-icons',
		plugins_url( '/css/icons.css', __FILE__ ),
		array(),
		$plugin_data['version']
	);

	// There.
	wp_enqueue_style( '_bar-icons' );
}
