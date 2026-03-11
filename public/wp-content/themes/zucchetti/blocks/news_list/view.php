<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="news-list-block">
    <?php if ( !empty($title) ) : ?>
        <h2 class="news-list-title"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>

    <?php if ( !empty($items) ) : ?>
        <div class="news-list-items">
            <?php foreach ( $items as $item ) : ?>
                <article class="news-list-item">
                    <div class="news-list-item--col">
                        <?php if ( $item['image'] ) : ?>
                            <div class="news-list-image">
                                <img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
                                
                                <?php if ( $item['video'] ) : ?>
                                    <button class="news-list-play-btn" data-video='<?php echo json_encode($item['video']); ?>'>
                                        <i class="rk-icon-play"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="news-list-item--col">
                        <div class="news-list-content">
                            <?php if ( $item['date'] ) : ?>
                                <p class="news-list-date"><?php echo esc_html( $item['date'] ); ?></p>
                            <?php endif; ?>

                            <h3 class="news-list-item-title">
                                <a href="<?php echo esc_url( $item['link'] ); ?>">
                                    <?php echo esc_html( $item['title'] ); ?>
                                </a>
                            </h3>

                            <div class="news-list-content-body">
                                <?php echo wp_kses_post( $item['content'] ); ?>
                            </div>

                            <div class="news-list-readmore">
                                <a class="nectar-button jumbo regular accent-color has-icon regular-button news-list-link" role="button" style="visibility: visible;" target="_blank" href="<?php echo esc_url( $item['link'] ); ?>" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff">
                                    <span><?php echo __('Read More');?></span>
                                    <i class="icon-button-arrow"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Popup Overlay -->
<div class="news-video-popup" id="newsVideoPopup">
    <div class="news-video-popup-inner">
        <button class="news-video-close">&times;</button>
        <div class="news-video-content"></div>
    </div>
</div>