<?php get_template_part('templates/page', 'header'); ?>
<p>Zbiór często zadawanych pytań dotyczących hodowli kiełków.</p>
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
    	<h3 class="entry-title accordion-header">
            <?php the_title(); ?> <i class="fa fa-caret-right"></i>
        </h3>
        <div class="accordion-content">
            <?php the_content(); ?>
        </div>
    </div>
  </article>
<?php endwhile; ?>
<?php echo do_shortcode('[ads id=5622980160]'); ?>