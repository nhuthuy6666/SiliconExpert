<?php

if (!defined('ABSPATH')) {
	exit;
}

function siliconexpert_menu_item_meta_get($item_id, $key, $default = '') {
	$value = get_post_meta($item_id, $key, true);
	if ($value === '' || $value === null) {
		return $default;
	}
	return $value;
}

function siliconexpert_menu_item_meta_get_bool($item_id, $key, $default = false) {
	$value = siliconexpert_menu_item_meta_get($item_id, $key, $default ? '1' : '0');
	return in_array((string) $value, array('1', 'true', 'yes', 'on'), true);
}

function siliconexpert_parse_lines_to_items($lines, $max_items = 0, $pair_delimiter = '|') {
	$lines = is_string($lines) ? $lines : '';
	$raw_lines = preg_split("/\r\n|\r|\n/", $lines);
	$items = array();
	foreach ($raw_lines as $raw) {
		$raw = trim($raw);
		if ($raw === '') {
			continue;
		}
		$parts = explode($pair_delimiter, $raw, 2);
		$title = trim($parts[0] ?? '');
		$text = trim($parts[1] ?? '');
		if ($title === '' && $text === '') {
			continue;
		}
		$items[] = array(
			'title' => $title,
			'text' => $text,
		);
		if ($max_items > 0 && count($items) >= $max_items) {
			break;
		}
	}
	return $items;
}

add_action('wp_nav_menu_item_custom_fields', function ($item_id, $item, $depth, $args) {
	if (!current_user_can('edit_theme_options')) {
		return;
	}
	if ((int) $depth !== 0) {
		return;
	}

	$enabled = siliconexpert_menu_item_meta_get_bool($item_id, '_se_popover_enabled', false);
	$type = siliconexpert_menu_item_meta_get($item_id, '_se_popover_type', '');
	$heading1 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_heading1', '');
	$heading2 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_heading2', '');
	$heading3 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_heading3', '');
	$subheading1 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_subheading1', '');
	$subheading2 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_subheading2', '');
	$subheading3 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_subheading3', '');
	$image1 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_image1', '');
	$image2 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_image2', '');
	$image3 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_image3', '');
	$button_text = siliconexpert_menu_item_meta_get($item_id, '_se_popover_button_text', '');
	$button_link = siliconexpert_menu_item_meta_get($item_id, '_se_popover_button_link', '');
	$items1 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_items1', '');
	$items2 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_items2', '');
	$items3 = siliconexpert_menu_item_meta_get($item_id, '_se_popover_items3', '');

	$name_prefix = 'se_menu_item_meta[' . (int) $item_id . ']';
	?>
	<div class="field-se-popover-enabled description-wide" style="margin: 10px 0 0; padding: 10px 12px; border: 1px solid #ccd0d4;">
		<p style="margin: 0 0 10px; font-weight: 600;">Popover</p>
		<p class="description" style="margin: 0 0 10px;">Enable popover content for this menu item and configure its layout.</p>

		<p class="field-se-popover-toggle description description-wide">
			<label for="edit-menu-item-se-popover-enabled-<?php echo (int) $item_id; ?>">
				<input type="checkbox" id="edit-menu-item-se-popover-enabled-<?php echo (int) $item_id; ?>" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_enabled]" value="1" <?php checked($enabled); ?> />
				Enable Popover
			</label>
		</p>

		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-type-<?php echo (int) $item_id; ?>">Popover type<br />
				<select id="edit-menu-item-se-popover-type-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_type]">
					<option value="" <?php selected($type, ''); ?>>None</option>
					<option value="mega" <?php selected($type, 'mega'); ?>>Mega (Solutions)</option>
					<option value="simple" <?php selected($type, 'simple'); ?>>Simple (Partners)</option>
					<option value="modern" <?php selected($type, 'modern'); ?>>Modern (Resources)</option>
					<option value="classic" <?php selected($type, 'classic'); ?>>Classic (Company)</option>
				</select>
			</label>
		</p>

		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-heading1-<?php echo (int) $item_id; ?>">Heading 1<br />
				<input type="text" id="edit-menu-item-se-popover-heading1-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_heading1]" value="<?php echo esc_attr($heading1); ?>" />
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-heading2-<?php echo (int) $item_id; ?>">Heading 2<br />
				<input type="text" id="edit-menu-item-se-popover-heading2-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_heading2]" value="<?php echo esc_attr($heading2); ?>" />
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-heading3-<?php echo (int) $item_id; ?>">Heading 3<br />
				<input type="text" id="edit-menu-item-se-popover-heading3-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_heading3]" value="<?php echo esc_attr($heading3); ?>" />
			</label>
		</p>

		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-subheading1-<?php echo (int) $item_id; ?>">Subheading 1<br />
				<input type="text" id="edit-menu-item-se-popover-subheading1-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_subheading1]" value="<?php echo esc_attr($subheading1); ?>" />
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-subheading2-<?php echo (int) $item_id; ?>">Subheading 2<br />
				<input type="text" id="edit-menu-item-se-popover-subheading2-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_subheading2]" value="<?php echo esc_attr($subheading2); ?>" />
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-subheading3-<?php echo (int) $item_id; ?>">Subheading 3<br />
				<input type="text" id="edit-menu-item-se-popover-subheading3-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_subheading3]" value="<?php echo esc_attr($subheading3); ?>" />
			</label>
		</p>

		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-image1-<?php echo (int) $item_id; ?>">Image 1 URL or Path<br />
				<input type="text" id="edit-menu-item-se-popover-image1-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_image1]" value="<?php echo esc_attr($image1); ?>" />
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-image2-<?php echo (int) $item_id; ?>">Image 2 URL or Path<br />
				<input type="text" id="edit-menu-item-se-popover-image2-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_image2]" value="<?php echo esc_attr($image2); ?>" />
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-image3-<?php echo (int) $item_id; ?>">Image 3 URL or Path<br />
				<input type="text" id="edit-menu-item-se-popover-image3-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_image3]" value="<?php echo esc_attr($image3); ?>" />
			</label>
		</p>

		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-button-text-<?php echo (int) $item_id; ?>">Button text<br />
				<input type="text" id="edit-menu-item-se-popover-button-text-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_button_text]" value="<?php echo esc_attr($button_text); ?>" />
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-button-link-<?php echo (int) $item_id; ?>">Button link<br />
				<input type="url" id="edit-menu-item-se-popover-button-link-<?php echo (int) $item_id; ?>" class="widefat" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_button_link]" value="<?php echo esc_attr($button_link); ?>" />
			</label>
		</p>

		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-items1-<?php echo (int) $item_id; ?>">Items list 1 (one per line, format: Title|Text)<br />
				<textarea id="edit-menu-item-se-popover-items1-<?php echo (int) $item_id; ?>" class="widefat" rows="4" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_items1]"><?php echo esc_textarea($items1); ?></textarea>
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-se-popover-items2-<?php echo (int) $item_id; ?>">Items list 2 (one per line, format: Title|Text)<br />
				<textarea id="edit-menu-item-se-popover-items2-<?php echo (int) $item_id; ?>" class="widefat" rows="4" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_items2]"><?php echo esc_textarea($items2); ?></textarea>
			</label>
		</p>
		<p class="description description-wide" style="margin-bottom: 0;">
			<label for="edit-menu-item-se-popover-items3-<?php echo (int) $item_id; ?>">Items list 3 (one per line, format: Title|Text)<br />
				<textarea id="edit-menu-item-se-popover-items3-<?php echo (int) $item_id; ?>" class="widefat" rows="4" name="<?php echo esc_attr($name_prefix); ?>[_se_popover_items3]"><?php echo esc_textarea($items3); ?></textarea>
			</label>
		</p>
	</div>
	<?php
}, 10, 4);

