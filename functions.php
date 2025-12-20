<?php
/**
 * Silicon Expert Theme Functions
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

// Define theme version
define('SILICON_EXPERT_VERSION', '1.0.0');

// Load Vite configuration
require_once get_template_directory() . '/inc/core/vite.php';

// Load theme setup
require_once get_template_directory() . '/inc/setup/theme-setup.php';
require_once get_template_directory() . '/inc/setup/blocks.php';

// Load enqueue functions
require_once get_template_directory() . '/inc/enqueue/enqueue.php';

// Load option pages
require_once get_template_directory() . '/inc/option-page/option-page.php';


