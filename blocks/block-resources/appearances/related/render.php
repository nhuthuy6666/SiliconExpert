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
?>

<div class="single-blog__related">
    <div class="single-blog__related-header">
        <div class="single-blog__related-title-wrap">
            <div class="single-blog__related-title-row">
                <div class="single-blog__related-title-line"></div>
                <div class="single-blog__related-title"><?php echo esc_html( !empty( $data->title ) ? (string) $data->title : 'Related resources' ); ?></div>
            </div>
        </div>
        <a href="<?php echo esc_url( !empty( $data->button_url ) ? (string) $data->button_url : (string) ( get_post_type_archive_link( 'blog' ) ?: '#' ) ); ?>" class="single-blog__related-cta group">
            <span class="fill-layout"></span>
            <p class="single-blog__related-cta-text"><?php echo esc_html( !empty( $data->button_text ) ? (string) $data->button_text : 'View all' ); ?></p>
        </a>
    </div>
    <div class="single-blog__related-viewport">
        <div class="single-blog__related-track">
            <?php if ( $main_post_id ) : ?>
                <a class="single-blog__card" href="<?php echo esc_url( $main_permalink ); ?>">
                    <img class="single-blog__card-image" src="<?php echo esc_url( $main_image_url ); ?>" alt=""/>
                    <div class="single-blog__card-body">
                        <p class="single-blog__card-title"><?php echo esc_html( (string) $main_title ); ?></p>
                        <div class="single-blog__card-meta">
                            <p class="single-blog__card-date"><?php echo esc_html( (string) $main_date ); ?></p>
                            <p class="single-blog__card-type">Press Release</p>
                            <div class="single-blog__card-time">
                                <div class="single-blog__card-time-icon">
                                    <img class="single-blog__card-time-icon-img" src="<?php echo esc_url( $template_uri ); ?>/assets/images/time.svg" alt=""/>
                                </div>
                                <p class="single-blog__card-time-text">
                                    <?php if ($main_min_read > 0) : ?>
                                        <?php echo esc_html( (string) $main_min_read ); ?> min read
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
            <?php foreach ( (array) $side_posts as $side_post ) : ?>
                <?php
                    $side_post_id = $side_post instanceof WP_Post ? (int) $side_post->ID : 0;
                    $side_permalink = $side_post_id ? get_permalink( $side_post_id ) : '#';
                    $side_title = $side_post_id ? get_the_title( $side_post_id ) : '';
                    $side_date = $side_post_id ? get_the_date( 'M j, Y', $side_post_id ) : '';
                    $side_min_read = $side_post_id ? (int) get_post_meta( $side_post_id, '_se_blog_min_read', true ) : 0;
                    $side_image_url = $side_post_id ? (string) ( get_the_post_thumbnail_url( $side_post_id, 'full' ) ?: '' ) : '';
                ?>
                <a class="single-blog__card" href="<?php echo esc_url( $side_permalink ); ?>">
                    <img class="single-blog__card-image" src="<?php echo esc_url( $side_image_url ); ?>" alt=""/>
                    <div class="single-blog__card-body">
                        <p class="single-blog__card-title"><?php echo esc_html( (string) $side_title ); ?></p>
                        <div class="single-blog__card-meta">
                            <p class="single-blog__card-date"><?php echo esc_html( (string) $side_date ); ?></p>
                            <p class="single-blog__card-type">Press Release</p>
                            <div class="single-blog__card-time">
                                <div class="single-blog__card-time-icon">
                                    <img class="single-blog__card-time-icon-img" src="<?php echo esc_url( $template_uri ); ?>/assets/images/time.svg" alt=""/>
                                </div>
                                <p class="single-blog__card-time-text">
                                    <?php if ($side_min_read > 0) : ?>
                                        <?php echo esc_html( (string) $side_min_read ); ?> min read
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="single-blog__related-nav">
        <div class="single-blog__related-nav-btn">
            <div class="single-blog__related-nav-icon">
                <img class="single-blog__related-nav-arrow" src="<?php echo esc_url( $template_uri ); ?>/assets/images/arr-left.svg" alt=""/>
            </div>
        </div>
        <div class="single-blog__related-nav-btn">
            <div class="single-blog__related-nav-icon">
                <img class="single-blog__related-nav-arrow" src="<?php echo esc_url( $template_uri ); ?>/assets/images/arr-right.svg" alt=""/>
            </div>
        </div>
    </div>
</div>

<?php
	wp_reset_postdata();
?>