add_action('wp_update_nav_menu_item', function ($menu_id, $menu_item_db_id, $args) {
	if (!current_user_can('edit_theme_options')) {
		return;
	}
	if (empty($_POST['se_menu_item_meta']) || !is_array($_POST['se_menu_item_meta'])) {
		return;
	}
	$all = wp_unslash($_POST['se_menu_item_meta']);
	if (empty($all[$menu_item_db_id]) || !is_array($all[$menu_item_db_id])) {
		$all[$menu_item_db_id] = array();
	}
	$data = $all[$menu_item_db_id];

	$fields = array(
		'_se_popover_enabled' => 'bool',
		'_se_popover_type' => 'text',
		'_se_popover_heading1' => 'text',
		'_se_popover_heading2' => 'text',
		'_se_popover_heading3' => 'text',
		'_se_popover_subheading1' => 'text',
		'_se_popover_subheading2' => 'text',
		'_se_popover_subheading3' => 'text',
		'_se_popover_image1' => 'text',
		'_se_popover_image2' => 'text',
		'_se_popover_image3' => 'text',
		'_se_popover_button_text' => 'text',
		'_se_popover_button_link' => 'url',
		'_se_popover_items1' => 'textarea',
		'_se_popover_items2' => 'textarea',
		'_se_popover_items3' => 'textarea',
	);

	foreach ($fields as $key => $type) {
		$raw = $data[$key] ?? '';
		$value = '';
		switch ($type) {
			case 'bool':
				$value = !empty($raw) ? '1' : '0';
				break;
			case 'url':
				$value = $raw !== '' ? esc_url_raw((string) $raw) : '';
				break;
			case 'textarea':
				$value = $raw !== '' ? sanitize_textarea_field((string) $raw) : '';
				break;
			case 'text':
			default:
				$value = $raw !== '' ? sanitize_text_field((string) $raw) : '';
				break;
		}
		if ($value === '') {
			delete_post_meta($menu_item_db_id, $key);
		} else {
			update_post_meta($menu_item_db_id, $key, $value);
		}
	}
}, 10, 3);
