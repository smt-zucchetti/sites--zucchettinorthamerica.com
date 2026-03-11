<?php
/**
 * The template for displaying taxonomy archives.
 *
 * @package Salient WordPress Theme
 * @version 15.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
nectar_page_header( get_queried_object_id() );
$nectar_fp_options = nectar_get_full_page_options();

?>
<div class="container-wrap">
	<div class="<?php if ( $nectar_fp_options['page_full_screen_rows'] !== 'on' ) { echo 'container'; } ?> main-content" role="main">
		<div class="<?php echo apply_filters('nectar_main_container_row_class_name', 'row'); ?>">

			<?php nectar_hook_before_content(); ?>

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">
					<h1 class="archive-title">
						<?php single_term_title(); ?>
					</h1>
					<?php
					$term_description = term_description();
					if ( ! empty( $term_description ) ) {
						echo '<div class="taxonomy-description">' . $term_description . '</div>';
					}
					?>
				</header>

				<div class="taxonomy-posts">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('mb-24'); ?>>

							<?php include( get_stylesheet_directory() . '/blocks/resources_navigator/view-loop-item.php' );?>
                            
                        </article>
                    <?php endwhile; ?>
                </div>

				<?php nectar_pagination(); ?>

			<?php else : ?>

				<article class="no-results not-found">
					<h2><?php esc_html_e( 'Nothing Found', 'salient' ); ?></h2>
					<p><?php esc_html_e( 'Sorry, there are no resources available under this category.', 'salient' ); ?></p>
				</article>

			<?php endif; ?>

			<?php nectar_hook_after_content(); ?>

		</div>
	</div>
	<?php nectar_hook_before_container_wrap_close(); ?>
</div>
<?php get_footer(); ?>
