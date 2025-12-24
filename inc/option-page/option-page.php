<?php

/**
 * ACF Options Page Configuration
 */

// Register ACF Options Page
if (function_exists('acf_add_options_page')) {
	
	// Main options page
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'icon_url'		=> 'dashicons-admin-settings',
		'redirect'		=> true
	));
	
	// Sub-page: Header Settings
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'menu_slug' 	=> 'theme-footer-settings',
		'parent_slug'	=> 'theme-settings',
	));
}

/**
 * Register ACF Field Groups
 */

if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group(array(
		'key' => 'group_theme_footer',
		'title' => 'Footer Settings',
		'fields' => array(
			array(
				'key' => 'field_footer_logo',
				'label' => 'Footer Logo',
				'name' => 'footer_logo',
				'type' => 'image',
				'return_format' => 'url',
			),
			array(
				'key' => 'field_footer_get_started_text',
				'label' => 'Get Started Button Text',
				'name' => 'footer_get_started_text',
				'type' => 'text',
				'default_value' => 'Get Started',
			),
			array(
				'key' => 'field_footer_get_started_link',
				'label' => 'Get Started Button Link',
				'name' => 'footer_get_started_link',
				'type' => 'url',
				'default_value' => 'http://siliconexpert.local/',
			),
			array(
				'key' => 'field_footer_button_grid',
				'label' => 'Button Grid',
				'name' => 'button_grid',
				'type' => 'select',
				'choices' => array(
					'grid1' => 'Grid 1',
					'grid2' => 'Grid 2',
					'grid3' => 'Grid 3',
					'grid4' => 'Grid 4',
				),
				'default_value' => 'grid4',
				'allow_null' => 0,
				'ui' => 1,
				'return_format' => 'value',
			),
			array(
				'key' => 'field_footer_columns_tab',
				'label' => 'Footer Columns',
				'name' => 'footer_columns_tab',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_footer_grids',
				'label' => 'Grids',
				'name' => 'footer_grids',
				'type' => 'group',
				'sub_fields' => array(
					array(
						'key' => 'field_footer_grid1',
						'label' => 'Grid 1',
						'name' => 'grid1',
						'type' => 'group',
						'sub_fields' => array(
							array(
								'key' => 'field_footer_grid1_columns',
								'label' => 'Columns',
								'name' => 'columns',
								'type' => 'repeater',
								'layout' => 'row',
								'button_label' => 'Add Column',
								'max' => 2,
								'sub_fields' => array(
									array(
										'key' => 'field_footer_grid1_sections',
										'label' => 'Sections',
										'name' => 'sections',
										'type' => 'repeater',
										'layout' => 'row',
										'button_label' => 'Add Section',
										'max' => 1,
										'sub_fields' => array(
											array(
												'key' => 'field_footer_grid1_section_title',
												'label' => 'Section Title',
												'name' => 'title',
												'type' => 'text',
												'required' => 1,
											),
											array(
												'key' => 'field_footer_grid1_section_links',
												'label' => 'Links',
												'name' => 'links',
												'type' => 'repeater',
												'layout' => 'row',
												'button_label' => 'Add Link',
												'max' => 8,
												'sub_fields' => array(
													array(
														'key' => 'field_footer_grid1_link_text',
														'label' => 'Link Text',
														'name' => 'text',
														'type' => 'text',
														'required' => 1,
													),
													array(
														'key' => 'field_footer_grid1_link_url',
														'label' => 'Link URL',
														'name' => 'url',
														'type' => 'url',
														'default_value' => 'http://siliconexpert.local/',
													),
												),
											),
										),
									),
								),
							),
						),
					),
					array(
						'key' => 'field_footer_grid2',
						'label' => 'Grid 2',
						'name' => 'grid2',
						'type' => 'group',
						'sub_fields' => array(
							array(
								'key' => 'field_footer_grid2_columns',
								'label' => 'Columns',
								'name' => 'columns',
								'type' => 'repeater',
								'layout' => 'row',
								'button_label' => 'Add Column',
								'max' => 2,
								'sub_fields' => array(
									array(
										'key' => 'field_footer_grid2_sections',
										'label' => 'Sections',
										'name' => 'sections',
										'type' => 'repeater',
										'layout' => 'row',
										'button_label' => 'Add Section',
										'max' => 1,
										'sub_fields' => array(
											array(
												'key' => 'field_footer_grid2_section_title',
												'label' => 'Section Title',
												'name' => 'title',
												'type' => 'text',
												'required' => 1,
											),
											array(
												'key' => 'field_footer_grid2_section_links',
												'label' => 'Links',
												'name' => 'links',
												'type' => 'repeater',
												'layout' => 'row',
												'button_label' => 'Add Link',
												'max' => 8,
												'sub_fields' => array(
													array(
														'key' => 'field_footer_grid2_link_text',
														'label' => 'Link Text',
														'name' => 'text',
														'type' => 'text',
														'required' => 1,
													),
													array(
														'key' => 'field_footer_grid2_link_url',
														'label' => 'Link URL',
														'name' => 'url',
														'type' => 'url',
														'default_value' => 'http://siliconexpert.local/',
													),
												),
											),
										),
									),
								),
							),
						),
					),
					array(
						'key' => 'field_footer_grid3',
						'label' => 'Grid 3',
						'name' => 'grid3',
						'type' => 'group',
						'sub_fields' => array(
							array(
								'key' => 'field_footer_grid3_columns',
								'label' => 'Columns',
								'name' => 'columns',
								'type' => 'repeater',
								'layout' => 'row',
								'button_label' => 'Add Column',
								'max' => 2,
								'sub_fields' => array(
									array(
										'key' => 'field_footer_grid3_sections',
										'label' => 'Sections',
										'name' => 'sections',
										'type' => 'repeater',
										'layout' => 'row',
										'button_label' => 'Add Section',
										'max' => 1,
										'sub_fields' => array(
											array(
												'key' => 'field_footer_grid3_section_title',
												'label' => 'Section Title',
												'name' => 'title',
												'type' => 'text',
												'required' => 1,
											),
											array(
												'key' => 'field_footer_grid3_section_links',
												'label' => 'Links',
												'name' => 'links',
												'type' => 'repeater',
												'layout' => 'row',
												'button_label' => 'Add Link',
												'max' => 8,
												'sub_fields' => array(
													array(
														'key' => 'field_footer_grid3_link_text',
														'label' => 'Link Text',
														'name' => 'text',
														'type' => 'text',
														'required' => 1,
													),
													array(
														'key' => 'field_footer_grid3_link_url',
														'label' => 'Link URL',
														'name' => 'url',
														'type' => 'url',
														'default_value' => 'http://siliconexpert.local/',
													),
												),
											),
										),
									),
								),
							),
						),
					),
					array(
						'key' => 'field_footer_grid4',
						'label' => 'Grid 4',
						'name' => 'grid4',
						'type' => 'group',
						'sub_fields' => array(
							array(
								'key' => 'field_footer_grid4_columns',
								'label' => 'Columns',
								'name' => 'columns',
								'type' => 'repeater',
								'layout' => 'row',
								'button_label' => 'Add Column',
								'max' => 2,
								'sub_fields' => array(
									array(
										'key' => 'field_footer_grid4_sections',
										'label' => 'Sections',
										'name' => 'sections',
										'type' => 'repeater',
										'layout' => 'row',
										'button_label' => 'Add Section',
										'max' => 1,
										'sub_fields' => array(
											array(
												'key' => 'field_footer_grid4_section_title',
												'label' => 'Section Title',
												'name' => 'title',
												'type' => 'text',
												'required' => 1,
											),
											array(
												'key' => 'field_footer_grid4_section_links',
												'label' => 'Links',
												'name' => 'links',
												'type' => 'repeater',
												'layout' => 'row',
												'button_label' => 'Add Link',
												'max' => 8,
												'sub_fields' => array(
													array(
														'key' => 'field_footer_grid4_link_text',
														'label' => 'Link Text',
														'name' => 'text',
														'type' => 'text',
														'required' => 1,
													),
													array(
														'key' => 'field_footer_grid4_link_url',
														'label' => 'Link URL',
														'name' => 'url',
														'type' => 'url',
														'default_value' => 'http://siliconexpert.local/',
													),
												),
											),
										),
									),
								),
							),
						),
					),
				),
			),
			array(
				'key' => 'field_footer_bottom_tab',
				'label' => 'Footer Bottom',
				'name' => 'footer_bottom_tab',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_footer_copyright',
				'label' => 'Copyright Text',
				'name' => 'footer_copyright',
				'type' => 'text',
				'default_value' => ' 2025 SiliconExpert. All Rights Reserved.',
			),
			array(
				'key' => 'field_footer_address',
				'label' => 'Address',
				'name' => 'footer_address',
				'type' => 'text',
				'default_value' => '9151 E Panorama Circle Centennial, CO 80112',
			),
			array(
				'key' => 'field_footer_phone',
				'label' => 'Phone',
				'name' => 'footer_phone',
				'type' => 'text',
				'default_value' => '408.330.7575',
			),
			array(
				'key' => 'field_footer_privacy_text',
				'label' => 'Privacy Policy Text',
				'name' => 'footer_privacy_text',
				'type' => 'text',
				'default_value' => 'Privacy Policy',
			),
			array(
				'key' => 'field_footer_privacy_link',
				'label' => 'Privacy Policy Link',
				'name' => 'footer_privacy_link',
				'type' => 'url',
				'default_value' => 'http://siliconexpert.local/',
			),
			array(
				'key' => 'field_footer_terms_text',
				'label' => 'Terms of Use Text',
				'name' => 'footer_terms_text',
				'type' => 'text',
				'default_value' => 'Terms of Use',
			),
			array(
				'key' => 'field_footer_terms_link',
				'label' => 'Terms of Use Link',
				'name' => 'footer_terms_link',
				'type' => 'url',
				'default_value' => 'http://siliconexpert.local/',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-footer-settings',
				),
			),
		),
	));
}

if (is_admin()) {
	add_action('acf/validate_save_post', function () {
		if (!function_exists('acf_add_validation_error')) {
			return;
		}
		if (empty($_REQUEST['page']) || $_REQUEST['page'] !== 'theme-footer-settings') {
			return;
		}
		if (empty($_POST['acf']) || !is_array($_POST['acf'])) {
			return;
		}

		$acf = $_POST['acf'];
		$button_grid = $acf['field_footer_button_grid'] ?? '';
		if ($button_grid === '') {
			$grids_field_key = 'field_footer_grids';
			$grids = $acf[$grids_field_key] ?? null;
			if (!empty($grids) && is_array($grids)) {
				$button_grid = $grids['field_footer_button_grid'] ?? '';
			}
		}
		$allowed = array('', 'grid1', 'grid2', 'grid3', 'grid4');
		if (!in_array($button_grid, $allowed, true)) {
			acf_add_validation_error('field_footer_button_grid', 'Invalid Button Grid selection.');
		}
	});
}
