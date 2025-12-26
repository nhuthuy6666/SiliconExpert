<?php
/**
 * Auto-register all ACF blocks from blocks directory
 *
 * @package silicon-expert
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Register custom block category
 */
function siliconexpert_register_block_category($categories, $editor_context) {
	if (!empty($editor_context->post)) {
		array_unshift(
			$categories,
			array(
				'slug' => 'custom-blocks',
				'title' => __('Custom Blocks', 'silicon-expert'),
				'icon' => null,
			)
		);
	}
	return $categories;
}
add_filter('block_categories_all', 'siliconexpert_register_block_category', 10, 2);

/**
 * Register all blocks from blocks directory
 */
function siliconexpert_register_blocks() {
	if (!function_exists('acf_register_block_type')) {
		return;
	}

	$blocks_dir = get_template_directory() . '/blocks';
	if (!is_dir($blocks_dir)) {
		return;
	}

	$block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);
	if (!$block_folders) {
		return;
	}

	foreach ($block_folders as $block_folder) {
		$block_name = basename($block_folder);
		$block_json = $block_folder . '/block.json';

		if (!file_exists($block_json)) {
			continue;
		}

		$block_config = json_decode(file_get_contents($block_json), true);
		if (!$block_config || !isset($block_config['name'])) {
			continue;
		}

		// Extract slug from full block name (e.g., "acf/accordion" -> "accordion")
		$full_name = $block_config['name'];
		$slug = str_replace('acf/', '', $full_name);

		$block_args = array(
			'name' => $slug,
			'title' => $block_config['title'] ?? '',
			'description' => $block_config['description'] ?? '',
			'category' => $block_config['category'] ?? 'common',
			'icon' => $block_config['icon'] ?? '',
			'keywords' => $block_config['keywords'] ?? array(),
			'align' => $block_config['align'] ?? '',
			'mode' => $block_config['acf']['mode'] ?? 'preview',
			'render_callback' => 'siliconexpert_render_block',
			'supports' => $block_config['supports'] ?? array(),
		);

		$result = acf_register_block_type($block_args);
		if (!$result && defined('WP_DEBUG') && WP_DEBUG) {
			error_log('Failed to register block: ' . $full_name);
		}
	}
}

/**
 * Load ACF field groups from JSON files in blocks directory
 */
function siliconexpert_load_block_field_groups() {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	$blocks_dir = get_template_directory() . '/blocks';
	if (!is_dir($blocks_dir)) {
		return;
	}

	$block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);
	if (!$block_folders) {
		return;
	}

	foreach ($block_folders as $block_folder) {
		$json_files = glob($block_folder . '/*.json');
		if (!$json_files) {
			continue;
		}

		foreach ($json_files as $json_file) {
			if (basename($json_file) === 'block.json') {
				continue;
			}

			$field_group = json_decode(file_get_contents($json_file), true);
			if ($field_group && isset($field_group['key'])) {
				// Ensure menu_order is set
				if (!isset($field_group['menu_order'])) {
					$field_group['menu_order'] = 0;
				}
				// Ensure active is set
				if (!isset($field_group['active'])) {
					$field_group['active'] = true;
				}
				acf_add_local_field_group($field_group);
			}
		}
	}
}
add_action('acf/init', 'siliconexpert_load_block_field_groups', 5);

add_action('acf/init', 'siliconexpert_register_blocks', 10);

/**
 * Render callback for ACF blocks
 *
 * @param array $block Block data
 * @param string $content Block content (InnerBlocks)
 * @param bool $is_preview Is preview mode
 * @param int $post_id Post ID
 */
function siliconexpert_render_block($block, $content = '', $is_preview = false, $post_id = 0) {
	$block_name = $block['name'];
	$block_slug = str_replace('acf/', '', $block_name);
	$blocks_dir = get_template_directory() . '/blocks';
	$block_folder = $blocks_dir . '/' . $block_slug;

	if (!is_dir($block_folder)) {
		return;
	}

	$helpers_file = $block_folder . '/inc/helpers.php';
	if (file_exists($helpers_file)) {
		require_once $helpers_file;
	}

	// Determine appearance based on style field
	$appearance = 'default';
	
	// Check for common style field names
	$style_field_names = array('dropdown_style', 'style', 'appearance', 'block_style');
	
	foreach ($style_field_names as $field_name) {
		$style_value = get_field($field_name);
		if ($style_value) {
			// Extract the appearance name from the style value
			// e.g., 'style_default' -> 'default', 'style_mega' -> 'mega'
			if (strpos($style_value, 'style_') === 0) {
				$appearance = str_replace('style_', '', $style_value);
			} else {
				$appearance = $style_value;
			}
			break;
		}
	}
	
	$appearance_dir = $block_folder . '/appearances/' . $appearance;
	$render_file = $appearance_dir . '/render.php';
	
	// Fallback to default if appearance-specific render file doesn't exist
	if (!file_exists($render_file)) {
		$appearance = 'default';
		$appearance_dir = $block_folder . '/appearances/' . $appearance;
		$render_file = $appearance_dir . '/render.php';
	}

	if (!file_exists($render_file)) {
		echo '<p>Render template not found for block: ' . esc_html($block_name) . '</p>';
		return;
	}

	$data = null;
	$block_parts = preg_split('/[-_]/', $block_slug);
	$class_name_parts = array_map('ucfirst', $block_parts);
	$class_name = 'SiliconExpert\\Blocks\\' . implode('', $class_name_parts) . '\\Helpers';

	if (class_exists($class_name) && method_exists($class_name, 'getBlockData')) {
		$data = $class_name::getBlockData($block);
	}

	if (!$data) {
		$fields = get_fields();
		$data = is_array($fields) ? $fields : array();
		$data['custom_class'] = $block['className'] ?? '';
		$data = (object)$data;
	}

	include $render_file;
}

