<?php
/**
 * Module Name: Plugins Menu
 * Description: Adds a quick link menu to plugins status pages.
 */

add_action( 'admin_bar_menu', '_bar__plugins_menu', 90 );


/**
 * Menu in the admin bar.
 *
 * @param  object $bar Admin bar object
 * @return void
 */
function _bar__plugins_menu( $bar ) {

	/* Admin bar menu business. */
	$parent = '_bar__plugins';

	// Fallback: send to Plugins -> All.
	$url   = admin_url( 'plugins.php' );
	$meta   = array();

	// Add parent menu item.
	$bar->add_menu( array(
		'id'    => $parent,
		'title' => __( 'Plugins' ),
		'href'  => $url,
		'meta'   => array(
			'class'  => '_bar__plugins-item',
			'target' => '_blank',
		),
	) );

	/* Plugin status pages. */
	$plugin_status = array(
		'all'                => __( 'All' ),
		'active'             => __( 'Active' ),
		'inactive'           => __( 'Inactive' ),
		'recently_activated' => __( 'Recently Active' ),
		'upgrade'            => __( 'Update Available' ),
	);

	// Iterate through plugin status.
	foreach ( $plugin_status as $id => $label ) {

		$url = add_query_arg( 'plugin_status', $id, admin_url( 'plugins.php' ) );

		// Add submenu items.
		$bar->add_menu( array(
			'parent' => $parent,
			'id'     => "_bar__plugins-item--$id",
			'title'  => $label,
			'href'   => $url,
			'meta'   => array(
				'class'  => '_bar-plugins-item',
				'target' => '_blank',
			),
		) );
	}
}
