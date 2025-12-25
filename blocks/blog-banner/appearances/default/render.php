<?php
	$resolve_bg_url = static function ($value): string {
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
			$resolved = wp_get_attachment_url((int) $value);
			return $resolved ? (string) $resolved : '';
		}
		if (is_string($value)) {
			return $value;
		}
		return '';
	};

	$bg_url = $resolve_bg_url($data->blog_banner_background ?? null);
	$bg_style = $bg_url !== '' ? ('background-image: url(' . esc_url($bg_url) . ');') : '';
?>

<div class="blog-banner" style="<?php echo esc_attr($bg_style); ?>">
    <div class="blog-banner__inner">
        <div class="blog-banner__content">
            <div class="blog-banner__text">
                <p class="blog-banner__eyebrow"><?php echo esc_html( (string) ( $data->blog_banner_text ?? 'Subscribe' ) ); ?></p>
                <h5 class="blog-banner__heading"><?php echo esc_html( (string) ( $data->blog_banner_h6 ?? 'Get the latest insights, right to your inbox.' ) ); ?></h5>
            </div>
            <a class="get-started-button" href="<?php echo esc_url( (string) ( $data->blog_banner_button_url ?? '#' ) ); ?>">
                <div class="text-container">
                    <span class="get-started-text-old"><?php echo esc_html( (string) ( $data->blog_banner_button_text ?? 'Primary CTA' ) ); ?></span>
                    <span class="get-started-text-new"><?php echo esc_html( (string) ( $data->blog_banner_button_text ?? 'Primary CTA' ) ); ?></span>
                </div>
                <div class="icon-container">
                    <div class="arrow-container">
                        <div class="arrow-old">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vector.svg" alt="">
                        </div>
                        <div class="arrow-new">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vector.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>