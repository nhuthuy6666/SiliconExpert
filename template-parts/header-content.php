<?php
/**
 * Template part for displaying header content
 *
 * @package silicon-expert
 * @since 1.0.0
 */
?>
	<header id="masthead" class="site-header" x-data="{ activeMenu: null, showSearchPopover: false, showMobileMenu: false, searchTermValue: '', searchTermActive: false }" x-init="$watch('showMobileMenu', value => document.body.classList.toggle('no-scroll', value))" :class="{ 'has-popover-open': (showSearchPopover || showMobileMenu || activeMenu !== null) }" @mouseleave="if (window.matchMedia('(hover: hover)').matches) { activeMenu = null; showSearchPopover = false; searchTermValue = ''; searchTermActive = false }">
	<div class="header">
		<div class="logo">
			<a href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?php bloginfo('name'); ?>">
			</a>
		</div>
		<nav class="menu">
			<ul id="main-menu">
				<?php
				$menu_locations = get_nav_menu_locations();
				$header_menu_id = isset($menu_locations['header_menu']) ? (int) $menu_locations['header_menu'] : 0;
				$header_menu_items = $header_menu_id ? wp_get_nav_menu_items($header_menu_id) : array();
				$header_menu_top_items = array();
				if (!empty($header_menu_items) && is_array($header_menu_items)) {
					foreach ($header_menu_items as $menu_item) {
						if (!isset($menu_item->menu_item_parent) || (string) $menu_item->menu_item_parent !== '0') {
							continue;
						}
						$header_menu_top_items[] = $menu_item;
					}
				}
				?>
				<?php foreach ($header_menu_top_items as $menu_item) : ?>
					<?php
						$menu_key = 'mi' . (int) $menu_item->ID;
						$meta_has_popover = function_exists('siliconexpert_menu_item_meta_get_bool') ? siliconexpert_menu_item_meta_get_bool($menu_item->ID, '_se_popover_enabled', false) : false;
						$meta_type = function_exists('siliconexpert_menu_item_meta_get') ? siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_type', '') : '';
						$has_popover = ($meta_has_popover && $meta_type !== '');
					?>
					<li @mouseenter="if (!showSearchPopover && <?php echo $has_popover ? 'true' : 'false'; ?>) { activeMenu = '<?php echo esc_attr($menu_key); ?>' }">
						<a href="<?php echo esc_url($menu_item->url ?? '#'); ?>">
							<?php echo esc_html($menu_item->title ?? ''); ?>
							<?php if ($has_popover) : ?>
								<img :src="(activeMenu === '<?php echo esc_attr($menu_key); ?>') ? '<?php echo get_template_directory_uri(); ?>/assets/images/arrow-up.svg' : '<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg'" alt="">
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
		<div class="search">
			<img class="search-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/find.svg" alt="" @click="activeMenu = null; showMobileMenu = false; showSearchPopover = true">
			<img class="menu-icon" :src="(showMobileMenu || activeMenu !== null) ? '<?php echo get_template_directory_uri(); ?>/assets/images/x-close.svg' : '<?php echo get_template_directory_uri(); ?>/assets/images/menu.svg'" alt="" @click="if (activeMenu !== null) { activeMenu = null } else if (showMobileMenu) { showMobileMenu = false } else { showMobileMenu = true; showSearchPopover = false; searchTermValue = ''; searchTermActive = false }">
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
	<div class="popover-search-container" @mouseleave="if (window.matchMedia('(hover: hover)').matches) { showSearchPopover = false; searchTermValue = ''; searchTermActive = false }">
		<div class="popover-search" x-show="showSearchPopover" x-transition>
			<div class="search-term" :class="{ 'is-active': searchTermActive }" @click="searchTermValue = 'Data and Intelligence'; searchTermActive = true">
				<input class="search-input" type="text" placeholder="Search term here" readonly :value="searchTermValue">
				<button class="search-button">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/find.svg" alt="Search">
				</button>
			</div>
		</div>
	</div>

	<!-- Mobile Menu Popover -->
	<div class="popover-mobile-menu" x-show="showMobileMenu" x-transition.opacity @keydown.escape.window="showMobileMenu = false" @click.self="showMobileMenu = false">
		<div class="popover-mobile-menu__panel">
			<ul class="popover-mobile-menu__list">
				<?php foreach ($header_menu_top_items as $menu_item) : ?>
					<?php
						$menu_key = 'mi' . (int) $menu_item->ID;
						$meta_has_popover = function_exists('siliconexpert_menu_item_meta_get_bool') ? siliconexpert_menu_item_meta_get_bool($menu_item->ID, '_se_popover_enabled', false) : false;
						$meta_type = function_exists('siliconexpert_menu_item_meta_get') ? siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_type', '') : '';
						$has_popover = ($meta_has_popover && $meta_type !== '');
					?>
					<li>
						<a class="popover-mobile-menu__link" href="<?php echo esc_url($menu_item->url ?? '#'); ?>" <?php if ($has_popover) : ?>@click.prevent="showMobileMenu = false; showSearchPopover = false; activeMenu = '<?php echo esc_attr($menu_key); ?>'"<?php else : ?>@click="showMobileMenu = false"<?php endif; ?>>
							<h6><?php echo esc_html($menu_item->title ?? ''); ?></h6> 
							<?php if ($has_popover) : ?>
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/arr-right.svg" alt="">
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>
				<li>
					<a class="popover-mobile-menu__link" href="#" @click.prevent="showMobileMenu = false">
						<h6>Selected Region name </h6>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/arr-right.svg" alt="">
					</a>
				</li>
			</ul>
			<div class="popover-mobile-menu__footer">
				<button class="popover-mobile-menu__login-button group" type="button">
					<span class="fill-layout"></span>
					<p>Login</p>
				</button>
				<button class="popover-mobile-menu__get-started-button" type="button">
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

	<!-- Mega Menu -->
	<div class="mega-menu-container" @mouseenter="activeMenu = activeMenu" @mouseleave="if (window.matchMedia('(hover: hover)').matches) { activeMenu = null }">
		<?php foreach ($header_menu_top_items as $menu_item) : ?>
			<?php
				$menu_key = 'mi' . (int) $menu_item->ID;
				$enabled = function_exists('siliconexpert_menu_item_meta_get_bool') ? siliconexpert_menu_item_meta_get_bool($menu_item->ID, '_se_popover_enabled', false) : false;
				$type = function_exists('siliconexpert_menu_item_meta_get') ? siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_type', '') : '';
				if (!$enabled || $type === '') {
					continue;
				}

				$h1 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_heading1', '');
				$h2 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_heading2', '');
				$h3 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_heading3', '');
				$sh1 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_subheading1', '');
				$sh2 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_subheading2', '');
				$sh3 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_subheading3', '');
				$img1 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_image1', '');
				$img2 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_image2', '');
				$img3 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_image3', '');
				$btn_text = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_button_text', '');
				$btn_link = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_button_link', '');
				$raw_items1 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_items1', '');
				$raw_items2 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_items2', '');
				$raw_items3 = siliconexpert_menu_item_meta_get($menu_item->ID, '_se_popover_items3', '');
				$items1 = function_exists('siliconexpert_parse_lines_to_items') ? siliconexpert_parse_lines_to_items($raw_items1) : array();
				$items2 = function_exists('siliconexpert_parse_lines_to_items') ? siliconexpert_parse_lines_to_items($raw_items2) : array();
				$items3 = function_exists('siliconexpert_parse_lines_to_items') ? siliconexpert_parse_lines_to_items($raw_items3) : array();
			?>
			<div class="mega-menu" x-show="activeMenu === '<?php echo esc_attr($menu_key); ?>'" x-transition>
				<?php if ($type === 'mega') : ?>
					<?php
						$heading1 = $h1;
						$heading2 = $h2;
						$heading3 = $h3;
						$dropdown_image_url = $img1;
						$dropdown_image_alt = '';
						$heading1_items = $items1;
						$heading2_items = $items2;
						$heading3_items = $items3;
					?>
					<div class="dropdown-container">
						<button class="popover-mobile-back" type="button" @click="activeMenu = null; showMobileMenu = true; showSearchPopover = false; searchTermValue = ''; searchTermActive = false">
							<img class="popover-mobile-back__icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arr-left.svg" alt="" />
							<p class="popover-mobile-back__title"><?php echo esc_html($menu_item->title ?? ''); ?></p>
						</button>
						<div class="dropdown-section-1">
							<div class="section-1-content">
								<?php if ($heading1): ?>
									<h6><?php echo esc_html($heading1); ?></h6>
								<?php endif; ?>
								<?php if (!empty($heading1_items)) : ?>
									<div class="items-wrapper">
										<?php foreach ($heading1_items as $it): ?>
											<?php
												$title = '';
												$text = '';
												if (is_array($it)) {
													$title = $it['title'] ?? ($it['title_hero'] ?? '');
													$text = $it['text'] ?? ($it['text_hero'] ?? '');
												}
											?>
											<div class="item">
												<?php if ($title !== ''): ?>
													<p class="item-title"><?php echo esc_html($title); ?></p>
												<?php endif; ?>
												<?php if ($text !== ''): ?>
													<p class="item-text"><?php echo esc_html($text); ?></p>
												<?php endif; ?>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
							<?php if ($dropdown_image_url !== ''): ?>
								<img class="section-1-image" src="<?php echo esc_url($dropdown_image_url); ?>" alt="<?php echo esc_attr($dropdown_image_alt); ?>">
							<?php endif; ?>
						</div>
						<div class="dropdown-section-2">
							<div class="section-2-inner">
								<?php if ($heading2): ?>
									<h6><?php echo esc_html($heading2); ?></h6>
								<?php endif; ?>
								<?php if (!empty($heading2_items)) : ?>
									<div class="columns-wrapper">
										<?php
											$total_items = count($heading2_items);
											$items_per_column = ceil($total_items / 2);
											$column1 = array_slice($heading2_items, 0, $items_per_column);
											$column2 = array_slice($heading2_items, $items_per_column);
										?>
										<div class="column">
											<?php foreach ($column1 as $it): ?>
												<?php
													$title = '';
													$text = '';
													if (is_array($it)) {
														$title = $it['title'] ?? ($it['title_hero'] ?? '');
														$text = $it['text'] ?? ($it['text_hero'] ?? '');
													}
												?>
												<div class="item">
													<?php if ($title !== ''): ?>
														<p class="item-title"><?php echo esc_html($title); ?></p>
													<?php endif; ?>
													<?php if ($text !== ''): ?>
														<p class="item-text"><?php echo esc_html($text); ?></p>
													<?php endif; ?>
												</div>
											<?php endforeach; ?>
										</div>
										<?php if (!empty($column2)): ?>
											<div class="column">
												<?php foreach ($column2 as $it): ?>
													<?php
														$title = '';
														$text = '';
														if (is_array($it)) {
															$title = $it['title'] ?? ($it['title_hero'] ?? '');
															$text = $it['text'] ?? ($it['text_hero'] ?? '');
														}
													?>
													<div class="item">
														<?php if ($title !== ''): ?>
															<p class="item-title"><?php echo esc_html($title); ?></p>
														<?php endif; ?>
														<?php if ($text !== ''): ?>
															<p class="item-text"><?php echo esc_html($text); ?></p>
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
							<?php if (!empty($heading3_items)) : ?>
								<div class="grid-wrapper">
									<?php foreach ($heading3_items as $it): ?>
										<?php
											$title = '';
											$text = '';
											if (is_array($it)) {
												$title = $it['title'] ?? ($it['title_hero'] ?? '');
												$text = $it['text'] ?? ($it['text_hero'] ?? '');
											}
										?>
										<div class="item">
											<?php if ($title !== ''): ?>
												<p class="item-title"><?php echo esc_html($title); ?></p>
											<?php endif; ?>
											<?php if ($text !== ''): ?>
												<p class="item-text"><?php echo esc_html($text); ?></p>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php elseif ($type === 'simple') : ?>
					<?php
						$partner_simple_heading1 = $h1;
						$partner_simple_button_text = $btn_text;
						$partner_simple_button_link = $btn_link;
						$partner_simple_heading2 = $h2;
						$partner_simple_text2 = $sh2;
						$partner_simple_heading1_text = $items1;
						$img1_url = $img1;
						$img1_alt = '';
						$img2_url = $img2;
						$img2_alt = '';
					?>
					<div class="dropdown-simple">
						<button class="popover-mobile-back" type="button" @click="activeMenu = null; showMobileMenu = true; showSearchPopover = false; searchTermValue = ''; searchTermActive = false">
							<img class="popover-mobile-back__icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arr-left.svg" alt="" />
							<p class="popover-mobile-back__title"><?php echo esc_html($menu_item->title ?? ''); ?></p>
						</button>
						<div class="dropdown-simple__main">
							<div class="dropdown-simple__header">
								<?php if (!empty($partner_simple_heading1)) : ?>
									<h6 class="dropdown-simple__title"><?php echo esc_html($partner_simple_heading1); ?></h6>
								<?php endif; ?>
							</div>
							<div class="dropdown-simple__content">
								<div class="dropdown-simple__media">
									<?php if ($img1_url !== '') : ?>
										<img class="dropdown-simple__image" src="<?php echo esc_url($img1_url); ?>" alt="<?php echo esc_attr($img1_alt); ?>" />
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
										<?php foreach ($partner_simple_heading1_text as $it) : ?>
											<?php
												$text = '';
												if (is_array($it)) {
													$text = $it['text'] ?? ($it['simple_text'] ?? ($it['title'] ?? ''));
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
							<?php if ($img2_url !== '') : ?>
								<img class="dropdown-simple__side-image" src="<?php echo esc_url($img2_url); ?>" alt="<?php echo esc_attr($img2_alt); ?>" />
							<?php endif; ?>
						</div>
					</div>
				<?php elseif ($type === 'modern') : ?>
					<?php
						$resources_modern_heading1 = $h1;
						$resources_modern_subheading1 = $sh1;
						$resources_modern_button_text = $btn_text;
						$resources_modern_button_link = $btn_link;
						$resources_modern_heading1_text = $items1;
						$resources_modern_heading2 = $h2;
						$resources_modern_text2 = $items2;
						$img_url = $img1;
						$img_alt = '';
					?>
					<div class="dropdown-modern">
						<button class="popover-mobile-back" type="button" @click="activeMenu = null; showMobileMenu = true; showSearchPopover = false; searchTermValue = ''; searchTermActive = false">
							<img class="popover-mobile-back__icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arr-left.svg" alt="" />
							<p class="popover-mobile-back__title"><?php echo esc_html($menu_item->title ?? ''); ?></p>
						</button>
						<div class="dropdown-modern__main">
							<div class="dropdown-modern__main-inner">
								<?php if (!empty($resources_modern_heading1)) : ?>
									<h6 class="dropdown-modern__title"><?php echo esc_html($resources_modern_heading1); ?></h6>
								<?php endif; ?>
								<div class="dropdown-modern__content">
									<div class="dropdown-modern__media">
										<div class="dropdown-modern__media-stack">
											<div class="dropdown-modern__feature">
												<?php if ($img_url !== '') : ?>
													<div class="dropdown-modern__image-wrapper">
														<img class="dropdown-modern__image" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" />
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
											<?php foreach ($resources_modern_heading1_text as $it) : ?>
												<?php
													$text = '';
													if (is_array($it)) {
														$text = $it['text'] ?? ($it['modern_text'] ?? ($it['title'] ?? ''));
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
										<?php foreach ($resources_modern_text2 as $it) : ?>
											<?php
												$text = '';
												if (is_array($it)) {
													$text = $it['text'] ?? ($it['modern_text'] ?? ($it['title'] ?? ''));
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
				<?php elseif ($type === 'classic') : ?>
					<?php
						$company_classic_heading1 = $h1;
						$company_classic_subheading1 = $sh1;
						$company_classic_button_text = $btn_text;
						$company_classic_button_link = $btn_link;
						$company_classic_heading2 = $h2;
						$company_classic_subheading2 = $sh2;
						$company_classic_heading3 = $h3;
						$company_classic_subheading3 = $sh3;
						$img2_url = $img2;
						$img2_alt = '';
						$img3_url = $img3;
						$img3_alt = '';
					?>
					<div class="dropdown-classic">
						<button class="popover-mobile-back" type="button" @click="activeMenu = null; showMobileMenu = true; showSearchPopover = false; searchTermValue = ''; searchTermActive = false">
							<img class="popover-mobile-back__icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arr-left.svg" alt="" />
							<p class="popover-mobile-back__title"><?php echo esc_html($menu_item->title ?? ''); ?></p>
						</button>
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
							<?php if ($img2_url !== '') : ?>
								<img class="dropdown-classic__card-image" src="<?php echo esc_url($img2_url); ?>" alt="<?php echo esc_attr($img2_alt); ?>" />
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
							<?php if ($img3_url !== '') : ?>
								<img class="dropdown-classic__card-image" src="<?php echo esc_url($img3_url); ?>" alt="<?php echo esc_attr($img3_alt); ?>" />
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</header>
