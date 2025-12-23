<?php
	$items = (is_array($data->testimonial_items ?? null) ? $data->testimonial_items : array());
	$total = count($items);

	$bg_url = '';
	if (is_array($data->testimonial_background_image ?? null)) {
		$bg_url = (string) ($data->testimonial_background_image['url'] ?? '');
	}
?>

<div class="se-testimonial" style="background-image: url('<?php echo esc_url($bg_url); ?>');" x-data="{ activeIndex: 0, total: <?php echo (int) $total; ?>, next() { if (!this.total) return; this.activeIndex = (this.activeIndex + 1) % this.total }, prev() { if (!this.total) return; this.activeIndex = (this.activeIndex - 1 + this.total) % this.total } }">
    <div class="se-testimonial__inner">
        <div class="se-testimonial__content">
            <div class="se-testimonial__logo">
                <img class="se-testimonial__logo-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/microsoft.svg" alt="Microsoft"/>
            </div>
            <div class="se-testimonial__body">
                <div class="se-testimonial__quotes grid items-start justify-items-start">
                    <?php foreach ($items as $index => $item) : ?>
                        <?php $item = is_array($item) ? $item : array(); ?>
                        <h4 class="se-testimonial__quote [grid-area:1/1] self-start justify-self-start" x-show="activeIndex === <?php echo (int) $index; ?>" x-transition:enter="animate-fadeInRTL" x-transition:leave="animate-fadeOutLTR">
                            <?php echo esc_html((isset($item['testimonial_h4']) && is_string($item['testimonial_h4']) && $item['testimonial_h4'] !== '') ? $item['testimonial_h4'] : '“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”'); ?>
                        </h4>
                    <?php endforeach; ?>
                </div>
                <div class="se-testimonial__footer">
                    <div class="se-testimonial__divider-group">
                        <div class="se-testimonial__divider"></div>
                        <div class="se-testimonial__progress">
                            <div class="se-testimonial__progress-fill" :style="total ? `width:${Math.round(((activeIndex+1)/total)*64)}px` : 'width:0px'"></div>
                        </div>
                    </div>
                    <div class="se-testimonial__nav">
                        <button type="button" class="se-testimonial__nav-btn" @click.stop="prev()">
                            <div class="se-testimonial__nav-btn-inner">
                                <img class="se-testimonial__nav-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/arr-left.svg" alt="Arrow Left">
                            </div>
                        </button>
                        <button type="button" class="se-testimonial__nav-btn" @click.stop="next()">
                            <div class="se-testimonial__nav-btn-inner">
                                <img class="se-testimonial__nav-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/arr-right.svg" alt="Arrow Left">
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="se-testimonial__aside">
            <div class="se-testimonial__aside-slides grid w-full items-start justify-items-start">
                <?php foreach ($items as $index => $item) : ?>
                    <?php
                        $item = is_array($item) ? $item : array();
                        $image = $item['testimonial_image'] ?? null;
                    ?>
                    <div class="se-testimonial__aside-slide [grid-area:1/1] self-start justify-self-start flex flex-row sm:flex-col gap-[16px] sm:gap-[32px] items-start" x-show="activeIndex === <?php echo (int) $index; ?>" x-transition:enter="animate-fadeInRTL" x-transition:leave="animate-fadeOutLTR">
                        <?php if (is_array($image)) : ?>
                            <img class="se-testimonial__photo" src="<?php echo esc_url(is_string(($image['url'] ?? null)) ? ($image['url'] ?? '') : ''); ?>" alt="<?php echo esc_attr(is_string(($image['alt'] ?? null)) ? ($image['alt'] ?? '') : ''); ?>">
                        <?php elseif (is_int($image) || (is_string($image) && ctype_digit($image))) : ?>
                            <img class="se-testimonial__photo" src="<?php echo esc_url(wp_get_attachment_image_url((int) $image, 'full') ?: ''); ?>" alt="<?php echo esc_attr(get_post_meta((int) $image, '_wp_attachment_image_alt', true) ?: ''); ?>">
                        <?php else : ?>
                            <img class="se-testimonial__photo" src="<?php echo esc_url(is_string($image) ? $image : ''); ?>" alt="">
                        <?php endif; ?>
                        <div class="se-testimonial__meta">
                            <p class="se-testimonial__meta-line"><?php echo esc_html((isset($item['testimonial_name']) && is_string($item['testimonial_name']) && $item['testimonial_name'] !== '') ? $item['testimonial_name'] : 'Joanne Smith'); ?></p>
                            <p class="se-testimonial__meta-line"><?php echo esc_html((isset($item['testimonial_job_title']) && is_string($item['testimonial_job_title']) && $item['testimonial_job_title'] !== '') ? $item['testimonial_job_title'] : 'Job Title and Company'); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>