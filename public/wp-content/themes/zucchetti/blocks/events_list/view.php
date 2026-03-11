<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="zucchetti-events-block" data-type="<?php echo $atts['display'] ;?>">
    <?php if ( !empty($items) ) { ?>

        <?php if ($atts['display'] == 'accordion') {?>
            <div class="zucchetti-events--accordion_header">
                <h3 class="zucchetti-events--accordion_header_title"><strong><?php echo __('Past Events', 'salient');?></strong><h3>
                    <?php /*
                <i class="rk-icon-fat-chevron-down"></i>
                */?>
            </div>
        <?php }?>

        <div class="zucchetti-events-grid">
            <?php foreach ( $items as $item ) { ?>
                <div class="zucchetti-event-card">
                    <div class="zucchetti-event-card--inner">
                        <div class="zucchetti-event-card--image_col">
                            <?php if ( $item['image'] ) { ?>
                                <div class="zucchetti-event-card--image_wrap">
                                    <img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
                                </div>
                            <?php } else {?>
                                <div class="zucchetti-event-card--image_placeholder">
                                    <i class="rk-icon-calendar"></i>
                                </div>
                            <?php }?>
                        </div>
                        <div class="zucchetti-event-card--content">
                            <h3 class="zucchetti-event-card--title"><?php echo esc_html( $item['title'] ); ?></h3>
                            <p class="zucchetti-event-card--date_location">
                                <i class="rk-icon-calendar"></i>
                                <span><?php echo esc_html( EventsListModel::format_date_range( $item['start'], $item['end'] ) ); ?></span>
                                <?php if ( $item['location'] ) { ?><span> | </span><span><?php echo esc_html( $item['location'] ); ?></span><?php } ?>
                            </p>
                            <div class="zucchetti-event-card--description"><?php echo wp_kses_post( $item['content'] ); ?></div>
                            <?php if ( $item['link'] ) { ?>
                                <div class="zucchetti-event-card--link_wrap">
                                    <a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank" class="zucchetti-event-card--link">
                                        <span><?php echo __('Read More','salient');?></span>
                                        <i class="rk-icon-arrow-circle"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>            
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="warning">
            <p>Check back soon for <?php echo $atts['type'];?> events!</p>
        </div>
    <?php } ?>
</div>
