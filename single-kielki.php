<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
    	<div class="page-header">
    		<h1><?php echo get_post_meta ( $post->ID, 'title', true ); ?></h1>
    	</div>
    	<div class="img-compare twentytwenty-container">
    		<?php echo wp_get_attachment_image( get_post_meta( $post->ID, 'seed_id', 1 ), 'img-compare' ); ?>
    		<?php echo wp_get_attachment_image( get_post_meta( $post->ID, 'sprout_id', 1 ), 'img-compare' ); ?>
		</div>
    	<?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>