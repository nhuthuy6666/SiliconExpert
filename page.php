<?php
/**
 * The template for displaying all pages
 *
 * @package silicon-expert
 * @since 1.0.0
 */

get_header();
?>

<main class="site-main">
	<div class="container-custom">
		<?php
		while (have_posts()) {
			the_post();
			the_content();
		}
		?>
	</div>
</main>

<?php
get_footer();
