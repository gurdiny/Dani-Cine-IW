<?php

/**
 * Admin template
 *
 * @link       http://wordpress.org/plugins/rate-my-post/
 * @since      2.0.0
 *
 * @package    Rate_My_Post
 * @subpackage Rate_My_Post/admin/partials
 */
?>

<?php
  if ( ! defined( 'WPINC' ) ) {
  	die;
  }

  if( class_exists( 'Rate_My_Post_Pro' ) ) {
    do_action( 'rmp_about_section' );
    return;
  }

?>

<div class="rmp-tab-content js-rmp-tab-content js-rmp-tab-content--5">
  <h2 class="rmp-tab-content__title">
    <?php echo ( esc_html__( 'About Plugin', 'rate-my-post' ) ); ?>
  </h2>
  <div class="rmp-about">

    <p class="rmp-about__text">
      <?php echo sprintf( ( esc_html__( 'Hi there,%s Thank you for installing FeedbackWP plugin. If you like the plugin please rate it %shere%s - it will take you 5 minutes (less if you are already registered on WordPress) and it means a lot to me since I made this plugin completely for free. If you encounter problems with the plugin, let me know in the %ssupport forum%s. I hope you will enjoy the plugin.', 'rate-my-post' ) ), '<br />', '<a href="https://wordpress.org/support/plugin/rate-my-post/reviews/" target="_blank">', '</a>', '<a href="https://wordpress.org/support/plugin/rate-my-post/" target="_blank">', '</a>'); ?>
    </p>

    <div class="rmp-about__links">
      <a class="rmp-about__links__link rmp-btn rmp-btn--info" target="_blank" href="https://feedbackwp.com/">
        <?php echo ( esc_html__( 'Website', 'rate-my-post' ) ); ?>
      </a>
      <a class="rmp-about__links__link rmp-btn rmp-btn--info" target="_blank" href="https://feedbackwp.com/docs/">
        <?php echo ( esc_html__( 'Documentation', 'rate-my-post' ) ); ?>
      </a>
      <p class="rmp-about__links__text">
        <?php echo ( esc_html__( 'Please do read the documentation before posting in the support forum.', 'rate-my-post' ) ); ?>
      </p>
    </div>

  </div>

</div>
