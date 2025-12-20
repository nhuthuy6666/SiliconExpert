<div class="se-marquee">
    <div class="se-marquee__overlay"></div>
    <div class="se-marquee__fade-left"></div>
    <div class="se-marquee__fade-right"></div>
    <div class="se-marquee__header">
        <div class="se-marquee__divider"></div>
        <h6 class="se-marquee__title"><?php echo esc_html($data->marquee_name ?? ''); ?></h6>
    </div>
    <div class="se-marquee__body">
        <?php $slides = (is_array($data->marquee_slide ?? null) ? $data->marquee_slide : array()); ?>
        <div class="se-marquee__viewport">
            <div class="se-marquee__track">
                <?php for ($dup = 0; $dup < 3; $dup++) : ?>
                    <div class="se-marquee__group">
                        <?php foreach ($slides as $row) : ?>
                            <?php
                                $row = is_array($row) ? $row : array();
                                $image = $row['image_marquee'] ?? null;
                                $image_url = '';
                                $image_alt = '';

                                if (is_array($image)) {
                                    $image_url = $image['url'] ?? '';
                                    $image_alt = $image['alt'] ?? '';
                                } elseif (is_numeric($image)) {
                                    $image_url = wp_get_attachment_image_url((int) $image, 'full') ?: '';
                                    $image_alt = get_post_meta((int) $image, '_wp_attachment_image_alt', true) ?: '';
                                } elseif (is_string($image)) {
                                    $image_url = $image;
                                }
                            ?>
                            <?php if ($image_url) : ?>
                                <div class="se-marquee__item">
                                    <img class="se-marquee__img" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>