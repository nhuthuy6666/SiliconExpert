
<?php
/**
 * Single Blog template
 *
 * @package silicon-expert
 */

get_header();

$post_id = get_the_ID();
$blog_name = (string) get_post_meta($post_id, '_se_blog_name', true);
$min_read = (int) get_post_meta($post_id, '_se_blog_min_read', true);

$primary_term_name = '';
$primary_terms = get_the_terms($post_id, 'category');
if (is_array($primary_terms) && !empty($primary_terms) && $primary_terms[0] instanceof WP_Term) {
	$primary_term_name = (string) $primary_terms[0]->name;
}
?>

<main id="primary" class="site-main bg-white flex flex-col justify-center items-center">
	<div class="w-full text-very-dark-blue max-w-[414px] lg:max-w-[1266px] pt-[132px] pb-[48px] px-[24px] lg:pt-[165px] lg:pb-[96px] lg:px-[302px] flex flex-col justify-center items-center">
        <div class="flex flex-col gap-[16px] w-full max-w-[366px] lg:max-w-[836px] justify-center lg:justify-start">
            <div class="flex flex-row gap-[16px]">
                <p class="text-[12px] font-[400] text-se-dark-navy">Press Release</p>
                <div class="flex flex-row gap-[4px] justify-center items-center">
                    <img class="w-[16px] h-[16px]" src="<?php echo get_template_directory_uri(); ?>/assets/images/time.svg" alt=""/>
                    <p class="text-[12px] font-[400]">
						<?php if ($min_read > 0) : ?>
							<?php echo esc_html($min_read); ?> min read
						<?php endif; ?>
					</p>
                </div>
            </div>
            <h2 class="text-[48px] font-[500] leading-[1.1]">
				<?php echo esc_html(get_the_title($post_id)); ?>
			</h2>
            <p class="text-[12px] font-[400]">
				<?php echo esc_html(get_the_date('', $post_id)); ?>
			</p>
        </div>
    </div>
    <div class="flex flex-col w-full justify-center items-center text-very-dark-blue max-w-[414px] lg:max-w-[1266px] pb-[48px] lg:pb-[140px] px-[24px] lg:px-[87px]">
        <div class="w-full py-[12px] lg:py-[21.5px] flex flex-row justify-between items-center">
            <div class="hidden lg:flex flex-row gap-[8px]">
                <p class="text-[14px] font-[500]">Resources</p>
                <p class="text-[14px] font-[500]">></p>
                <p class="text-[14px] font-[500]">Category</p>
                <p class="text-[14px] font-[500]">></p>
                <p class="text-[14px] font-[500]">
					<?php echo esc_html($blog_name ?: get_the_title($post_id)); ?>
				</p>
            </div>
            <div class="flex flex-row w-full max-w-[414px] lg:max-w-[297px] max-lg:px-[24px] justify-between items-center">
                <div class="flex flex-row gap-[16px] items-center">
                    <p class="text-[14px] font-[400]">Share</p>
                    <div class="flex flex-row gap-[8px] p-[8px]">
                        <div class="flex flex-row max-h-[24px] gap-[16px]">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <img class="w-[16.51px] h-[18.01px]" src="<?php echo get_template_directory_uri(); ?>/assets/images/X.svg" alt=""/>
                            </div>
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <img class="w-[16.51px] h-[18.01px]" src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt=""/>
                            </div>
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <img class="w-[16.51px] h-[18.01px]" src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.svg" alt=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row gap-[4px] justify-center items-center">
                    <p class="text-[14px] font-[500]">Download</p>
                    <div class="w-[20px] h-[20px] flex justify-center items-center">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/images/download.svg" alt=""/>
                    </div>
                </div>
            </div>
        </div>
        <img class="w-full h-[232.88px] lg:h-[600px] object-cover" src="<?php echo get_template_directory_uri(); ?>/assets/images/InsightCard.png" />
		<div class="w-full max-lg:px-[24px] max-w-[366px] lg:max-w-[836px] mt-[44px] lg:mt-[64px]">
			<?php the_content(); ?>
		</div>
    </div>
	<?php
		$related_query = new WP_Query(
			array(
				'post_type' => 'blog',
				'posts_per_page' => 3,
				'post_status' => 'publish',
				'post__not_in' => array( $post_id ),
				'orderby' => 'date',
				'order' => 'DESC',
				'no_found_rows' => true,
			)
		);
		$related_posts = $related_query->posts;
	?>
    <div class="w-full max-w-[414px] px-[24px] lg:px-[87px] lg:max-w-[1266px] text-very-dark-blue flex flex-col py-[44px] lg:pt-[64px] lg:pb-[127px] gap-[32px] lg:gap-[48px]">
        <div class="flex flex-row justify-between items-center">
            <div class="flex flex-col gap-[40px]">
                <div class="flex flex-row justify-center items-center">
                    <div class="flex flex-row gap-[40px] justify-center items-center">
                        <div class="w-[32px] h-[0px] border-[1px] border-se-yellow -rotate-90"></div>
                        <div class="text-[20px] font-[500]">Related resources</div>
                    </div>
                </div>
            </div>
            <div class="w-[145px] h-[48px] rounded-[4px] border-[1px] border-se-yellow py-[15px] px-[24px] flex justify-center items-center">
                <p class="text-[14px] font-[500]">Secondary</p>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-[40px] lg:gap-[24px]">
			<?php foreach ((array) $related_posts as $related_post) : ?>
				<?php
					$related_post_id = $related_post instanceof WP_Post ? (int) $related_post->ID : 0;
					$related_permalink = $related_post_id ? get_permalink($related_post_id) : '#';
					$related_title = $related_post_id ? get_the_title($related_post_id) : '';
					$related_date = $related_post_id ? get_the_date('M j, Y', $related_post_id) : '';
					$related_min_read = $related_post_id ? (int) get_post_meta($related_post_id, '_se_blog_min_read', true) : 0;
					$related_thumb = $related_post_id ? (string) (get_the_post_thumbnail_url($related_post_id, 'full') ?: '') : '';
				?>
				<a class="w-full max-w-[406px] flex flex-col gap-[16px]" href="<?php echo esc_url($related_permalink); ?>">
					<img class="w-full max-w-[366px] lg:max-w-[406px] h-[198.81px] lg:h-[221px] rounded-[6px] object-cover" src="<?php echo esc_url($related_thumb); ?>" alt=""/>
					<div class="flex flex-col gap-[8px]">
						<p class="text-[16px] font-[500]"><?php echo esc_html($related_title); ?></p>
						<div class="flex flex-row gap-[16px]">
							<p class="text-[12px] font-[400]"><?php echo esc_html($related_date); ?></p>
							<p class="text-[12px] font-[400]">Press Release</p>
							<div class="flex flex-row gap-[4px] w-[87px] h-[20px]">
								<div class="w-[16px] h-[16px] flex flex-row items-center justify-center">
									<img class="w-[13px] h-[13px]" src="<?php echo get_template_directory_uri(); ?>/assets/images/time.svg" alt=""/>
								</div>
								<p class="text-[12px] font-[400]">
									<?php if ($related_min_read > 0) : ?>
										<?php echo esc_html((string) $related_min_read); ?> min read
									<?php endif; ?>
								</p>
							</div>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
        </div>
    </div>
	<?php wp_reset_postdata(); ?>
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


