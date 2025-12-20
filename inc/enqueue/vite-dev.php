<?php
/**
 * Vite development mode - loads assets from Vite dev server (HMR)
 *
 * This file is loaded when Vite dev server is running.
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Vite assets for development (dev server).
 *
 * Loads JS and CSS from the Vite dev server with HMR support.
 */
function vite_enqueue_assets(): void {
	vite_enqueue_dev_assets();
}

/**
 * Enqueue main theme assets from Vite dev server.
 */
function vite_enqueue_dev_assets(): void {
	if ( ! defined( 'VITE_DEV_SERVER' ) || ! defined( 'VITE_ENTRY' ) ) {
		error_log( '[Vite] VITE_DEV_SERVER or VITE_ENTRY is not defined' );
		return;
	}

	$vite_base = VITE_DEV_SERVER;
	$entry     = VITE_ENTRY;

	vite_enqueue_dev_classic_scripts( $vite_base, $entry );
}

/**
 * Enqueue admin assets from Vite dev server.
 *
 * Uses a dedicated admin entry that only imports CSS (no JS logic to avoid TinyMCE conflicts).
 */
function vite_enqueue_admin_dev_assets(): void {
	if ( ! defined( 'VITE_DEV_SERVER' ) || ! defined( 'VITE_ADMIN_ENTRY' ) ) {
		error_log( '[Vite] VITE_DEV_SERVER or VITE_ADMIN_ENTRY is not defined' );
		return;
	}

	$vite_base = VITE_DEV_SERVER;
	$entry     = VITE_ADMIN_ENTRY;

	vite_enqueue_dev_classic_scripts( $vite_base, $entry );
}

/**
 * Enqueue development scripts using classic script tags with type="module".
 *
 * @param string $vite_base Base URL of the Vite dev server.
 * @param string $entry     Entry path (e.g., /main.js).
 */
function vite_enqueue_dev_classic_scripts( string $vite_base, string $entry ): void {
	// Vite client for HMR (Hot Module Replacement)
	wp_enqueue_script(
		'vite-client',
		$vite_base . '/@vite/client',
		array(),
		null,
		false
	);

	// Main theme entry
	wp_enqueue_script(
		'theme-main',
		$vite_base . $entry,
		array( 'vite-client', 'jquery' ),
		null,
		false
	);

	// Add type="module" to both scripts (required for Vite/ES Modules)
	add_filter(
		'script_loader_tag',
		static function ( $tag, $handle ) {
			if ( in_array( $handle, array( 'vite-client', 'theme-main' ), true ) ) {
				$tag = preg_replace( '/type=(["\']).*?\1/i', '', $tag );
				$tag = str_replace( '<script ', '<script type="module" ', $tag );
			}
			return $tag;
		},
		10,
		2
	);
}
