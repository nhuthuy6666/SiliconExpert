<?php

if (!defined('ABSPATH')) {
	exit;
}

add_action('init', function () {
	$labels = array(
		'name' => 'Blogs',
		'singular_name' => 'Blog',
		'menu_name' => 'Blogs',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Blog',
		'edit_item' => 'Edit Blog',
		'new_item' => 'New Blog',
		'view_item' => 'View Blog',
		'view_items' => 'View Blogs',
		'search_items' => 'Search Blogs',
		'not_found' => 'No blogs found',
		'not_found_in_trash' => 'No blogs found in Trash',
		'all_items' => 'All Blogs',
	);

	register_post_type('blog', array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'blog'),
		'show_in_rest' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
	));

	register_taxonomy('blog_tag', array('blog'), array(
		'labels' => array(
			'name' => 'Blog Tags',
			'singular_name' => 'Blog Tag',
		),
		'public' => true,
		'hierarchical' => false,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' => array('slug' => 'blog-tag'),
	));

	register_post_meta('blog', '_se_blog_min_read', array(
		'type' => 'integer',
		'single' => true,
		'show_in_rest' => true,
		'auth_callback' => function () {
			return current_user_can('edit_posts');
		},
		'sanitize_callback' => function ($value) {
			return (int) $value;
		},
	));
});

add_action('add_meta_boxes', function () {
	add_meta_box(
		'se_blog_meta',
		'Blog Settings',
		function ($post) {
			$min_read = get_post_meta($post->ID, '_se_blog_min_read', true);
			$min_read = $min_read !== '' ? (int) $min_read : '';
			wp_nonce_field('se_blog_meta_save', 'se_blog_meta_nonce');
			?>
			<p>
				<label for="se_blog_min_read"><strong>Time (min read)</strong></label>
			</p>
			<p>
				<input
					type="number"
					id="se_blog_min_read"
					name="se_blog_min_read"
					min="0"
					step="1"
					value="<?php echo esc_attr($min_read); ?>"
					class="small-text"
				/>
			</p>
			<?php
		},
		'blog',
		'side',
		'default'
	);
});

add_action('save_post_blog', function ($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	if (empty($_POST['se_blog_meta_nonce']) || !wp_verify_nonce($_POST['se_blog_meta_nonce'], 'se_blog_meta_save')) {
		return;
	}

	$min_read = isset($_POST['se_blog_min_read']) ? (int) $_POST['se_blog_min_read'] : 0;
	if ($min_read <= 0) {
		delete_post_meta($post_id, '_se_blog_min_read');
	} else {
		update_post_meta($post_id, '_se_blog_min_read', $min_read);
	}
});
