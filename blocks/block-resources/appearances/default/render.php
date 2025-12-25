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

	$resources_query = new WP_Query(
		array(
			'post_type' => 'blog',
			'posts_per_page' => 3,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			'no_found_rows' => true,
		)
	);
	$resource_posts = $resources_query->posts;

	$main_post_id = !empty( $resource_posts ) && $resource_posts[0] instanceof WP_Post ? (int) $resource_posts[0]->ID : 0;
	$side_posts = array();
	if ( count( $resource_posts ) > 1 ) {
		$side_posts = array_slice( $resource_posts, 1 );
	}

	$main_permalink = $main_post_id ? get_permalink( $main_post_id ) : '#';
	$main_title = $main_post_id ? get_the_title( $main_post_id ) : '';
	$main_date = $main_post_id ? get_the_date( 'M j, Y', $main_post_id ) : '';
	$main_min_read = $main_post_id ? (int) get_post_meta( $main_post_id, '_se_blog_min_read', true ) : 0;
	$main_image_url = $main_post_id ? (string) ( get_the_post_thumbnail_url( $main_post_id, 'full' ) ?: '' ) : '';
	$resources_title = 'Resources';
	$resources_cta_text = 'View all';
	$resources_cta_url = (string) ( get_post_type_archive_link( 'blog' ) ?: '#' );
?>

<div class="se-block-resources">
    <div class="se-block-resources__header">
        <div class="se-block-resources__header-left">
            <div class="se-block-resources__divider"></div>
            <h6 class="se-block-resources__title"><?php echo esc_html( $resources_title ); ?></h6>
        </div>
        <a href="<?php echo esc_url( $resources_cta_url ); ?>" class="se-block-resources__cta">
            <span class="fill-layout"></span>
            <p class="se-block-resources__cta-text"><?php echo esc_html( $resources_cta_text ); ?></p>
        </a>
    </div>
    <div class="se-block-resources__content">
        <div class="se-block-resources__main">
            <div class="se-block-resources__image-wrap">
                <img class="se-block-resources__main-image" src="<?php echo esc_url( $main_image_url ); ?>" alt=""/>
                <a href="<?php echo esc_url( $main_permalink ); ?>" class="se-block-resources__image-btn" aria-label="Open resource">
                    <div class="se-block-resources__arrow-container">
                        <img class="se-block-resources__arrow-old" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                        <img class="se-block-resources__arrow-new" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                    </div>
                </a>
            </div>
            <div class="se-block-resources__main-meta">
                <a class="se-block-resources__headline" href="<?php echo esc_url( $main_permalink ); ?>"><?php echo esc_html( (string) $main_title ); ?></a>
                <div class="se-block-resources__meta-row">
                    <p class="se-block-resources__meta-text"><?php echo esc_html( (string) $main_date ); ?></p>
                    <p class="se-block-resources__meta-text">Press Release</p>
                    <div class="se-block-resources__readtime">
                        <img class="se-block-resources__readtime-icon" src="<?php echo esc_url( $template_uri ); ?>/assets/images/time.svg" alt="<?php bloginfo('name'); ?>"/>
                        <p class="se-block-resources__meta-text"><?php echo $main_min_read > 0 ? esc_html( (string) $main_min_read ) : ''; ?><?php echo $main_min_read > 0 ? ' min read' : ''; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="se-block-resources__side">
            <?php foreach ( (array) $side_posts as $side_post ) : ?>
                <?php
                    $side_post_id = $side_post instanceof WP_Post ? (int) $side_post->ID : 0;
                    $side_permalink = $side_post_id ? get_permalink( $side_post_id ) : '#';
                    $side_title = $side_post_id ? get_the_title( $side_post_id ) : '';
                    $side_date = $side_post_id ? get_the_date( 'M j, Y', $side_post_id ) : '';
                    $side_min_read = $side_post_id ? (int) get_post_meta( $side_post_id, '_se_blog_min_read', true ) : 0;
                    $side_image_url = $side_post_id ? (string) ( get_the_post_thumbnail_url( $side_post_id, 'full' ) ?: '' ) : '';
                ?>
                <div class="se-block-resources__card">
                    <div class="se-block-resources__image-wrap">
                        <div class="se-block-resources__media">
                            <img class="se-block-resources__card-image" src="<?php echo esc_url( $side_image_url ); ?>" alt=""/>
                        </div>
                        <a href="<?php echo esc_url( $side_permalink ); ?>" class="se-block-resources__image-btn" aria-label="Open resource">
                            <div class="se-block-resources__arrow-container">
                                <img class="se-block-resources__arrow-old" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                                <img class="se-block-resources__arrow-new" src="<?php echo esc_url( $template_uri ); ?>/assets/images/vector.svg" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="se-block-resources__card-meta">
                        <a class="se-block-resources__headline" href="<?php echo esc_url( $side_permalink ); ?>"><?php echo esc_html( (string) $side_title ); ?></a>
                        <div class="se-block-resources__meta-row">
                            <p class="se-block-resources__meta-text"><?php echo esc_html( (string) $side_date ); ?></p>
                            <p class="se-block-resources__meta-text">Press Release</p>
                            <div class="se-block-resources__readtime">
                                <img class="se-block-resources__readtime-icon" src="<?php echo esc_url( $template_uri ); ?>/assets/images/time.svg" alt="<?php bloginfo('name'); ?>"/>
                                <p class="se-block-resources__meta-text"><?php echo $side_min_read > 0 ? esc_html( (string) $side_min_read ) : ''; ?><?php echo $side_min_read > 0 ? ' min read' : ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
	wp_reset_postdata();
?>