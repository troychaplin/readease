<?php
/**
 * Plugin Name:       FlexType
 * Description:       FlexType is a Gutenberg block plugin that provides visitor text resizing controls.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       flextype
 *
 * @package FlexType
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main plugin class for FlexType.
 */
class FlexType {

	/**
	 * Constructor. Registers hooks for admin menu, settings, template, and admin bar.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'create_block_flextype_block_init' ) );
	}

	/**
	 * Adds the settings page under Settings menu.
	 */
	public function create_block_flextype_block_init() {
		if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
			wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
			return;
		}

		if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
			wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		}

		$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
		foreach ( array_keys( $manifest_data ) as $block_type ) {
			register_block_type( __DIR__ . "/build/{$block_type}" );
		}
	}
}

new FlexType();
