<?php
/**
 * Module Name: Plugins Menu
 * Description: Add a toolbar menu with quick links to admin plugins pages.
 */

add_action( 'admin_bar_menu', '_bar__plugins', 90 );

/**
 * Admin bar menu.
 *
 * @param  object $toolbar Admin bar object
 * @return void
 */
function _bar__plugins( $toolbar ) {

	/* Admin bar menu business. */
	$parent = 'bar__plugins';

	// Fallback: send to Plugins -> All.
	$url   = admin_url( 'plugins.php' );
	$meta  = array();

	// Add parent menu item.
	$toolbar->add_menu( array(
		'id'    => $parent,
		'title' => __( 'Plugins', '_bar' ),
		'href'  => $url,
		'meta'   => array(
			'class'  => 'bar__dashicon-parent bar__dashicon-parent--plugins',
			'target' => '_blank',
		),
	) );

	/* Plugin status pages. */
	$plugin_status = array(
		'all'                => __( 'All', '_bar' ),
		'active'             => __( 'Active', '_bar' ),
		'inactive'           => __( 'Inactive', '_bar' ),
		'recently_activated' => __( 'Recently Active', '_bar' ),
		'upgrade'            => __( 'Update Available', '_bar' ),
	);

	// Iterate through plugin status.
	foreach ( $plugin_status as $id => $label ) {

		$url = add_query_arg( 'plugin_status', $id, admin_url( 'plugins.php' ) );

		// Add submenu items.
		$toolbar->add_menu( array(
			'parent' => $parent,
			'id'     => "bar__plugins-item--$id",
			'title'  => $label,
			'href'   => $url,
			'meta'   => array(
				'class'  => 'bar-plugins-item',
				'target' => '_blank',
			),
		) );
	}
}
