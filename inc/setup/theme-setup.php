<?php
/**
 * Theme setup
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

function siliconexpert_theme_setup() {
	// Add theme support for title tag
	add_theme_support('title-tag');

	// Add theme support for post thumbnails (Featured Image)
	add_theme_support('post-thumbnails');

	// Add theme support for custom logo
	add_theme_support('custom-logo', array(
		'height' => 100,
		'width' => 400,
		'flex-height' => true,
		'flex-width' => true,
	));

	// Add theme support for HTML5 markup
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	// Add theme support for automatic feed links
	add_theme_support('automatic-feed-links');

	// Register navigation menus
	register_nav_menus(array(
		'header_menu' => 'Header Menu',
		'footer_menu' => 'Footer Menu',
	));
}
add_action('after_setup_theme', 'siliconexpert_theme_setup');

