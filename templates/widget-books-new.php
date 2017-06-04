<div class="widget custom-widget widget-books">

	<h2 class="widget-title">Nowości w księgarni</h2>

    <div class="widget-body">

    <?php

    $bookargs = ( array(
        'post_type' =>'ksiazki',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy'  => 'books',
                'field'     => 'slug',
                'terms'     => array( 'niedostepne' ),
                'operator'  => 'NOT IN',
            ),
            array(
                'taxonomy'  => 'books',
                'field'     => 'slug',
                'terms'     => array( 'nowosc' ),
                'operator'  => 'IN',
            ),
        )
    ) );

    $bookloop = new WP_Query( $bookargs );

    while ( $bookloop->have_posts() ) : $bookloop->the_post();

    ?>

    <a class="widget-img-link" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
		  <?php the_post_thumbnail( 'ebook', array('class' => 'lazyload')); ?>
      <span class="btn btn-accent-dark hvr-icon-pulse arrow">
        <?php _e('Continued', 'sage'); ?>
      </span>
    </a>

    <?php endwhile; ?>

    <div class="widget-footer">
      <a class="btn btn-default" href="<?php esc_url(home_url()); ?>/ebooki" title="">Inne książki i ebooki <i class="fa fa-angle-right"></i></a>
    </div>
  </div>
</div>
