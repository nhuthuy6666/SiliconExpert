<div class="se-testimonial" style="background-image: url('<?php echo esc_url($data->testimonial_background_image['url']); ?>');">
    <div class="se-testimonial__inner">
        <div class="se-testimonial__content">
            <div class="se-testimonial__logo">
                <img class="se-testimonial__logo-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/microsoft.svg" alt="Microsoft"/>
            </div>
            <div class="se-testimonial__body">
                <h4 class="se-testimonial__quote"><?php echo esc_html((isset($data->testimonial_h4) && is_string($data->testimonial_h4) && $data->testimonial_h4 !== '') ? $data->testimonial_h4 : '“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”'); ?></h4>
                <div class="se-testimonial__footer">
                    <div class="se-testimonial__divider-group">
                        <div class="se-testimonial__divider"></div>
                        <div class="se-testimonial__progress">
                            <div class="se-testimonial__progress-fill"></div>
                        </div>
                    </div>
                    <div class="se-testimonial__nav">
                        <div class="se-testimonial__nav-btn">
                            <div class="se-testimonial__nav-btn-inner">
                                <img class="se-testimonial__nav-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/arr-left.svg" alt="Arrow Left">
                            </div>
                        </div>
                        <div class="se-testimonial__nav-btn">
                            <div class="se-testimonial__nav-btn-inner">
                                <img class="se-testimonial__nav-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/arr-right.svg" alt="Arrow Left">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="se-testimonial__aside">
            <?php if (is_array($data->testimonial_image ?? null)) : ?>
                <img class="se-testimonial__photo" src="<?php echo esc_url(is_string(($data->testimonial_image['url'] ?? null)) ? ($data->testimonial_image['url'] ?? '') : ''); ?>" alt="<?php echo esc_attr(is_string(($data->testimonial_image['alt'] ?? null)) ? ($data->testimonial_image['alt'] ?? '') : ''); ?>">
            <?php elseif (is_int($data->testimonial_image ?? null) || (is_string($data->testimonial_image ?? null) && ctype_digit($data->testimonial_image))) : ?>
                <img class="se-testimonial__photo" src="<?php echo esc_url(wp_get_attachment_image_url((int) ($data->testimonial_image ?? 0), 'full') ?: ''); ?>" alt="<?php echo esc_attr(get_post_meta((int) ($data->testimonial_image ?? 0), '_wp_attachment_image_alt', true) ?: ''); ?>">
            <?php else : ?>
                <img class="se-testimonial__photo" src="<?php echo esc_url(is_string($data->testimonial_image ?? null) ? ($data->testimonial_image ?? '') : ''); ?>" alt="">
            <?php endif; ?>
            <div class="se-testimonial__meta">
                <p class="se-testimonial__meta-line"><?php echo esc_html((isset($data->testimonial_name) && is_string($data->testimonial_name) && $data->testimonial_name !== '') ? $data->testimonial_name : 'Joanne Smith'); ?></p>
                <p class="se-testimonial__meta-line"><?php echo esc_html((isset($data->testimonial_job_title) && is_string($data->testimonial_job_title) && $data->testimonial_job_title !== '') ? $data->testimonial_job_title : 'Job Title and Company'); ?></p>
            </div>
        </div>
    </div>
</div>