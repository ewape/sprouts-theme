<?php get_template_part('templates/content-single', get_post_type()); ?>

<div class="tables-sources">
    Źródła:
    <a href="http://www.nal.usda.gov/" target="_blank">http://www.nal.usda.gov</a>
    <a href="http://nutritiondata.self.com/" target="_blank">http://nutritiondata.self.com</a>
</div>

<?php
  wp_reset_query();
  wp_reset_postdata();

  $tablesargs = array(
     'post_type' =>'tabele',
     'posts_per_page' => -1,
     'post__not_in' => array($post->ID),
     "order" => 'ASC',
     'orderby' => 'title'
  );

  $tablesloop = new WP_Query( $tablesargs );

  if ($tablesloop): ?>

  <div class="link-list">

  	<?php while ( $tablesloop->have_posts() ) : $tablesloop->the_post(); ?>
  		<a class="tables-link" href="<?php the_permalink() ?>" title="">
  			<i class="fa fa-table"></i><span><?php the_title(); ?></span>
  		</a>
  	<?php endwhile; ?>

  </div>

<?php endif; ?>
