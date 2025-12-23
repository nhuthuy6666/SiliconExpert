<footer id="colophon" class="site-footer">
	<div class="footer-content">
		<?php $footer_logo = get_field('footer_logo', 'option'); ?>
		<?php if ($footer_logo): ?>
			<img class="footer-logo" src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
		<?php else: ?>
			<img class="footer-logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
		<?php endif; ?>
		<?php $get_started_text = get_field('footer_get_started_text', 'option') ?: 'Get Started'; ?>
		<?php $get_started_link = get_field('footer_get_started_link', 'option') ?: '#'; ?>
		<a class="get-started-button-mobile" href="<?php echo esc_url($get_started_link); ?>">
			<div class="text-container">
				<span class="get-started-text-old"><?php echo esc_html($get_started_text); ?></span>
				<span class="get-started-text-new"><?php echo esc_html($get_started_text); ?></span>
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
		<div class="footer-columns">
			<?php
			$render_footer_grid = function ($grid) use ($get_started_link, $get_started_text) {
				if (empty($grid) || !is_array($grid)) {
					return;
				}
				$columns = $grid['columns'] ?? array();
				if (!is_array($columns)) {
					$columns = array();
				}
				$show_button = !empty($grid['show_button']);
				if (empty($columns) && !$show_button) {
					return;
				}
				?>
				<div class="footer-column<?php echo $show_button ? ' footer-column--cta' : ''; ?>">
					<?php foreach ($columns as $col): ?>
						<?php
						if (empty($col) || !is_array($col)) {
							continue;
						}
						$sections = $col['sections'] ?? array();
						if (empty($sections) || !is_array($sections)) {
							continue;
						}
						foreach ($sections as $section):
							?>
							<div class="footer-items">
								<p class="footer-column-title"><?php echo esc_html($section['title'] ?? ''); ?></p>
								<div class="footer-column-items">
									<?php if (!empty($section['links']) && is_array($section['links'])): ?>
										<?php foreach ($section['links'] as $link): ?>
											<p class="footer-link"><a href="<?php echo esc_url($link['url'] ?? '#'); ?>"><?php echo esc_html($link['text'] ?? ''); ?></a></p>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endforeach; ?>

					<?php if ($show_button): ?>
						<a class="get-started-button" href="<?php echo esc_url($get_started_link); ?>">
							<div class="text-container">
								<span class="get-started-text-old"><?php echo esc_html($get_started_text); ?></span>
								<span class="get-started-text-new"><?php echo esc_html($get_started_text); ?></span>
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
					<?php endif; ?>
				</div>
				<?php
			};

			$grids = get_field('footer_grids', 'option');
			if (!empty($grids) && is_array($grids)) {
				foreach (array('grid1', 'grid2', 'grid3', 'grid4') as $grid_key) {
					if (empty($grids[$grid_key]) || !is_array($grids[$grid_key])) {
						continue;
					}
					$render_footer_grid($grids[$grid_key]);
				}
			}
			?>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="footer-bottom-left">
			<p class="footer-bottom-text"><?php echo esc_html(get_field('footer_copyright', 'option') ?: '© 2025 SiliconExpert. All Rights Reserved.'); ?></p>
			<p class="footer-bottom-text"><?php echo esc_html(get_field('footer_address', 'option') ?: '9151 E Panorama Circle Centennial, CO 80112'); ?></p>
			<p class="footer-bottom-text"><?php echo esc_html(get_field('footer_phone', 'option') ?: '408.330.7575'); ?></p>
		</div>

		<div class="footer-bottom-right">
			<a href="<?php echo esc_url(get_field('footer_privacy_link', 'option') ?: '#'); ?>" class="footer-bottom-link"><?php echo esc_html(get_field('footer_privacy_text', 'option') ?: 'Privacy Policy'); ?></a>
			<a href="<?php echo esc_url(get_field('footer_terms_link', 'option') ?: '#'); ?>" class="footer-bottom-link"><?php echo esc_html(get_field('footer_terms_text', 'option') ?: 'Terms of Use'); ?></a>
		</div>
	</div>
</footer>
