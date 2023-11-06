<?php 
/**
 * Template part for displaying Featured Classes Section
 *
 * @package Furniture Decor
 */

$furniture_decor_shop_section = get_theme_mod( 'furniture_decor_shop_category_setting',true );
$furniture_decor_section_title = get_theme_mod( 'furniture_decor_section_title' );
$furniture_decor_section_text  = get_theme_mod( 'furniture_decor_section_text' );
$furniture_decor_section_button_link  = get_theme_mod( 'furniture_decor_section_button_link' );

?>
<?php if ( $furniture_decor_shop_section ){?>
<div class="shop-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 align-self-center">
                <?php if ( $furniture_decor_section_title ){?>
                    <h3><?php echo esc_html( $furniture_decor_section_title );?></h3>
                <?php } ?>
                <?php if ( $furniture_decor_section_text ){?>
                    <p><?php echo esc_html( $furniture_decor_section_text );?></p>
                <?php } ?>
                <?php if ( $furniture_decor_section_button_link ){?>
                    <p class="btn-green">
                        <a href="<?php echo esc_url( $furniture_decor_section_button_link );?>"><?php esc_html_e('VIEW ALL CATEGORY','furniture-decor'); ?></a>
                    </p>
                <?php } ?>
            </div>
            <div class="col-lg-8 col-md-7 align-self-center">
                <?php if (class_exists('woocommerce')) { ?>
                    <div class="owl-carousel">
                        <?php
                        $prod_categories = get_terms('product_cat', array(
                            'number'     => 10,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => 0
                        ));
                        foreach ($prod_categories as $prod_cat) :
                            $cat_thumb_id = get_term_meta($prod_cat->term_id, 'thumbnail_id', true);
                            $cat_thumb_url = wp_get_attachment_thumb_url($cat_thumb_id);
                            $term_link = get_term_link($prod_cat, 'product_cat');
                            ?>                            
                            <div class="product_cat_box text-center">
                                <a href="<?php echo esc_url($term_link); ?>"><img src="<?php echo esc_url($cat_thumb_url); ?>" alt="<?php echo esc_attr($prod_cat->name); ?>" /></a>
                                <a href="<?php echo esc_url($term_link); ?>"><h4 class="pt-3"><?php echo esc_html($prod_cat->name); ?></h4></a>
                            </div>                            
                        <?php endforeach;
                        wp_reset_query();
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>