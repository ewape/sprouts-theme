<header class="banner " role="banner">
 <div class="navbar navbar-default container">
  <div>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
        <?php get_template_part('templates/logo'); ?>
      </a>
    </div>
    <nav class="collapse navbar-nav navbar-collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu( array(
                    'theme_location' => 'primary_navigation',
                    'menu'       => 'top_menu',
                    'depth'      => 2,
                    'container'  => false,
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => 'wp_page_menu',
                    'walker' => new wp_bootstrap_navwalker())
      );
      endif;
      ?>

    </nav>

    <div class="navbar-search-btn">
       <i class="fa fa-search hvr-icon-grow"></i>
    </div>

    <div class="header-search animated hidden">
      <?php get_search_form(); ?>
   </div>
 </div>
</div>
</div>
</header>
