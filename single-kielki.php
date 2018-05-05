<?php while (have_posts()) : the_post(); ?>
  <section <?php post_class('entry-content'); ?>>
      <header class="page-header">
        <h1><?php echo the_title(); ?></h1>
      </header>
      <div class="img-compare twentytwenty-container">
        <div class="images">
          <?php echo wp_get_attachment_image(get_post_meta($post->ID, 'seed_id', 1), 'img-compare', '', ["class" => "lazyload"]); ?>
          <?php echo wp_get_attachment_image(get_post_meta($post->ID, 'sprout_id', 1), 'img-compare', '', ["class" => "lazyload"]); ?>

          <?php if (get_post_meta($post->ID, 'info-seeds', 1)): ?>
            <p class="img-compare-caption caption-left">
              <?php echo get_post_meta($post->ID, 'info-seeds', 1); ?>
            </p>
          <?php endif; ?>

          <?php if (get_post_meta($post->ID, 'info-sprouts', 1)): ?>
            <p class="img-compare-caption caption-right">
              <?php echo get_post_meta($post->ID, 'info-sprouts', 1); ?>
            </p>
          <?php endif; ?>
        </div>
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>

      <article>
        <?php the_content(); ?>
      </article>

      <h2>Wskazówki dotyczące hodowli</h2>
      <div class="kielki-wskazowki">
        <div class="row">
          <strong class="col-xs-6">Czas kiełkowania:</strong>
          <span class="col-xs-6"><?php echo get_post_meta($post->ID, 'Czas kiełkowania:', 1); ?></span>
        </div>
        <div class="row">
         <strong class="col-xs-6">Czas namaczania nasion:</strong>
         <span class="col-xs-6"><?php echo get_post_meta($post->ID, 'Czas namaczania nasion:', 1); ?></span>
       </div>
       <div class="row">
         <strong class="col-xs-6">Zalecana metoda hodowli:</strong>
         <span class="col-xs-6"><?php echo get_post_meta($post->ID, 'Zalecana metoda hodowli:', 1); ?></span>
       </div>
       <div class="row">
         <strong class="col-xs-6">Jak jeść:</strong>
         <span class="col-xs-6"><?php echo get_post_meta($post->ID, 'Jak jeść:', 1); ?></span>
       </div>
     </div>

     <h2>Wartości odżywcze kiełków</h2>
       <div class="kielki-wartosci">
        <strong>Witaminy</strong>
        <span><?php echo get_post_meta($post->ID, 'Witaminy', 1); ?></span>
        <strong>Składniki mineralne</strong>
        <span><?php echo get_post_meta($post->ID, 'Składniki mineralne', 1); ?></span>
        <strong>Inne</strong>
        <span><?php echo get_post_meta($post->ID, 'Inne', 1); ?></span>
      </div>

      <?php $tables = get_post_meta($post->ID, 'tables_id', 1);

      if ($tables): ?>

      <a class="btn btn-accent-light tables-link" href="<?php echo get_post_permalink($tables); ?>" title="">
        <i class="fa fa-table"></i><span>Tabele wartości odżywczych</span>
      </a>

      <?php endif ?>
  </section>
<?php endwhile; ?>
