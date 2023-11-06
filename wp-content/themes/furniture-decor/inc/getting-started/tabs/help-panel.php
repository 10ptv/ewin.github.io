<?php
/**
 * Help Panel.
 *
 * @package furniture_decor
 */
?>

<div id="help-panel" class="panel-left visible">

    <div class="panel-aside active">
        <h4><?php printf( esc_html__( ' VISIT FREE DOCUMENTATION', 'furniture-decor' )); ?></h4>
        <p><?php esc_html_e( 'Are you a newcomer to the WordPress universe? Our comprehensive and user-friendly documentation guide is designed to assist you in effortlessly building a captivating and interactive website, even if you lack any coding expertise or prior experience. Follow our step-by-step instructions to create a visually appealing and engaging online presence.', 'furniture-decor' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( '#' ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'furniture-decor' ); ?>" target="_blank">
            <?php esc_html_e( 'FREE DOCUMENTATION', 'furniture-decor' ); ?>
        </a>
    </div>

    <div class="panel-aside " >
        <h4><?php esc_html_e( 'Review', 'furniture-decor' ); ?></h4>
        <p><?php esc_html_e( 'If you are passionate about the Furniture Decor theme, we would love to hear your thoughts and feedback regarding our theme. Your review will be highly valuable to us as we strive to enhance and improve our theme based on the needs and preferences of our users. Your opinion matters, and we sincerely appreciate your time and effort in sharing your experience with the Furniture Decor theme.', 'furniture-decor' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/furniture-decor/reviews/#new-post' ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'furniture-decor' ); ?>" target="_blank">
            <?php esc_html_e( 'REVIEW', 'furniture-decor' ); ?>
        </a>
    </div>
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'CONTACT SUPPORT', 'furniture-decor' ); ?></h4>
        <p>
            <?php esc_html_e( 'Thank you for choosing Furniture Decor! We appreciate your interest in our theme and are here to assist you with any support you may need.', 'furniture-decor' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/furniture-decor/' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'furniture-decor' ); ?>" target="_blank">
            <?php esc_html_e( 'CONTACT SUPPORT', 'furniture-decor' ); ?>
        </a>
    </div>

    
</div>