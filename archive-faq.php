<?php get_template_part('templates/page', 'header'); ?>
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
    	<h3 class="entry-title acordion-header">
            <?php the_title(); ?>
        </h3>
        <div class="acordion-content">
            <?php the_content(); ?>
        </div>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>