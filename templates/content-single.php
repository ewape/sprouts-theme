<?php while (have_posts()) : the_post(); ?>
  <section <?php post_class(); ?>>
    <header class="page-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <article class="entry-content">
      <?php the_content(); ?>
    </article>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </section>
<?php endwhile; ?>
