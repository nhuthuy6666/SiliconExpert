<?php
	$hero_bg = $data->hero_background ?? null;
	$hero_bg_url = '';
	if (is_array($hero_bg)) {
		$hero_bg_url = $hero_bg['url'] ?? '';
	} elseif (is_string($hero_bg)) {
		$hero_bg_url = $hero_bg;
	}
	$hero_bg_style = $hero_bg_url ? 'background-image: url(' . esc_url($hero_bg_url) . ');' : '';
?>

<div class="hero-block" style="<?php echo esc_attr($hero_bg_style); ?>">
    <div class="banner-container">
        <p class="banner-title"><?php echo esc_html($data->title);?></p>
        <div class="banner-heading-wrapper">
            <h1><?php echo esc_html($data->heading);?></h1>
        </div>
        <h6 class="banner-subheading"><?php echo esc_html($data->subheading);?></h6>
        <div class="banner-buttons">
            <?php if($data->buttons){
             foreach($data->buttons as $button){
                    if ($button['style'] == 'primary') {
                    ?>
                    <a href="<?php echo esc_url($button['url']);?>" class="banner-button-primary">
                        <div class="text-container">
                            <span class="button-text-old"><?php echo esc_html($button['text']);?></span>
                            <span class="button-text-new"><?php echo esc_html($button['text']);?></span>
                        </div>
                        <div class="icon-container">
                            <div class="arrow-container">
                                <div class="arrow-old">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector.svg" alt="">
                                </div>
                                <div class="arrow-new">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="<?php echo esc_url($button['url']);?>" class="banner-button-secondary">
                        <span class="fill-layout"></span>
                        <p><?php echo esc_html($button['text']);?></p>
                    </a>
                    <?php
                }
            }
        }?>
    </div>
</div>
<div class="hero-container">
    <div class="hero-inner">
        <?php if (have_rows('inner')) : ?>
            <?php while (have_rows('inner')) : the_row(); ?>
                <div class="hero-item">
                    <h3><?php echo wp_kses_post(get_sub_field('title_hero')) ?></h3>
                    <p><?php echo wp_kses_post(get_sub_field('text_hero')) ?></p>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
</div>