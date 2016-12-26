<article <?php post_class(); ?>>
    <h2 class="entry-title">
    	<a href="<?php the_permalink(); ?>">
    		<?php the_title(); ?>
    	</a>
    </h2>

    <?php if (get_post_type() === 'post') { get_template_part('templates/entry-meta'); } ?>
	  <div class="entry-summary">
	  	<?php if(get_the_excerpt()): ?>
	    <?php the_excerpt();
	    else:  ?>
	    <a class="btn btn-default more-link" href="<?php the_permalink(); ?>" title=""><?php _e('Continued', 'sage'); ?></a>
	    <?php endif; ?>
	  </div>
</article>
