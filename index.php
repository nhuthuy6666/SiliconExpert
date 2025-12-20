<?php
/**
 * The main template file
 *
 * @package silicon-expert
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container-custom">
		<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			}
		} else {
			?>
			<p>No content found.</p>
			<?php
		}
		?>
	</div>
</main>

<?php
get_footer();