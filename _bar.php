<?php
/**
 * Plugin Name: _bar
 * Description: Lets you update your site language option in WordPress via the toolbar (aka admin bar).
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

	// Register + enqueue scripts.
	add_action( 'wp_enqueue_scripts', '_bar__enqueue_scripts' );
	add_action( 'admin_enqueue_scripts', '_bar__enqueue_scripts' );
	add_action( 'wp_ajax_' . '_bar_update_site_language', '_bar__update_site_language' );

	// Add admin bar menu after “Edit” on singular views.
	add_action( 'admin_bar_menu', '_bar__admin_bar_menu', 90 );
}
add_action( 'plugins_loaded', '_bar__load' );


/**
 * Scriptures.
 *
 * @return void
 */
function _bar__enqueue_scripts() {

	// This.
	wp_register_script(
		'_bar',
		plugins_url( '/assets/js/_bar.js', __FILE__ ),
		array( 'jquery' ),
		'',
		true
	);

	// There.
	wp_enqueue_script( '_bar' );

	// Like that.
	wp_localize_script( '_bar', '_bar',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'site_language' ),
			'message' => __( 'Site language could not be switched. You’re being redirected to Settings &rarr; General.', '_bar' )
		)
	);
}


/**
 * Ajax all the things.
 *
 * @return void
 */
function _bar__update_site_language(){

	// Verifying all the things.
	_bar__validate_ajax_request();

	$new_language = $_POST[ 'language' ];

	// get_option( 'WPLANG' ) === '' for default English
	$new_language = ( 'en_US' === $new_language ) ? '' : $new_language;

	// Update site language.
	update_option( 'WPLANG', $new_language );

	// Prepare to send back.
	$new_language = ( '' === $new_language ) ? 'en_US' : $new_language;

	// Send.
	wp_send_json_success( array(
		'nonce' => wp_create_nonce( 'site_language' ),
	) );
}


/**
 * Validate AJAX requests.
 *
 * @return void
 */
function _bar__validate_ajax_request() {

	// Request method.
	if ( ! $_SERVER[ 'REQUEST_METHOD' ]  === 'POST' ) {
		wp_send_json_error();
	}

	// Required POST data.
	if ( ! isset( $_POST[ 'language' ] ) || ! isset( $_POST[ 'nonce' ] ) ) {
		wp_send_json_error();
	}

	// Nonce.
	if( ! wp_verify_nonce( $_POST['nonce'], 'site_language' ) ){
		wp_send_json_error();
	}
}


/**
 * Menu in the admin bar.
 *
 * @param  object $bar Admin bar object
 * @return void
 */
function _bar__admin_bar_menu( $bar ) {

	// Get available languages, bail if none.
	$languages = _bar__get_languages();
	if ( ! $languages )
		return $bar;

	/* Admin bar menu business. */
	$parent = '_bar-menu';

	// Fallback: send to Settings -> General.
	$href   = admin_url( 'options-general.php#WPLANG' );
	$meta   = array();
	$locale = get_locale();

	// Add parent menu item.
	$bar->add_menu( array(
		'id'    => $parent,
		'title' => __( 'Site Language', '_bar' ),
		'href'  => false
	) );

	// Iterate through installed translations.
	foreach ( $languages as $language ) {

		// Exclude current locale.
		if ( $locale === $language[ 'language' ] ) {
			unset( $language );
			continue;
		}

		// Add submenu items.
		$bar->add_menu( array(
			'parent' => $parent,
			'id'     => $language[ 'language' ],
			'title'  => $language[ 'native_name' ],
			'href'   => $href,
			'meta'   => array(
				'class'  => '_bar-language-item',
				'rel'    => $language[ 'language' ],
			),
		) );
	}
}


/**
 * Retrieve rich data for available core languages.
 *
 * @return array|bool Array of language data, or false
 */
function _bar__get_languages() {

	$available_languages = get_available_languages();
	if ( 0 === count( $available_languages ) )
		return false;

	/* Core l10n niftification. */
	require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
	$translations = wp_get_available_translations();
	$languages    = array(
		array(
				'language'    => 'en_US',
				'native_name' => __( 'English' ),
				'lang'        => '',
			)
	);
	foreach ( $available_languages as $locale ) {
		if ( isset( $translations[ $locale ] ) ) {
			$translation = $translations[ $locale ];
			$languages[] = array(
				'language'    => $translation['language'],
				'native_name' => $translation['native_name'],
				'lang'        => current( $translation['iso'] ),
			);
			// Remove installed language from available translations.
			unset( $translations[ $locale ] );
		} else {
			$languages[] = array(
				'language'    => $locale,
				'native_name' => $locale,
				'lang'        => '',
			);
		}
	}

	return $languages;
}
