<?php
/**
 * Module Name: Icons
 * Description: Trim parent menu items with dashicons in the toolbar to display only icons.
 */

add_action( 'wp_enqueue_scripts', '_bar__icons__enqueue_scripts' );
add_action( 'admin_enqueue_scripts', '_bar__icons__enqueue_scripts' );

/**
 * Stylesheet.
 *
 * @return void
 */
function _bar__icons__enqueue_scripts() {

	// This.
	wp_register_style(
		'_bar-icons',
		plugins_url( '/css/icons.css', __FILE__ ),
		array( 'admin-bar', 'dashicons' )
	);

	// There.
	wp_enqueue_style( '_bar-icons' );

}
