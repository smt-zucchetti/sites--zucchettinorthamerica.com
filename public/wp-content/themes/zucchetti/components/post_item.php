<?php

/**
 * A useful component if you need to create a custom block
 * to display post item data.
 */

$post_thumbnail_url = get_the_post_thumbnail_url($post->ID, 'medium');
$date 				= get_the_date('F jS, Y');
$link 				= get_the_permalink();

if ($post_thumbnail_url) {
	$featured_image = $post_thumbnail_url;
} else {
	$featured_image = get_stylesheet_directory_uri() . '/dist/images/blog_placeholder.jpg';
}

?>
<div class="rk-md-6 rk-lg-4">
	<article <?php post_class(); ?>>
		<div class="post-item">
			<div class="post-item--inner">
				<div class="post-item--featured-image_wrap">
					<a href="<?php echo $link;?>" class="post-item--featured-image" style="background-image:url('<?php echo $featured_image;?>')"></a>
				</div>
				<div class="post-item--meta">
					<h3 class="post-item--title">
						<a href="<?php echo $link;?>"><?php echo get_the_title();?></a>
					</h3>
					<div class="post-item--date">
						<?php echo $date;?>
					</div>
					<div class="post-item--excerpt">
						<?php the_excerpt(); ?>
					</div>
					<div class="post-item--link_wrap">
						<a class="nectar-button large" href="<?php echo $link;?>" target="" tabindex="0">
        					<span><?php echo __('Read More', 'salient');?></span>
        				</a>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>