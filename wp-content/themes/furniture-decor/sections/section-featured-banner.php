<?php
/**
 * Banner Section
 * 
 * @package furniture_decor
 */
$furniture_decor_banner  = get_theme_mod( 'furniture_decor_banner_setting',true );
$furniture_decor_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('furniture_decor_blog_slide_category'),
  'posts_per_page' => 3,
); ?>
<?php if ( $furniture_decor_banner ){?>
<div class="banner">
  <div class="owl-carousel">
    <?php $furniture_decor_arr_posts = new WP_Query( $furniture_decor_args );
    if ( $furniture_decor_arr_posts->have_posts() ) :
      while ( $furniture_decor_arr_posts->have_posts() ) :
        $furniture_decor_arr_posts->the_post();
        ?>
        <div class="banner_inner_box">
          <?php
            if ( has_post_thumbnail() ) :
              the_post_thumbnail();
            endif;
          ?>
          <div class="banner_box">
            <h3 class="my-3"><?php the_title(); ?></a></h3>
            <p class="btn-green">
              <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('SHOP COLLECTION','furniture-decor'); ?></a>
            </p>
          </div>
        </div>
      <?php
    endwhile;
    wp_reset_postdata();
    endif; ?>
  </div>
</div>
<?php } ?>