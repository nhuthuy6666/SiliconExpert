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
				'default_value' => '#',
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
				'default_value' => '#',
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
