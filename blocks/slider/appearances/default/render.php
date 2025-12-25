<?php
	$image_map = array(
		'pic_1' => 'picture1.svg',
		'pic_2' => 'picture2.svg',
		'pic_3' => 'picture3.svg',
	);
	$slider_total = 0;
	if (isset($data->slider_content) && is_array($data->slider_content)) {
		$slider_total = count($data->slider_content);
	}
?>


<div class="se-slider se-slider--mobile">
	<div class="se-slider__overlay"></div>
	<div class="se-slider__header">
		<div class="se-slider__header-divider"></div>
		<h6 class="se-slider__header-title"><?php echo esc_html($data->title_name ?? ''); ?></h6>
	</div>

	<div class="se-slider__slides">
		<?php foreach ((is_array($data->slider_content ?? null) ? $data->slider_content : array()) as $index => $slide): ?>
			<?php
				$slide = is_array($slide) ? $slide : array();
				$icon_file = $image_map[$slide['image_choice'] ?? ''] ?? $image_map['pic_1'];
				$icon_url = get_template_directory_uri() . '/assets/images/' . $icon_file;

				$slide_image_url = '';
				$gallery = (is_array($data->slider_images ?? null) ? $data->slider_images : array());
				if (isset($gallery[$index]) && is_array($gallery[$index])) {
					$slide_image_url = $gallery[$index]['url'] ?? '';
				}
				if (!$slide_image_url) {
					$slide_image_url = get_template_directory_uri() . '/assets/images/imageslider1.svg';
				}
			?>
			<div class="se-slider__slide is-active">
				<div class="se-slider__text-col">
					<div class="se-slider__text">
						<img class="se-slider__icon" src="<?php echo esc_url($icon_url); ?>" alt="">
						<h4 class="se-slider__slide-title"><?php echo esc_html($slide['title_slider_content'] ?? ''); ?></h4>
						<p class="se-slider__slide-desc"><?php echo esc_html($slide['text_slider_content'] ?? ''); ?></p>
						<?php if (!empty($slide['button_text_slider_content']) && !empty($slide['button_url_slider_content'])) : ?>
							<a class="se-slider__cta" href="<?php echo esc_url($slide['button_url_slider_content']); ?>">
								<p class="se-slider__cta-text"><?php echo esc_html($slide['button_text_slider_content']); ?></p>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="se-slider__image-wrap">
					<img class="se-slider__image" src="<?php echo esc_url($slide_image_url); ?>" alt="">
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<div class="se-slider se-slider--tablet">
	<div class="se-slider__overlay"></div>
	<div class="se-slider__header">
		<div class="se-slider__header-divider"></div>
		<h6 class="se-slider__header-title"><?php echo esc_html($data->title_name ?? ''); ?></h6>
	</div>

	<div class="se-slider__slides">
		<?php foreach ((is_array($data->slider_content ?? null) ? $data->slider_content : array()) as $index => $slide): ?>
			<?php
				$slide = is_array($slide) ? $slide : array();
				$icon_file = $image_map[$slide['image_choice'] ?? ''] ?? $image_map['pic_1'];
				$icon_url = get_template_directory_uri() . '/assets/images/' . $icon_file;

				$slide_image_url = '';
				$gallery = (is_array($data->slider_images ?? null) ? $data->slider_images : array());
				if (isset($gallery[$index]) && is_array($gallery[$index])) {
					$slide_image_url = $gallery[$index]['url'] ?? '';
				}
				if (!$slide_image_url) {
					$slide_image_url = get_template_directory_uri() . '/assets/images/imageslider1.svg';
				}
			?>
			<div class="se-slider__slide is-active">
				<div class="se-slider__text-col">
					<div class="se-slider__text">
						<img class="se-slider__icon" src="<?php echo esc_url($icon_url); ?>" alt="">
						<h4 class="se-slider__slide-title"><?php echo esc_html($slide['title_slider_content'] ?? ''); ?></h4>
						<p class="se-slider__slide-desc"><?php echo esc_html($slide['text_slider_content'] ?? ''); ?></p>
						<?php if (!empty($slide['button_text_slider_content']) && !empty($slide['button_url_slider_content'])) : ?>
							<a class="se-slider__cta" href="<?php echo esc_url($slide['button_url_slider_content']); ?>">
								<p class="se-slider__cta-text"><?php echo esc_html($slide['button_text_slider_content']); ?></p>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="se-slider__image-wrap">
					<img class="se-slider__image" src="<?php echo esc_url($slide_image_url); ?>" alt="">
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<div class="se-slider se-slider--desktop" x-data="{ activeIndex: 0, total: <?php echo (int) $slider_total; ?>, shadowAlt: false, next() { if (!this.total) return; this.activeIndex = (this.activeIndex + 1) % this.total }, toggleShadow() { this.shadowAlt = !this.shadowAlt } }" @click="next(); toggleShadow()">
	<div class="se-slider__overlay"></div>
	<div class="se-slider__header">
		<div class="se-slider__header-divider"></div>
		<h6 class="se-slider__header-title"><?php echo esc_html($data->title_name ?? ''); ?></h6>
		<div class="se-slider__controls">
			<div class="se-slider__progress-track">
				<div class="se-slider__progress-fill" :style="total ? `width:${Math.round(((activeIndex+1)/total)*64)}px` : 'width:0px'"></div>
			</div>
			<button type="button" class="se-slider__counter-button">
				<p class="se-slider__counter-text" x-text="activeIndex + 1"></p>
				<p class="se-slider__counter-text">/</p>
				<p class="se-slider__counter-text" x-text="total"></p>
			</button>
		</div>
	</div>

	<div class="se-slider__slides">
		<?php foreach ((is_array($data->slider_content ?? null) ? $data->slider_content : array()) as $index => $slide): ?>
			<?php
				$slide = is_array($slide) ? $slide : array();
				$icon_file = $image_map[$slide['image_choice'] ?? ''] ?? $image_map['pic_1'];
				$icon_url = get_template_directory_uri() . '/assets/images/' . $icon_file;

				$slide_image_url = '';
				$gallery = (is_array($data->slider_images ?? null) ? $data->slider_images : array());
				if (isset($gallery[$index]) && is_array($gallery[$index])) {
					$slide_image_url = $gallery[$index]['url'] ?? '';
				}
				if (!$slide_image_url) {
					$slide_image_url = get_template_directory_uri() . '/assets/images/imageslider1.svg';
				}
			?>
			<div class="se-slider__slide" x-show="activeIndex === <?php echo (int) $index; ?>" :class="(activeIndex === <?php echo (int) $index; ?>) ? 'is-active' : ''">
				<div class="se-slider__text-col">
					<div class="se-slider__text" x-show="activeIndex === <?php echo (int) $index; ?>" x-transition:enter="se-slider__text-enter" x-transition:leave="se-slider__text-leave">
						<img class="se-slider__icon" src="<?php echo esc_url($icon_url); ?>" alt="">
						<h4 class="se-slider__slide-title"><?php echo esc_html($slide['title_slider_content'] ?? ''); ?></h4>
						<p class="se-slider__slide-desc"><?php echo esc_html($slide['text_slider_content'] ?? ''); ?></p>
						<?php if (!empty($slide['button_text_slider_content']) && !empty($slide['button_url_slider_content'])) : ?>
							<a class="se-slider__cta" href="<?php echo esc_url($slide['button_url_slider_content']); ?>">
								<p class="se-slider__cta-text"><?php echo esc_html($slide['button_text_slider_content']); ?></p>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="se-slider__image-wrap" x-show="activeIndex === <?php echo (int) $index; ?>" x-transition.opacity.duration.500ms>
					<img class="se-slider__image" :class="shadowAlt ? 'is-shadow-alt' : ''" src="<?php echo esc_url($slide_image_url); ?>" alt="">
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>