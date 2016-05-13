<?php
/**
 * Module Name: Accesskeys Menu
 * Description: Adds a dedicated, visually hidden menu with accesskey support for specific admin pages.
 *
 * Default keys:
 * “e” - Posts (“edit”)
 * “d” - Pages (“documents”)
 * “p” - Plugins
 * “m” - Media
 *
 * Sample plugin support for WP Rocket:
 * “r” - Settings (“rocket”)
 * “c” - Clear cache
 */

add_action( 'admin_footer', '_bar__accesskeys' );
add_action( 'admin_enqueue_scripts', '_bar__accesskeys__enqueue_scripts' );

/**
 * Accesskeys menu.
 *
 * @return void
 */
function _bar__accesskeys() {

	$menu_items = array(
		'posts' => array(
			'key' => 'e',
			'url' => admin_url( 'edit.php' ),
			'label' => __( 'Posts' ),
		),
		'pages' => array(
			'key' => 'd',
			'url' => add_query_arg( 'post_type', 'page', admin_url( 'edit.php' ) ),
			'label' => __( 'Pages' ),
		),
		'plugins' => array(
			'key' => 'p',
			'url' => admin_url( 'plugins.php' ),
			'label' => __( 'Plugins' ),
		),
		'media' => array(
			'key' => 'm',
			'url' => admin_url( 'upload.php' ),
			'label' => __( 'Media' ),
		),
	);

	/**
	 * Sample for plugin support: WP Rocket.
	 * Accesskeys ”c” to clear cache and “r” to go to settings page.
	 */
	if ( function_exists( 'rocket_clean_domain' ) ) {

		// Clear cache
		$menu_items['wp_rocket_clear_cache'] = array(
			'key' => 'c',
			'url' => wp_nonce_url(
				add_query_arg( array(
						'action' => 'purge_cache',
						'type' => 'all',
						'_wp_http_referer' => urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) )
					),
					admin_url( 'admin-post.php' )
				), 'purge_cache_all'
			),
			'label' => __( 'Clear cache', 'rocket' ),
		);

		// Settings
		if ( current_user_can( apply_filters( 'rocket_capacity', 'manage_options' ) ) ) {
			$menu_items['wp_rocket_settings'] = array(
				'key' => 'r',
				'url' => add_query_arg( 'page', 'wprocket', admin_url( 'options-general.php' ) ),
				'label' => __( 'WP Rocket', 'rocket' ),
			);
		}
	}

	/**
	 * Filter to add/remove menu items.
	 * @var array
	 */
	$menu_items = apply_filters( 'bar__accesskeys_menu_items', $menu_items );

	// Print menu to admin footer.
	print '<ul class="bar__accesskeys_menu">';

	foreach ( $menu_items as $id => $menu_item ) {

		if ( empty( $menu_item['url'] ) || empty( $menu_item['key'] ) )
			continue;

		printf(
			'<li><a href="%1$s" accesskey="%2$s">%3$s</a></li>',
			$menu_item['url'],
			$menu_item['key'],
			$menu_item['label']
		);
	}

	print '</ul>';
}

/**
 * Stylesheet.
 *
 * @return void
 */
function _bar__accesskeys__enqueue_scripts() {

	$plugin_data = _bar__plugin_data();

	// This.
	wp_register_style(
		'_bar-accesskeys',
		plugins_url( '/css/accesskeys.css', __FILE__ ),
		array(),
		$plugin_data['version']
	);

	// There.
	wp_enqueue_style( '_bar-accesskeys' );
}
