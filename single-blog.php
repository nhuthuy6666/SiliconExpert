
<?php
/**
 * Single Blog template
 *
 * @package silicon-expert
 */

get_header();

$post_id = get_the_ID();
$min_read = (int) get_post_meta($post_id, '_se_blog_min_read', true);

$primary_term_name = '';
$primary_terms = get_the_terms($post_id, 'category');
if (is_array($primary_terms) && !empty($primary_terms) && $primary_terms[0] instanceof WP_Term) {
	$primary_term_name = (string) $primary_terms[0]->name;
}

$blog_tag_name = '';
$blog_tags = get_the_terms($post_id, 'blog_tag');
if (is_array($blog_tags) && !empty($blog_tags) && $blog_tags[0] instanceof WP_Term) {
	$blog_tag_name = (string) $blog_tags[0]->name;
}
?>

<main id="primary" class="single-blog site-main bg-white flex flex-col justify-center items-center">
	<div class="single-blog__intro">
		<div class="single-blog__intro-inner">
			<div class="single-blog__meta-row">
				<p class="single-blog__meta-type">Press Release</p>
				<div class="single-blog__meta-time">
					<img class="single-blog__meta-time-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/time.svg" alt=""/>
					<p class="single-blog__meta-time-text">
						<?php if ($min_read > 0) : ?>
							<?php echo esc_html($min_read); ?> min read
						<?php endif; ?>
					</p>
				</div>
			</div>
			<h2 class="single-blog__title">
				<?php echo esc_html(get_the_title($post_id)); ?>
			</h2>
			<p class="single-blog__date">
				<?php echo esc_html(get_the_date('', $post_id)); ?>
			</p>
		</div>
	</div>
	<div class="single-blog__content">
		<div class="single-blog__topbar">
			<div class="single-blog__breadcrumbs">
				<p class="single-blog__breadcrumbs-item">Resources</p>
				<p class="single-blog__breadcrumbs-sep">></p>
				<p class="single-blog__breadcrumbs-item">Category</p>
				<p class="single-blog__breadcrumbs-sep">></p>
				<p class="single-blog__breadcrumbs-current">
					<?php echo esc_html($blog_tag_name ?: get_the_title($post_id)); ?>
				</p>
			</div>
			<div class="single-blog__actions">
				<div class="single-blog__share">
					<p class="single-blog__share-label">Share</p>
					<div class="single-blog__share-icons">
						<div class="single-blog__share-icons-inner">
							<div class="single-blog__share-icon">
								<img class="single-blog__share-icon-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/X.svg" alt=""/>
							</div>
							<div class="single-blog__share-icon">
								<img class="single-blog__share-icon-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt=""/>
							</div>
							<div class="single-blog__share-icon">
								<img class="single-blog__share-icon-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.svg" alt=""/>
							</div>
						</div>
					</div>
				</div>
				<div class="single-blog__download">
					<p class="single-blog__download-label">Download</p>
					<div class="single-blog__download-icon">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/download.svg" alt=""/>
					</div>
				</div>
			</div>
		</div>
		<?php
			$hero_image_url = (string) (get_the_post_thumbnail_url($post_id, 'full') ?: '');
			if ($hero_image_url === '') {
				$hero_image_url = (string) get_template_directory_uri() . '/assets/images/InsightCard.png';
			}
		?>
		<img class="single-blog__hero-image" src="<?php echo esc_url($hero_image_url); ?>" alt="" />
		<div class="single-blog__editor">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
	// Related Resources Block
	$home_id = (int) get_option('page_on_front');

	$block_resources_data = array();
	if ($home_id > 0) {
		$home_post = get_post($home_id);
		$home_content = $home_post ? (string) $home_post->post_content : '';
		$home_blocks = $home_content ? parse_blocks($home_content) : array();

		$find_block_resources = static function (array $blocks) use (&$find_block_resources) {
			foreach ($blocks as $block) {
				if (!is_array($block)) {
					continue;
				}
				if (($block['blockName'] ?? '') === 'acf/block-resources') {
					return $block;
				}
				$inner = $block['innerBlocks'] ?? array();
				if (is_array($inner) && !empty($inner)) {
					$found = $find_block_resources($inner);
					if ($found) {
						return $found;
					}
				}
			}
			return null;
		};

		$resources_block = $find_block_resources($home_blocks);
		if (is_array($resources_block)) {
			$attrs = $resources_block['attrs'] ?? array();
			$data_attr = is_array($attrs) ? ($attrs['data'] ?? array()) : array();
			$block_resources_data = is_array($data_attr) ? $data_attr : array();
		}
	}

	$get_block_resources_value = static function (string $key) use ($block_resources_data, $home_id) {
		if (isset($block_resources_data[$key]) && $block_resources_data[$key] !== '' && $block_resources_data[$key] !== null) {
			return $block_resources_data[$key];
		}
		if (function_exists('get_field') && $home_id > 0) {
			return get_field($key, $home_id);
		}
		return null;
	};

	$data = (object) [
		'title' => $get_block_resources_value('title') ?: 'Related resources',
		'button_text' => $get_block_resources_value('button_text') ?: 'View all',
		'button_url' => $get_block_resources_value('button_url') ?: get_post_type_archive_link('blog') ?: '#',
	];
	include get_template_directory() . '/blocks/block-resources/appearances/related/render.php';
	wp_reset_postdata();
	?>
    <!-- CTAs Block Start -->
    <?php
    $home_id = (int) get_option('page_on_front');

	$ctas_block_data = array();
	if ($home_id > 0) {
		$home_post = get_post($home_id);
		$home_content = $home_post ? (string) $home_post->post_content : '';
		$home_blocks = $home_content ? parse_blocks($home_content) : array();

		$find_ctas_block = static function (array $blocks) use (&$find_ctas_block) {
			foreach ($blocks as $block) {
				if (!is_array($block)) {
					continue;
				}
				if (($block['blockName'] ?? '') === 'acf/ctas') {
					return $block;
				}
				$inner = $block['innerBlocks'] ?? array();
				if (is_array($inner) && !empty($inner)) {
					$found = $find_ctas_block($inner);
					if ($found) {
						return $found;
					}
				}
			}
			return null;
		};

		$ctas_block = $find_ctas_block($home_blocks);
		if (is_array($ctas_block)) {
			$attrs = $ctas_block['attrs'] ?? array();
			$data_attr = is_array($attrs) ? ($attrs['data'] ?? array()) : array();
			$ctas_block_data = is_array($data_attr) ? $data_attr : array();
		}
	}

	$get_ctas_value = static function (string $key) use ($ctas_block_data, $home_id) {
		if (isset($ctas_block_data[$key]) && $ctas_block_data[$key] !== '' && $ctas_block_data[$key] !== null) {
			return $ctas_block_data[$key];
		}
		if (function_exists('get_field') && $home_id > 0) {
			return get_field($key, $home_id);
		}
		return null;
	};

	$normalize_file_url = static function ($value): string {
		if (is_array($value)) {
			$url = (string) ($value['url'] ?? '');
			if ($url !== '') {
				return $url;
			}
			$id = $value['ID'] ?? ($value['id'] ?? null);
			if (is_numeric($id)) {
				$resolved = wp_get_attachment_url((int) $id);
				return $resolved ? (string) $resolved : '';
			}
			return '';
		}
		if (is_numeric($value)) {
			$url = wp_get_attachment_url((int) $value);
			return $url ? (string) $url : '';
		}
		if (is_string($value)) {
			return $value;
		}
		return '';
	};

	$left_video_raw = $get_ctas_value('left_CTAs_video');
	if (!$left_video_raw) {
		$left_video_raw = $get_ctas_value('left_CTAs_video_url');
	}
	$left_video_url = $normalize_file_url($left_video_raw);

    $data = (object) [
        'left_CTAs_image' => $get_ctas_value('left_CTAs_image') ?: '',
		'left_CTAs_video' => $left_video_url,
        'left_CTAs_title' => $get_ctas_value('left_CTAs_title') ?: 'Talk with an expert',
        'left_CTAs_text' => $get_ctas_value('left_CTAs_text') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor',
        'right_CTAs_image' => $get_ctas_value('right_CTAs_image') ?: '',
        'right_CTAs_title' => $get_ctas_value('right_CTAs_title') ?: 'Get the latest insights',
        'right_CTAs_text' => $get_ctas_value('right_CTAs_text') ?: 'Subscribe to our newsletter for updates',
    ];
    include get_template_directory() . '/blocks/ctas/appearances/default/render.php';
    ?>
    <!-- CTAs Block End -->
</main>

<?php
get_footer();



