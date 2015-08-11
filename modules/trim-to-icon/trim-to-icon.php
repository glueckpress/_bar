<?php
/**
 * Module Name: Trim to Icon
 * Description: Trim parent menu items with dashicons in the toolbar to display only icons.
 */

add_action( 'wp_enqueue_scripts', '_bar__trim_to_icon__enqueue_scripts' );
add_action( 'admin_enqueue_scripts', '_bar__trim_to_icon__enqueue_scripts' );

/**
 * Stylesheet.
 *
 * @return void
 */
function _bar__trim_to_icon__enqueue_scripts() {

	// This.
	wp_register_style(
		'_bar-trim-to-icon',
		plugins_url( '/css/trim-to-icon.css', __FILE__ ),
		array( 'admin-bar', 'dashicons' )
	);

	// There.
	wp_enqueue_style( '_bar-trim-to-icon' );

}
