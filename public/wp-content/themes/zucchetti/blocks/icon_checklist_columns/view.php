<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="vc-icon-checklist-columns">
    
    <?php if ($title) {?>
        <h4 class="vc-icon-checklist-columns--title"><?php echo $title;?></h4>
    <?php }?>
    
    <?php if ( !empty($items) ) {?>
        <div class="vc-icon-checklist-columns--items">
            <?php foreach ( $items as $item ) : ?>
                <?php if ( ! empty( $item['description'] ) ) : ?>
                    <div class="vc-icon-checklist-columns--item">
                        <div class="vc-icon-checklist-columns--item_description">
                            <?php echo $item['description']; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php }?>
</div>