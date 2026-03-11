<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists('RokettoProductCallouts') ) {

    class RokettoProductCallouts {

        function __construct() {
            $this->register_callouts();
        }
        
        /**
         * Registers the shortcodes
         * @return [type] [description]
         */
        public function register_callouts() {

            if ( function_exists('get_field') ) {
                $product_callouts = get_field('product_callouts', 'options');
                if ($product_callouts) {
                    foreach ($product_callouts as $callout) {
                        $shortcode = $callout['shortcode'];
                        if ( !shortcode_exists($shortcode) ) {
                            add_shortcode($shortcode, array($this, 'product_callout_shortcode') );
                        }
                    }
                }

            }
        }

        /**
         * The product callout shortcode function
         * @param  [type] $atts      [description]
         * @param  [type] $content   [description]
         * @param  [type] $shortcode [description]
         * @return [type]            [description]
         */
        public function product_callout_shortcode($atts, $content, $shortcode) {

            $product_callouts = get_field('product_callouts', 'options');

            foreach ($product_callouts as $callout) {
                if ($callout['shortcode'] == $shortcode) {
                    return $this->render_product_callout($callout);
                }
            }

        }

        /**
         * Renders the product callout
         * @param  string $callout HTML content for the callout
         * @return string          
         */
        public function render_product_callout($callout) {
            
            ob_start();

            $callout_content = $callout['content'];
            $callout_link    = $callout['link'];
            $callout_image   = $callout['image'];

            ?>
                <div class="product-callout">
                    <img class="product-callout--accent_l" src="<?php echo get_stylesheet_directory_uri();?>/dist/images/lightgreen_burst.svg" />
                    <img class="product-callout--accent_r" src="<?php echo get_stylesheet_directory_uri();?>/dist/images/br_corner_accent.svg" />
                    <div class="product-callout--row">
                        <div class="product-callout--col_l">
                            <div class="product-callout--content_wrap">
                                <div class="product-callout--content">
                                    <?php echo $callout_content;?>
                                </div>
                                <?php if ( isset($callout_link['url']) ) {?>
                                    <div class="product-callout--link">
                                        <a target="<?php echo $callout_link['target'];?>" class="nectar-button large regular extra-color-1  regular-button" role="button" style="visibility: visible;" href="<?php echo $callout_link['url'];?>" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff"><span><?php echo $callout_link['title'];?></span></a>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="product-callout--col_r">
                            <?php if ($callout_image) {?>
                                <div class="product-callout--image_wrap">
                                    <div class="product-callout--image">
                                        <img src="<?php echo $callout_image['sizes']['large'];?>" />
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            <?php

            return ob_get_clean();

        }

    }
}

new RokettoProductCallouts();