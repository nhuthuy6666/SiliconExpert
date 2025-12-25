<?php
?>

<div class="blog-footer">
    <div class="blog-footer__inner">
        <div class="blog-footer__bar">
            <div class="blog-footer__share">
                <p class="blog-footer__share-label">Share</p>
                <div class="blog-footer__share-icons-wrap">
                    <div class="blog-footer__share-icons">
                        <a class="blog-footer__share-icon" href="<?php echo esc_url( (string) ( $data->blog_footer_x_link ?? '#' ) ); ?>" target="_blank" rel="noopener">
                            <img class="blog-footer__share-icon-img blog-footer__share-icon-img--x" src="<?php echo get_template_directory_uri(); ?>/assets/images/X.svg" alt="X"/>
                        </a>
                        <a class="blog-footer__share-icon" href="<?php echo esc_url( (string) ( $data->blog_footer_facebook_link ?? '#' ) ); ?>" target="_blank" rel="noopener">
                            <img class="blog-footer__share-icon-img blog-footer__share-icon-img--facebook" src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt="Facebook"/>
                        </a>
                        <a class="blog-footer__share-icon" href="<?php echo esc_url( (string) ( $data->blog_footer_linkedin_link ?? '#' ) ); ?>" target="_blank" rel="noopener">
                            <img class="blog-footer__share-icon-img blog-footer__share-icon-img--linkedin" src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.svg" alt="LinkedIn"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="blog-footer__download">
                <p class="blog-footer__download-label">Download</p>
                <div class="blog-footer__download-icon">
                    <img class="blog-footer__download-icon-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/download.svg" alt=""/>
                </div>
            </div>
        </div>
    </div>
</div>