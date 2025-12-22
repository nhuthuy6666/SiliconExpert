<?php
	$template_uri = (string) get_template_directory_uri();
	$resolve_image = static function ( $image ): array {
		if ( is_array( $image ) ) {
			return array( (string) ( $image['url'] ?? '' ), (string) ( $image['alt'] ?? '' ) );
		}
		if ( is_numeric( $image ) ) {
			$id = (int) $image;
			return array(
				(string) ( wp_get_attachment_image_url( $id, 'full' ) ?: '' ),
				(string) ( get_post_meta( $id, '_wp_attachment_image_alt', true ) ?: '' )
			);
		}
		return is_string( $image ) ? array( $image, '' ) : array( '', '' );
	};

	$resolve_video_url = static function ( $video ): string {
		if ( is_array( $video ) ) {
			return (string) ( $video['url'] ?? '' );
		}
		if ( is_numeric( $video ) ) {
			return (string) ( wp_get_attachment_url( (int) $video ) ?: '' );
		}
		return is_string( $video ) ? $video : '';
	};

	$format_date = static function ( $raw ): string {
		if ( ! is_string( $raw ) || $raw === '' ) {
			return '';
		}
		$dt = DateTime::createFromFormat( 'Ymd', $raw );
		if ( $dt instanceof DateTime ) {
			return $dt->format( 'M j, Y' );
		}
		$ts = strtotime( $raw );
		return $ts ? date( 'M j, Y', $ts ) : $raw;
	};
?>

<div class="se-block-resources">
    <div class="se-block-resources__header">
        <div class="se-block-resources__header-left">
            <div class="se-block-resources__divider"></div>
            <h6 class="se-block-resources__title"><?php echo esc_html($data->resources_title ?? '') ?></h6>
        </div>
        <a href="<?php echo esc_html($data->resources_second_link['url'] ?? '#') ?>" class="se-block-resources__cta">
            <span class="fill-layout"></span>
            <p class="se-block-resources__cta-text"><?php echo esc_html($data->resources_second_button ?? '') ?></p>
        </a>
    </div>
    <div class="se-block-resources__content">
        <div class="se-block-resources__main">
            <div class="se-block-resources__image-wrap">
                <?php list( $left_image_url, $left_image_alt ) = $resolve_image( $data->left_blog_image ?? null ); ?>
                <img class="se-block-resources__main-image" src="<?php echo esc_url( $left_image_url ); ?>" alt="<?php echo esc_attr( $left_image_alt ); ?>"/>
                <a href="#" class="se-block-resources__image-btn" aria-label="Open resource">
                    <div class="se-block-resources__arrow-container">
                        <img class="se-block-resources__arrow-old" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                        <img class="se-block-resources__arrow-new" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                    </div>
                </a>
            </div>
            <div class="se-block-resources__main-meta">
                <p class="se-block-resources__headline"><?php echo esc_html( (string) ( $data->left_blog_title ?? '' ) ); ?></p>
                <div class="se-block-resources__meta-row">
                    <p class="se-block-resources__meta-text"><?php echo esc_html( $format_date( $data->left_blog_date ?? '' ) ); ?></p>
                    <p class="se-block-resources__meta-text">Press Release</p>
                    <div class="se-block-resources__readtime">
                        <img class="se-block-resources__readtime-icon" src="<?php echo esc_url( $template_uri ); ?>/assets/images/time.svg" alt="<?php bloginfo('name'); ?>"/>
                        <p class="se-block-resources__meta-text"><?php echo esc_html( (string) ( $data->left_blog_minute ?? '' ) ); ?> min read</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="se-block-resources__side">
            <?php foreach ( (array) ( $data->right_blogs ?? array() ) as $row ) : ?>
                <?php $row = is_array( $row ) ? $row : (array) $row; ?>
                <div class="se-block-resources__card">
                    <div class="se-block-resources__image-wrap">
                        <div class="se-block-resources__media">
                            <?php list( $right_image_url, $right_image_alt ) = $resolve_image( $row['right_blog_image'] ?? null ); ?>
                            <img class="se-block-resources__card-image" src="<?php echo esc_url( $right_image_url ); ?>" alt="<?php echo esc_attr( $right_image_alt ); ?>"/>
                            <?php $right_video_url = $resolve_video_url( $row['right_blog_video'] ?? null ); ?>
                            <?php if ( $right_video_url ) : ?>
                                <video class="se-block-resources__card-video" src="<?php echo esc_url( $right_video_url ); ?>" autoplay muted loop playsinline preload="metadata"></video>
                            <?php endif; ?>
                        </div>
                        <a href="#" class="se-block-resources__image-btn" aria-label="Open resource">
                            <div class="se-block-resources__arrow-container">
                                <img class="se-block-resources__arrow-old" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                                <img class="se-block-resources__arrow-new" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="se-block-resources__card-meta">
                        <p class="se-block-resources__headline"><?php echo esc_html( (string) ( $row['right_blog_title'] ?? '' ) ); ?></p>
                        <div class="se-block-resources__meta-row">
                            <p class="se-block-resources__meta-text"><?php echo esc_html( $format_date( $row['right_blog_date'] ?? '' ) ); ?></p>
                            <p class="se-block-resources__meta-text">Press Release</p>
                            <div class="se-block-resources__readtime">
                                <img class="se-block-resources__readtime-icon" src="<?php echo esc_url( $template_uri ); ?>/assets/images/time.svg" alt="<?php bloginfo('name'); ?>"/>
                                <p class="se-block-resources__meta-text"><?php echo esc_html( (string) ( $row['right_blog_minute'] ?? '' ) ); ?> min read</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>