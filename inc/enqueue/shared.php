<?php
/**
 * Shared enqueue functions - used by both dev and prod modes
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the main theme stylesheet (style.css).
 *
 * @param string $handle Stylesheet handle.
 */
function siliconexpert_enqueue_theme_style( string $handle ): void {
	wp_enqueue_style(
		$handle,
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}

/**
 * Enqueue custom admin CSS/JS if present in /admin folder.
 */
function siliconexpert_enqueue_admin_custom_assets(): void {
	$admin_css = get_template_directory() . '/admin/custom.css';

	if ( file_exists( $admin_css ) ) {
		wp_enqueue_style(
			'siliconexpert-admin-custom',
			get_template_directory_uri() . '/admin/custom.css',
			array(),
			filemtime( $admin_css )
		);
	}

	$admin_js = get_template_directory() . '/admin/custom.js';

	if ( file_exists( $admin_js ) ) {
		wp_enqueue_script(
			'siliconexpert-admin-custom',
			get_template_directory_uri() . '/admin/custom.js',
			array( 'jquery' ),
			filemtime( $admin_js ),
			true
		);
	}
}

/**
 * Enqueue scripts and styles for the frontend.
 *
 * - Uses vite_enqueue_assets() which is defined in vite-dev.php or vite-prod.php
 * - Also loads theme style.css and comment-reply script if needed
 */
function siliconexpert_scripts(): void {
	// Use Vite helper for main assets (JS/CSS from Vite).
	if ( function_exists( 'vite_enqueue_assets' ) ) {
		vite_enqueue_assets();
	}

	// Enqueue theme style.css (for WordPress theme header).
	siliconexpert_enqueue_theme_style( 'siliconexpert-theme-style' );

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'siliconexpert_scripts' );

/**
 * Enqueue scripts and styles for admin (including Edit Page).
 *
 * - In dev mode: loads from Vite dev server (HMR)
 * - In prod mode: loads CSS only from /fe/dist (no JS to avoid editor conflicts)
 */
function siliconexpert_admin_scripts(): void {
	global $pagenow;

	// Only load Vite assets on editor pages (post.php, post-new.php)
	$is_editor = in_array( $pagenow, array( 'post.php', 'post-new.php' ), true );

	if ( $is_editor ) {
		// Dev mode: use Vite dev server for HMR
		if ( function_exists( 'vite_enqueue_admin_dev_assets' ) ) {
			vite_enqueue_admin_dev_assets();
		} elseif ( function_exists( 'vite_enqueue_admin_styles' ) ) {
			// Prod mode: load CSS only (no JS to avoid editor conflicts)
			vite_enqueue_admin_styles();
		}
	}

	// Enqueue theme style.css (for WordPress theme header).
	siliconexpert_enqueue_theme_style( 'siliconexpert-admin-style' );

	// Enqueue custom admin CSS/JS.
	siliconexpert_enqueue_admin_custom_assets();
}
add_action( 'admin_enqueue_scripts', 'siliconexpert_admin_scripts' );
