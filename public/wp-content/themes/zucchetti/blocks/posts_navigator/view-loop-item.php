<div <?php post_class('posts-navigator--item'); ?>>
    <div class="posts-navigator--item_inner">

        <a class="posts-navigator--item_link" href="<?php the_permalink(); ?>">
            <span class="screen-reader-text"><?php the_title(); ?></span>
        </a>

        <?php if ( has_post_thumbnail() ): ?>
            
            <span class="posts-navigator--item_image">
                <?php the_post_thumbnail('portfolio-thumb', [
                    'class' => 'attachment-portfolio-thumb size-portfolio-thumb wp-post-image',
                    'title' => get_the_title(),
                ]); ?>
            </span>
            
        <?php endif; ?>

        <div class="posts-navigator--item_content">
            <div class="posts-navigator--item_header">
                <h3 class="title"><?php the_title(); ?></h3>
                <span class="meta"><?php echo get_the_date('F j, Y'); ?></span>
            </div>
            <!--/post-header-->
            <div class="posts-navigator--item_excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 30, '…'); ?>
            </div>

        </div>

        <a href="<?php the_permalink(); ?>" class="posts-navigator--item_read_more">
            <span>Read More</span>
            <i class="rk-icon-arrow-circle"></i>
        </a>

    </div>
    
    
</div>
