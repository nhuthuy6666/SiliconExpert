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
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'menu_slug' 	=> 'theme-header-settings',
		'parent_slug'	=> 'theme-settings',
	));

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

// Field Group: Header Settings
if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group(array(
		'key' => 'group_theme_header',
		'title' => 'Header Settings',
		'fields' => array(
			array(
				'key' => 'field_header_tab_solutions_products',
				'label' => 'Solutions & Products',
				'name' => 'header_tab_solutions_products',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_mega_menu_heading1',
				'label' => 'Mega Menu - Solutions Heading',
				'name' => 'mega_menu_heading1',
				'type' => 'text',
				'instructions' => 'Heading for Solutions section',
				'default_value' => 'Solutions',
			),
			array(
				'key' => 'field_mega_menu_heading1_text',
				'label' => 'Mega Menu - Solutions Items',
				'name' => 'mega_menu_heading1_text',
				'type' => 'repeater',
				'instructions' => 'Add solutions items (max 3)',
				'min' => 1,
				'max' => 3,
				'layout' => 'row',
				'button_label' => 'Add Solution',
				'sub_fields' => array(
					array(
						'key' => 'field_mega_menu_heading1_title',
						'label' => 'Title',
						'name' => 'title_hero',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'For Engineering',
					),
					array(
						'key' => 'field_mega_menu_heading1_desc',
						'label' => 'Description',
						'name' => 'text_hero',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'Lorem ipsum dolor sit amet consectetur.',
					),
				),
			),
			array(
				'key' => 'field_mega_menu_heading2',
				'label' => 'Mega Menu - Products Heading',
				'name' => 'mega_menu_heading2',
				'type' => 'text',
				'instructions' => 'Heading for Products section',
				'default_value' => 'Products',
			),
			array(
				'key' => 'field_mega_menu_heading2_text',
				'label' => 'Mega Menu - Products Items',
				'name' => 'mega_menu_heading2_text',
				'type' => 'repeater',
				'instructions' => 'Add products items (max 8, will split into 2 columns)',
				'min' => 1,
				'max' => 8,
				'layout' => 'row',
				'button_label' => 'Add Product',
				'sub_fields' => array(
					array(
						'key' => 'field_mega_menu_heading2_title',
						'label' => 'Title',
						'name' => 'title_hero',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'Part Search',
					),
					array(
						'key' => 'field_mega_menu_heading2_desc',
						'label' => 'Description',
						'name' => 'text_hero',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'Lorem ipsum dolor sit amet consectetur.',
					),
				),
			),
			array(
				'key' => 'field_mega_menu_heading3',
				'label' => 'Mega Menu - Services Heading',
				'name' => 'mega_menu_heading3',
				'type' => 'text',
				'instructions' => 'Heading for Services section',
				'default_value' => 'Services',
			),
			array(
				'key' => 'field_mega_menu_heading3_text',
				'label' => 'Mega Menu - Services Items',
				'name' => 'mega_menu_heading3_text',
				'type' => 'repeater',
				'instructions' => 'Add services items (max 2)',
				'min' => 1,
				'max' => 2,
				'layout' => 'row',
				'button_label' => 'Add Service',
				'sub_fields' => array(
					array(
						'key' => 'field_mega_menu_heading3_title',
						'label' => 'Title',
						'name' => 'title_hero',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'Solutions by Industry',
					),
					array(
						'key' => 'field_mega_menu_heading3_desc',
						'label' => 'Description',
						'name' => 'text_hero',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'See how Silicon Expert supports resilience across key industry verticals.',
					),
				),
			),
			array(
				'key' => 'field_mega_menu_image',
				'label' => 'Mega Menu - Image',
				'name' => 'mega_menu_image',
				'type' => 'image',
				'instructions' => 'Image for mega menu (displayed in Solutions section)',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_header_tab_partner_integrations',
				'label' => 'Partner Integrations',
				'name' => 'header_tab_partner_integrations',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_partner_simple_heading1',
				'label' => 'Partner Integrations - Heading',
				'name' => 'partner_simple_heading1',
				'type' => 'text',
				'default_value' => 'Partner Integrations',
			),
			array(
				'key' => 'field_partner_simple_image1',
				'label' => 'Partner Integrations - Image 1',
				'name' => 'partner_simple_image1',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_partner_simple_heading1_text',
				'label' => 'Partner Integrations - Items',
				'name' => 'partner_simple_heading1_text',
				'type' => 'repeater',
				'min' => 1,
				'max' => 5,
				'layout' => 'row',
				'button_label' => 'Add Item',
				'sub_fields' => array(
					array(
						'key' => 'field_partner_simple_heading1_text_item',
						'label' => 'Text',
						'name' => 'simple_text',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'EDA (Electronic Design Automation)',
					),
				),
			),
			array(
				'key' => 'field_partner_simple_button_text',
				'label' => 'Partner Integrations - Button Text',
				'name' => 'partner_simple_button_text',
				'type' => 'text',
				'default_value' => 'See all Partners',
			),
			array(
				'key' => 'field_partner_simple_button_link',
				'label' => 'Partner Integrations - Button Link',
				'name' => 'partner_simple_button_link',
				'type' => 'url',
				'default_value' => '#',
			),
			array(
				'key' => 'field_partner_simple_heading2',
				'label' => 'Partner Integrations - Heading 2',
				'name' => 'partner_simple_heading2',
				'type' => 'text',
				'default_value' => 'Become a Partner',
			),
			array(
				'key' => 'field_partner_simple_text2',
				'label' => 'Partner Integrations - Text 2',
				'name' => 'partner_simple_text2',
				'type' => 'text',
				'default_value' => 'Lorem ipsum dolor sit amet consectetur.',
			),
			array(
				'key' => 'field_partner_simple_image2',
				'label' => 'Partner Integrations - Image 2',
				'name' => 'partner_simple_image2',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_header_tab_resources',
				'label' => 'Resources',
				'name' => 'header_tab_resources',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_resources_modern_heading1',
				'label' => 'Resources - Heading 1',
				'name' => 'resources_modern_heading1',
				'type' => 'text',
				'default_value' => 'Resources',
			),
			array(
				'key' => 'field_resources_modern_image',
				'label' => 'Resources - Image',
				'name' => 'resources_modern_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_resources_modern_subheading1',
				'label' => 'Resources - Subheading 1',
				'name' => 'resources_modern_subheading1',
				'type' => 'text',
				'default_value' => 'Feature resource article title here with option to show multiple lines',
			),
			array(
				'key' => 'field_resources_modern_button_text',
				'label' => 'Resources - Button Text',
				'name' => 'resources_modern_button_text',
				'type' => 'text',
				'default_value' => 'See all Resources',
			),
			array(
				'key' => 'field_resources_modern_button_link',
				'label' => 'Resources - Button Link',
				'name' => 'resources_modern_button_link',
				'type' => 'url',
				'default_value' => 'http://siliconexpert.local/',
			),
			array(
				'key' => 'field_resources_modern_heading1_text',
				'label' => 'Resources - Heading 1 Items',
				'name' => 'resources_modern_heading1_text',
				'type' => 'repeater',
				'min' => 1,
				'max' => 5,
				'layout' => 'row',
				'button_label' => 'Add Item',
				'sub_fields' => array(
					array(
						'key' => 'field_resources_modern_heading1_text_item',
						'label' => 'Text',
						'name' => 'modern_text',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'Blog',
					),
				),
			),
			array(
				'key' => 'field_resources_modern_heading2',
				'label' => 'Resources - Heading 2',
				'name' => 'resources_modern_heading2',
				'type' => 'text',
				'default_value' => 'Knowledge Center',
			),
			array(
				'key' => 'field_resources_modern_text2',
				'label' => 'Resources - Heading 2 Items',
				'name' => 'resources_modern_text2',
				'type' => 'repeater',
				'min' => 1,
				'max' => 7,
				'layout' => 'row',
				'button_label' => 'Add Item',
				'sub_fields' => array(
					array(
						'key' => 'field_resources_modern_text2_item',
						'label' => 'Text',
						'name' => 'modern_text',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'Case Studies',
					),
				),
			),
			array(
				'key' => 'field_header_tab_company',
				'label' => 'Company',
				'name' => 'header_tab_company',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_company_classic_heading1',
				'label' => 'Company - Heading 1',
				'name' => 'company_classic_heading1',
				'type' => 'text',
				'default_value' => 'Company',
			),
			array(
				'key' => 'field_company_classic_subheading1',
				'label' => 'Company - Subheading 1',
				'name' => 'company_classic_subheading1',
				'type' => 'text',
				'default_value' => 'Lorem ipsum dolor sit amet consectetur. Risus eget purus maecenas eleifend at non augue. Lorem ipsum dolor sit amet consectetur. Risus eget purus maecenas eleifend at non augue.',
			),
			array(
				'key' => 'field_company_classic_button_text',
				'label' => 'Company - Button Text',
				'name' => 'company_classic_button_text',
				'type' => 'text',
				'default_value' => 'Careers',
			),
			array(
				'key' => 'field_company_classic_button_link',
				'label' => 'Company - Button Link',
				'name' => 'company_classic_button_link',
				'type' => 'url',
				'default_value' => 'http://siliconexpert.local/',
			),
			array(
				'key' => 'field_company_classic_heading2',
				'label' => 'Company - Heading 2',
				'name' => 'company_classic_heading2',
				'type' => 'text',
				'default_value' => 'About Us',
			),
			array(
				'key' => 'field_company_classic_subheading2',
				'label' => 'Company - Subheading 2',
				'name' => 'company_classic_subheading2',
				'type' => 'text',
				'default_value' => 'Lorem ipsum dolor sit amet consectetur.',
			),
			array(
				'key' => 'field_company_classic_image2',
				'label' => 'Company - Image 2',
				'name' => 'company_classic_image2',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_company_classic_heading3',
				'label' => 'Company - Heading 3',
				'name' => 'company_classic_heading3',
				'type' => 'text',
				'default_value' => 'Contact Us',
			),
			array(
				'key' => 'field_company_classic_subheading3',
				'label' => 'Company - Subheading 3',
				'name' => 'company_classic_subheading3',
				'type' => 'text',
				'default_value' => 'Lorem ipsum dolor sit amet consectetur.',
			),
			array(
				'key' => 'field_company_classic_image3',
				'label' => 'Company - Image 3',
				'name' => 'company_classic_image3',
				'type' => 'image',
				'return_format' => 'array',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-header-settings',
				),
			),
		),
	));
}

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
