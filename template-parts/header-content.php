<?php
/**
 * Template part for displaying header content
 *
 * @package silicon-expert
 * @since 1.0.0
 */
?>
	<header id="masthead" class="site-header" x-data="{ activeMenu: null, showSearchPopover: false, searchTermValue: '', searchTermActive: false }" :class="{ 'has-popover-open': (showSearchPopover || activeMenu !== null) }" @mouseleave="activeMenu = null; showSearchPopover = false; searchTermValue = ''; searchTermActive = false">
	<div class="header">
		<div class="logo">
			<a href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?php bloginfo('name'); ?>">
			</a>
		</div>
		<nav class="menu">
			<ul id="main-menu">
				<li @mouseenter="if (!showSearchPopover) { activeMenu = 'solutions' }">
					<a href="#">Solutions & Products <img :src="(activeMenu === 'solutions') ? '<?php echo get_template_directory_uri(); ?>/assets/images/arrow-up.svg' : '<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg'" alt=""></a>
				</li>
				<li @mouseenter="if (!showSearchPopover) { activeMenu = 'partners' }">
					<a href="#">Partner Integrations <img :src="(activeMenu === 'partners') ? '<?php echo get_template_directory_uri(); ?>/assets/images/arrow-up.svg' : '<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg'" alt=""></a>
				</li>
				<li @mouseenter="if (!showSearchPopover) { activeMenu = 'resources' }">
					<a href="#">Resources <img :src="(activeMenu === 'resources') ? '<?php echo get_template_directory_uri(); ?>/assets/images/arrow-up.svg' : '<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg'" alt=""></a>
				</li>
				<li @mouseenter="if (!showSearchPopover) { activeMenu = 'company' }">
					<a href="#">Company <img :src="(activeMenu === 'company') ? '<?php echo get_template_directory_uri(); ?>/assets/images/arrow-up.svg' : '<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg'" alt=""></a>
				</li>
			</ul>
		</nav>
		<div class="search">
			<img class="search-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/find.svg" alt="" @click="activeMenu = null; showSearchPopover = true">
			<div class="language-selector">
				<p>EN</p>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="">
			</div>
			<div class="action-buttons">
				<button class="group login-button">
					<span class="fill-layout"></span>
					<p>Login</p>
				</button>
				<button class="get-started-button">
					<div class="text-container">
						<span class="get-started-text-old">Get Started</span>
						<span class="get-started-text-new">Get Started</span>
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
				</button>
			</div>
		</div>
	</div>

	<!-- Search Popover -->
	<div class="popover-search-container" @mouseleave="showSearchPopover = false; searchTermValue = ''; searchTermActive = false">
		<div class="popover-search" x-show="showSearchPopover" x-transition>
			<div class="search-term" :class="{ 'is-active': searchTermActive }" @click="searchTermValue = 'Data and Intelligence'; searchTermActive = true">
				<input class="search-input" type="text" placeholder="Search term here" readonly :value="searchTermValue">
				<button class="search-button">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/find.svg" alt="Search">
				</button>
			</div>
		</div>
	</div>

	<!-- Mega Menu -->
	<div class="mega-menu-container" @mouseenter="activeMenu = activeMenu" @mouseleave="activeMenu = null">
		<!-- Solutions & Products Mega Menu -->
		<div class="mega-menu" x-show="activeMenu === 'solutions'" x-transition>
			<?php
			// Get ACF options data
			$heading1 = get_field('mega_menu_heading1', 'option');
			$heading1_text = get_field('mega_menu_heading1_text', 'option');
			$heading2 = get_field('mega_menu_heading2', 'option');
			$heading2_text = get_field('mega_menu_heading2_text', 'option');
			$heading3 = get_field('mega_menu_heading3', 'option');
			$heading3_text = get_field('mega_menu_heading3_text', 'option');
			$dropdown_image = get_field('mega_menu_image', 'option');
			?>
			
			<div class="dropdown-container">
				<div class="dropdown-section-1">
					<div class="section-1-content">
						<?php if ($heading1): ?>
							<h6><?php echo esc_html($heading1); ?></h6>
						<?php endif; ?>
						
						<?php if ($heading1_text): ?>
							<div class="items-wrapper">
								<?php foreach ($heading1_text as $item): ?>
									<div class="item">
										<?php if (isset($item['title_hero'])): ?>
											<p class="item-title"><?php echo esc_html($item['title_hero']); ?></p>
										<?php endif; ?>
										<?php if (isset($item['text_hero'])): ?>
											<p class="item-text"><?php echo esc_html($item['text_hero']); ?></p>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ($dropdown_image): ?>
						<img class="section-1-image" src="<?php echo esc_url($dropdown_image['url']); ?>" alt="<?php echo esc_attr($dropdown_image['alt'] ?? ''); ?>">
					<?php endif; ?>
				</div>
				
				<div class="dropdown-section-2">
					<div class="section-2-inner">
						<?php if ($heading2): ?>
							<h6><?php echo esc_html($heading2); ?></h6>
						<?php endif; ?>
						
						<?php if ($heading2_text): ?>
							<div class="columns-wrapper">
								<?php 
								$total_items = count($heading2_text);
								$items_per_column = ceil($total_items / 2);
								$column1 = array_slice($heading2_text, 0, $items_per_column);
								$column2 = array_slice($heading2_text, $items_per_column);
								?>
								
								<div class="column">
									<?php foreach ($column1 as $item): ?>
										<div class="item">
											<?php if (isset($item['title_hero'])): ?>
												<p class="item-title"><?php echo esc_html($item['title_hero']); ?></p>
											<?php endif; ?>
											<?php if (isset($item['text_hero'])): ?>
												<p class="item-text"><?php echo esc_html($item['text_hero']); ?></p>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
								
								<?php if (!empty($column2)): ?>
									<div class="column">
										<?php foreach ($column2 as $item): ?>
											<div class="item">
												<?php if (isset($item['title_hero'])): ?>
													<p class="item-title"><?php echo esc_html($item['title_hero']); ?></p>
												<?php endif; ?>
												<?php if (isset($item['text_hero'])): ?>
													<p class="item-text"><?php echo esc_html($item['text_hero']); ?></p>
												<?php endif; ?>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="dropdown-section-3">
					<?php if ($heading3): ?>
						<h6><?php echo esc_html($heading3); ?></h6>
					<?php endif; ?>
					
					<?php if ($heading3_text): ?>
						<div class="grid-wrapper">
							<?php foreach ($heading3_text as $item): ?>
								<div class="item">
									<p class="item-title"><?php echo esc_html($item['title_hero']); ?></p>
									<p class="item-text"><?php echo esc_html($item['text_hero']); ?></p>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- Partner Integrations Popover -->
		<div class="mega-menu" x-show="activeMenu === 'partners'" x-transition>
			<?php
			$partner_simple_heading1 = get_field('partner_simple_heading1', 'option');
			$partner_simple_image1 = get_field('partner_simple_image1', 'option');
			$partner_simple_heading1_text = get_field('partner_simple_heading1_text', 'option');
			$partner_simple_button_text = get_field('partner_simple_button_text', 'option');
			$partner_simple_button_link = get_field('partner_simple_button_link', 'option');
			$partner_simple_heading2 = get_field('partner_simple_heading2', 'option');
			$partner_simple_text2 = get_field('partner_simple_text2', 'option');
			$partner_simple_image2 = get_field('partner_simple_image2', 'option');
			?>
			<div class="dropdown-simple">
				<div class="dropdown-simple__main">
					<div class="dropdown-simple__header">
						<?php if (!empty($partner_simple_heading1)) : ?>
							<h6 class="dropdown-simple__title"><?php echo esc_html($partner_simple_heading1); ?></h6>
						<?php endif; ?>
					</div>

					<div class="dropdown-simple__content">
						<div class="dropdown-simple__media">
							<?php if (!empty($partner_simple_image1) && is_array($partner_simple_image1) && !empty($partner_simple_image1['url'])) : ?>
								<img class="dropdown-simple__image" src="<?php echo esc_url($partner_simple_image1['url']); ?>" alt="<?php echo esc_attr($partner_simple_image1['alt'] ?? ''); ?>" />
							<?php endif; ?>

							<?php if (!empty($partner_simple_button_text) && !empty($partner_simple_button_link)) : ?>
								<a class="dropdown-simple__cta" href="<?php echo esc_url($partner_simple_button_link); ?>">
									<span class="dropdown-simple__cta-text"><?php echo esc_html($partner_simple_button_text); ?></span>
									<span class="dropdown-cta-icon-container">
										<span class="dropdown-cta-arrow-container">
											<div class="dropdown-cta-arrow-old">
												<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
											</div>
											<div class="dropdown-cta-arrow-new">
												<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
											</div>
										</span>
									</span>
								</a>
							<?php endif; ?>
						</div>

						<?php if (!empty($partner_simple_heading1_text) && is_array($partner_simple_heading1_text)) : ?>
							<div class="dropdown-simple__list">
								<?php foreach ($partner_simple_heading1_text as $item) : ?>
									<?php
										$text = '';
										if (is_array($item)) {
											$text = $item['simple_text'] ?? '';
										}
										?>
										<?php if (!empty($text)) : ?>
											<div class="dropdown-simple__list-item">
												<p class="dropdown-simple__list-text"><?php echo esc_html($text); ?></p>
											</div>
										<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="dropdown-simple__side">
					<div class="dropdown-simple__side-content">
						<?php if (!empty($partner_simple_heading2)) : ?>
							<p class="dropdown-simple__side-title"><?php echo esc_html($partner_simple_heading2); ?></p>
						<?php endif; ?>
						<?php if (!empty($partner_simple_text2)) : ?>
							<p class="dropdown-simple__side-text"><?php echo esc_html($partner_simple_text2); ?></p>
						<?php endif; ?>
					</div>

					<?php if (!empty($partner_simple_image2) && is_array($partner_simple_image2) && !empty($partner_simple_image2['url'])) : ?>
						<img class="dropdown-simple__side-image" src="<?php echo esc_url($partner_simple_image2['url']); ?>" alt="<?php echo esc_attr($partner_simple_image2['alt'] ?? ''); ?>" />
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- Resources Popover -->
		<div class="mega-menu" x-show="activeMenu === 'resources'" x-transition>
			<?php
			$resources_modern_heading1 = get_field('resources_modern_heading1', 'option');
			$resources_modern_image = get_field('resources_modern_image', 'option');
			$resources_modern_subheading1 = get_field('resources_modern_subheading1', 'option');
			$resources_modern_button_text = get_field('resources_modern_button_text', 'option');
			$resources_modern_button_link = get_field('resources_modern_button_link', 'option');
			$resources_modern_heading1_text = get_field('resources_modern_heading1_text', 'option');
			$resources_modern_heading2 = get_field('resources_modern_heading2', 'option');
			$resources_modern_text2 = get_field('resources_modern_text2', 'option');
			?>
			<div class="dropdown-modern">
				<div class="dropdown-modern__main">
					<div class="dropdown-modern__main-inner">
						<?php if (!empty($resources_modern_heading1)) : ?>
							<h6 class="dropdown-modern__title"><?php echo esc_html($resources_modern_heading1); ?></h6>
						<?php endif; ?>

						<div class="dropdown-modern__content">
							<div class="dropdown-modern__media">
								<div class="dropdown-modern__media-stack">
									<div class="dropdown-modern__feature">
										<?php if (!empty($resources_modern_image) && is_array($resources_modern_image) && !empty($resources_modern_image['url'])) : ?>
											<div class="dropdown-modern__image-wrapper">
												<img class="dropdown-modern__image" src="<?php echo esc_url($resources_modern_image['url']); ?>" alt="<?php echo esc_attr($resources_modern_image['alt'] ?? ''); ?>" />
												<?php if (!empty($resources_modern_button_link)) : ?>
													<a class="dropdown-modern__image-action" href="<?php echo esc_url($resources_modern_button_link); ?>" aria-label="Open">
														<span class="dropdown-modern__image-action-arrow-container">
															<div class="dropdown-modern__image-action-arrow-old">
																<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
															</div>
															<div class="dropdown-modern__image-action-arrow-new">
																<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
															</div>
														</span>
													</a>
												<?php endif; ?>
											</div>
										<?php endif; ?>
										<?php if (!empty($resources_modern_subheading1)) : ?>
											<p class="dropdown-modern__feature-text"><?php echo esc_html($resources_modern_subheading1); ?></p>
										<?php endif; ?>
									</div>

									<?php if (!empty($resources_modern_button_text) && !empty($resources_modern_button_link)) : ?>
										<a class="dropdown-modern__cta" href="<?php echo esc_url($resources_modern_button_link); ?>">
											<span class="dropdown-modern__cta-text"><?php echo esc_html($resources_modern_button_text); ?></span>
											<span class="dropdown-cta-icon-container">
												<span class="dropdown-cta-arrow-container">
													<div class="dropdown-cta-arrow-old">
														<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
													</div>
													<div class="dropdown-cta-arrow-new">
														<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
													</div>
												</span>
											</span>
										</a>
									<?php endif; ?>
								</div>
							</div>

							<?php if (!empty($resources_modern_heading1_text) && is_array($resources_modern_heading1_text)) : ?>
								<div class="dropdown-modern__list">
									<?php foreach ($resources_modern_heading1_text as $item) : ?>
										<?php
											$text = '';
											if (is_array($item)) {
												$text = $item['modern_text'] ?? '';
											}
										?>
										<?php if (!empty($text)) : ?>
											<div class="dropdown-modern__list-item">
												<p class="dropdown-modern__list-text"><?php echo esc_html($text); ?></p>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="dropdown-modern__side">
					<div class="dropdown-modern__side-inner">
						<?php if (!empty($resources_modern_heading2)) : ?>
							<h6 class="dropdown-modern__side-title"><?php echo esc_html($resources_modern_heading2); ?></h6>
						<?php endif; ?>

						<?php if (!empty($resources_modern_text2) && is_array($resources_modern_text2)) : ?>
							<div class="dropdown-modern__side-list">
								<?php foreach ($resources_modern_text2 as $item) : ?>
									<?php
										$text = '';
										if (is_array($item)) {
											$text = $item['modern_text'] ?? '';
										}
										?>
										<?php if (!empty($text)) : ?>
											<div class="dropdown-modern__side-item">
												<p class="dropdown-modern__side-text"><?php echo esc_html($text); ?></p>
											</div>
										<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Company Popover -->
		<div class="mega-menu" x-show="activeMenu === 'company'" x-transition>
			<?php
			$company_classic_heading1 = get_field('company_classic_heading1', 'option');
			$company_classic_subheading1 = get_field('company_classic_subheading1', 'option');
			$company_classic_button_text = get_field('company_classic_button_text', 'option');
			$company_classic_button_link = get_field('company_classic_button_link', 'option');
			$company_classic_heading2 = get_field('company_classic_heading2', 'option');
			$company_classic_subheading2 = get_field('company_classic_subheading2', 'option');
			$company_classic_image2 = get_field('company_classic_image2', 'option');
			$company_classic_heading3 = get_field('company_classic_heading3', 'option');
			$company_classic_subheading3 = get_field('company_classic_subheading3', 'option');
			$company_classic_image3 = get_field('company_classic_image3', 'option');
			?>
			<div class="dropdown-classic">
				<div class="dropdown-classic__col dropdown-classic__col--intro">
					<div class="dropdown-classic__intro">
						<div class="dropdown-classic__intro-content">
							<?php if (!empty($company_classic_heading1)) : ?>
								<h6 class="dropdown-classic__intro-title"><?php echo esc_html($company_classic_heading1); ?></h6>
							<?php endif; ?>
							<?php if (!empty($company_classic_subheading1)) : ?>
								<p class="dropdown-classic__intro-text"><?php echo esc_html($company_classic_subheading1); ?></p>
							<?php endif; ?>
						</div>

						<?php if (!empty($company_classic_button_text) && !empty($company_classic_button_link)) : ?>
							<a class="dropdown-classic__cta" href="<?php echo esc_url($company_classic_button_link); ?>">
								<span class="dropdown-classic__cta-text"><?php echo esc_html($company_classic_button_text); ?></span>
								<span class="dropdown-cta-icon-container">
									<span class="dropdown-cta-arrow-container">
										<div class="dropdown-cta-arrow-old">
											<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
										</div>
										<div class="dropdown-cta-arrow-new">
											<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/vector.svg" alt="" />
										</div>
									</span>
								</span>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="dropdown-classic__col dropdown-classic__col--card dropdown-classic__col--card-1">
					<div class="dropdown-classic__card-header">
						<?php if (!empty($company_classic_heading2)) : ?>
							<p class="dropdown-classic__card-title"><?php echo esc_html($company_classic_heading2); ?></p>
						<?php endif; ?>
						<?php if (!empty($company_classic_subheading2)) : ?>
							<p class="dropdown-classic__card-text"><?php echo esc_html($company_classic_subheading2); ?></p>
						<?php endif; ?>
					</div>

					<?php if (!empty($company_classic_image2) && is_array($company_classic_image2) && !empty($company_classic_image2['url'])) : ?>
						<img class="dropdown-classic__card-image" src="<?php echo esc_url($company_classic_image2['url']); ?>" alt="<?php echo esc_attr($company_classic_image2['alt'] ?? ''); ?>" />
					<?php endif; ?>
				</div>

				<div class="dropdown-classic__col dropdown-classic__col--card dropdown-classic__col--card-2">
					<div class="dropdown-classic__card-header">
						<?php if (!empty($company_classic_heading3)) : ?>
							<p class="dropdown-classic__card-title"><?php echo esc_html($company_classic_heading3); ?></p>
						<?php endif; ?>
						<?php if (!empty($company_classic_subheading3)) : ?>
							<p class="dropdown-classic__card-text"><?php echo esc_html($company_classic_subheading3); ?></p>
						<?php endif; ?>
					</div>

					<?php if (!empty($company_classic_image3) && is_array($company_classic_image3) && !empty($company_classic_image3['url'])) : ?>
						<img class="dropdown-classic__card-image" src="<?php echo esc_url($company_classic_image3['url']); ?>" alt="<?php echo esc_attr($company_classic_image3['alt'] ?? ''); ?>" />
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
