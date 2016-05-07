<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap" role="document">
      <div class="container">
         <div class="content row">
        <main class="main col-sm-8 col-md-9">
          <?php include Wrapper\template_path(); ?>
          <?php if (Setup\display_like_btns()) : ?>
          <div class="like-buttons">
            <div class="fb-like" data-href="https://www.facebook.com/kielkiinfo-310655538217/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
          </div>
           <?php endif; ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar hidden-xs col-sm-4 col-md-3">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

      </div><!-- /.content -->

      </div>

    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
