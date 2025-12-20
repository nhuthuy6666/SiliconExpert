<?php
/**
 * Vite enqueue entry point - auto-detects dev or prod mode
 *
 * This is the main entry point for Vite asset loading.
 * It automatically detects if Vite dev server is running and loads the appropriate file.
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Always load shared functions (hooks, theme style, admin assets)
require_once __DIR__ . '/shared.php';

// Auto-detect dev or prod mode
if ( function_exists( 'vite_is_dev_server_running' ) && vite_is_dev_server_running() ) {
	// Dev mode: use Vite dev server (HMR)
	require_once __DIR__ . '/vite-dev.php';
} else {
	// Prod mode: use built assets from /fe/dist
	require_once __DIR__ . '/vite-prod.php';
}
