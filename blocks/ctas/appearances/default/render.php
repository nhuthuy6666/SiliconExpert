<?php
	$resolve_image = static function ( $image ): array {
		if ( is_array( $image ) ) {
			return array(
				(string) ( $image['url'] ?? '' ),
				(string) ( $image['alt'] ?? '' ),
			);
		}
		if ( is_numeric( $image ) ) {
			$id = (int) $image;
			return array(
				(string) ( wp_get_attachment_image_url( $id, 'full' ) ?: '' ),
				(string) ( get_post_meta( $id, '_wp_attachment_image_alt', true ) ?: '' ),
			);
		}
		if ( is_string( $image ) ) {
			return array( $image, '' );
		}
		return array( '', '' );
	};

	list( $left_image_url, $left_image_alt ) = $resolve_image( $data->left_CTAs_image ?? null );
	list( $right_image_url, $right_image_alt ) = $resolve_image( $data->right_CTAs_image ?? null );
	$left_video_url = (string) ( $data->left_CTAs_video ?? '' );
?>

<div class="se-ctas">
    <div class="se-ctas__overlay"></div>
    <div class="se-ctas__inner">
        <div class="se-ctas__card se-ctas__card--left" onmouseenter="if(window.matchMedia('(min-width: 640px)').matches){ const v=this.querySelector('video'); if(v){ v.currentTime=0; v.play(); } }" onmouseleave="if(window.matchMedia('(min-width: 640px)').matches){ const v=this.querySelector('video'); if(v){ v.pause(); v.currentTime=0; } }">
            <div class="se-ctas__card-header">
                <h5 class="se-ctas__title"><?php echo esc_html( (string) ( $data->left_CTAs_title ?? '' ) ); ?></h5>
                <div class="se-ctas__icon-btn se-ctas__icon-btn--yellow">
                    <div class="se-ctas__arrow-container">
                        <img class="se-ctas__arrow-old se-ctas__icon-img se-ctas__icon-img--black" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vector.svg" alt="" />
                        <img class="se-ctas__arrow-new se-ctas__icon-img se-ctas__icon-img--black" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vector.svg" alt="" />
                    </div>
                </div>
            </div>
            <p class="se-ctas__desc se-ctas__desc--white"><?php echo esc_html( (string) ( $data->left_CTAs_text ?? '' ) ); ?></p>

            <div class="se-ctas__media">
                <img class="se-ctas__media-image" src="<?php echo esc_url( $left_image_url ); ?>" alt="<?php echo esc_attr( $left_image_alt ); ?>" />
                <?php if ( $left_video_url ) : ?>
                    <video class="se-ctas__media-video" src="<?php echo esc_url( $left_video_url ); ?>" autoplay muted loop playsinline preload="metadata"></video>
                <?php endif; ?>
            </div>
        </div>

        <div class="se-ctas__card se-ctas__card--right">
            <div class="se-ctas__card-header">
                <h5 class="se-ctas__title se-ctas__title--dark"><?php echo esc_html( (string) ( $data->right_CTAs_title ?? '' ) ); ?></h5>
                <div class="se-ctas__icon-btn se-ctas__icon-btn--navy">
                    <div class="se-ctas__arrow-container">
                        <img class="se-ctas__arrow-old se-ctas__icon-img" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vector.svg" alt="" />
                        <img class="se-ctas__arrow-new se-ctas__icon-img" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vector.svg" alt="" />
                    </div>
                </div>
            </div>
            <p class="se-ctas__desc se-ctas__desc--dark"><?php echo esc_html( (string) ( $data->right_CTAs_text ?? '' ) ); ?></p>
            <div class="se-ctas__frame">
                <img class="se-ctas__frame-image" src="<?php echo esc_url( $right_image_url ); ?>" alt="<?php echo esc_attr( $right_image_alt ); ?>" />
            </div>
        </div>
    </div>
</div>