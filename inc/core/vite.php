<?php
/**
 * Vite integration helpers for the theme.
 *
 * Defines constants and utility functions used by the enqueue layer.
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ==========================
// Vite config constants
// ==========================

/**
 * Vite development server URL.
 *
 * Used in development mode when no dist directory is present.
 */
const VITE_DEV_SERVER = 'http://localhost:5173';

/**
 * Main Vite entry file.
 *
 * Path is relative to the Vite root (fe/src), and should start with a slash.
 */
const VITE_ENTRY = '/main.js';

/**
 * Admin Vite entry file (CSS-only JS entry for wp-admin).
 *
 * Path is relative to the Vite root (fe/src), and should start with a slash.
 */
const VITE_ADMIN_ENTRY = '/admin.js';

/**
 * Build output directory.
 *
 * Path is relative to the theme root. When this directory exists,
 * the theme will enqueue all built assets inside it.
 */
const VITE_DIST_DIR = '/fe/dist';

/**
 * Path to Vite manifest file (optional, kept for backward compatibility).
 *
 * Path is relative to the theme root.
 */
const VITE_MANIFEST = '/fe/dist/.vite/manifest.json';

// ==========================
// Dev server detection
// ==========================

/**
 * Check if the Vite dev server is running.
 *
 * @return bool True if the dev server responds, false otherwise.
 */
function vite_is_dev_server_running(): bool {
	$dev_server_url = VITE_DEV_SERVER . '/@vite/client';

	// Use a short timeout; we only care about "alive" or "not".
	$context = stream_context_create(
		array(
			'http' => array(
				'method'  => 'GET',
				'timeout' => 1,
			),
		)
	);

	$handle = @fopen( $dev_server_url, 'r', false, $context );

	if ( false === $handle ) {
		return false;
	}

	fclose( $handle );

	return true;
}
