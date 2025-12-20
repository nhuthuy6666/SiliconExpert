<?php
/**
 * Vite production mode - loads built assets from /fe/dist
 *
 * This file is loaded when Vite dev server is NOT running.
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Vite assets for production (from /fe/dist).
 *
 * Scans the dist directory and loads all built CSS and JS files.
 */
function vite_enqueue_assets(): void {
	if ( ! defined( 'VITE_DIST_DIR' ) ) {
		return;
	}

	$theme_dir = get_stylesheet_directory();
	$dist_dir  = $theme_dir . VITE_DIST_DIR;

	if ( ! is_dir( $dist_dir ) ) {
		return;
	}

	vite_enqueue_prod_assets_from_dist( $dist_dir );
}

/**
 * Enqueue all built CSS and JS files from a dist directory.
 *
 * @param string $dist_dir Absolute path to the dist directory.
 */
function vite_enqueue_prod_assets_from_dist( string $dist_dir ): void {
	$theme_dir = get_stylesheet_directory();
	$theme_uri = get_stylesheet_directory_uri();

	if ( ! is_dir( $dist_dir ) ) {
		return;
	}

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator(
			$dist_dir,
			FilesystemIterator::SKIP_DOTS | FilesystemIterator::FOLLOW_SYMLINKS
		)
	);

	$css_files = array();
	$js_files  = array();

	foreach ( $iterator as $file ) {
		/** @var SplFileInfo $file */
		if ( ! $file->isFile() ) {
			continue;
		}

		$extension = strtolower( $file->getExtension() );

		if ( 'css' === $extension ) {
			$css_files[] = $file->getPathname();
		} elseif ( 'js' === $extension ) {
			$js_files[] = $file->getPathname();
		}
	}

	// Enqueue CSS files
	vite_enqueue_css_files_from_dist( $css_files, $theme_dir, $theme_uri );

	// Sort JS: vendor files first, then app, then others
	$vendor_js = array();
	$app_js    = array();
	$other_js  = array();

	foreach ( $js_files as $absolute_path ) {
		$name = basename( $absolute_path );

		if ( false !== strpos( $name, 'vendor' ) ) {
			$vendor_js[] = $absolute_path;
		} elseif ( 'app.js' === $name || 0 === strpos( $name, 'app.' ) ) {
			$app_js[] = $absolute_path;
		} else {
			$other_js[] = $absolute_path;
		}
	}

	$ordered_js = array_merge( $vendor_js, $app_js, $other_js );

	// Enqueue JS files
	foreach ( $ordered_js as $index => $absolute_path ) {
		$relative_path = vite_build_relative_path( $absolute_path, $theme_dir );
		$handle        = 0 === $index ? 'theme-main' : 'theme-main-' . $index;

		wp_enqueue_script(
			$handle,
			$theme_uri . $relative_path,
			array( 'jquery' ),
			filemtime( $absolute_path ),
			true
		);

		// Mark as ES module
		if ( function_exists( 'wp_script_add_data' ) ) {
			wp_script_add_data( $handle, 'type', 'module' );
		}
	}

	// Ensure all theme-main scripts are type="module"
	add_filter(
		'script_loader_tag',
		static function ( $tag, $handle ) {
			if ( 0 === strpos( $handle, 'theme-main' ) ) {
				$tag = preg_replace( '/type=(["\']).*?\1/i', '', $tag );
				$tag = str_replace( '<script ', '<script type="module" ', $tag );
			}
			return $tag;
		},
		10,
		2
	);
}

/**
 * Enqueue CSS files from dist with preload optimization.
 *
 * @param array  $css_files Array of absolute CSS file paths.
 * @param string $theme_dir Theme directory path.
 * @param string $theme_uri Theme URI.
 */
function vite_enqueue_css_files_from_dist( array $css_files, string $theme_dir, string $theme_uri ): void {
	foreach ( $css_files as $index => $absolute_path ) {
		$relative_path = vite_build_relative_path( $absolute_path, $theme_dir );
		$handle        = 'theme-main-css' . ( $index ? '-' . $index : '' );

		// Add preload for the first CSS file (performance optimization)
		if ( 0 === $index ) {
			add_action(
				'wp_head',
				static function () use ( $theme_uri, $relative_path ) {
					echo '<link rel="preload" href="' . esc_url( $theme_uri . $relative_path ) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
					echo '<noscript><link rel="stylesheet" href="' . esc_url( $theme_uri . $relative_path ) . '"></noscript>' . "\n";
				},
				1
			);
		}

		wp_enqueue_style(
			$handle,
			$theme_uri . $relative_path,
			array(),
			filemtime( $absolute_path )
		);
	}
}

/**
 * Enqueue Vite-built CSS for admin screens only (no JS to avoid editor conflicts).
 */
function vite_enqueue_admin_styles(): void {
	if ( ! defined( 'VITE_DIST_DIR' ) ) {
		return;
	}

	$theme_dir = get_stylesheet_directory();
	$theme_uri = get_stylesheet_directory_uri();
	$dist_dir  = $theme_dir . VITE_DIST_DIR;

	if ( ! is_dir( $dist_dir ) ) {
		return;
	}

	$iterator  = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator(
			$dist_dir,
			FilesystemIterator::SKIP_DOTS | FilesystemIterator::FOLLOW_SYMLINKS
		)
	);
	$css_files = array();

	foreach ( $iterator as $file ) {
		/** @var SplFileInfo $file */
		if ( ! $file->isFile() ) {
			continue;
		}

		if ( 'css' === strtolower( $file->getExtension() ) ) {
			$css_files[] = $file->getPathname();
		}
	}

	if ( ! $css_files ) {
		return;
	}

	vite_enqueue_css_files_from_dist( $css_files, $theme_dir, $theme_uri );
}

/**
 * Build normalized relative path from an absolute file path.
 *
 * @param string $absolute_path Absolute file path.
 * @param string $theme_dir     Theme directory path.
 *
 * @return string Relative path (always starts with "/").
 */
function vite_build_relative_path( string $absolute_path, string $theme_dir ): string {
	$relative_path = str_replace( $theme_dir, '', $absolute_path );
	$relative_path = str_replace( '\\', '/', $relative_path );

	if ( 0 !== strpos( $relative_path, '/' ) ) {
		$relative_path = '/' . $relative_path;
	}

	return $relative_path;
}
