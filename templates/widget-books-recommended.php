<div class="widget custom-widget widget-books">
	<h2 class="widget-title">Polecane książki</h2>
    <div class="widget-body">
        <div class="flexslider widget-slider">
            <ul class="slides">


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
                                'terms'     => array( 'wyroznione' ),
                                'operator'  => 'IN',
                                ),
                              )

                         ) );

                    $bookloop = new WP_Query( $bookargs );
                    while ( $bookloop->have_posts() ) : $bookloop->the_post();

                ?>

                <li>
                    <a class="widget-img-link" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                      <?php the_post_thumbnail( 'ebook' ); ?>
                      <span class="btn btn-accent-dark hvr-icon-pulse arrow">
                        <?php _e('see in store', 'sage'); ?>
                     </span>
                 </a>
                </li>

                <?php endwhile; ?>
            </ul>
        </div>
        <div class="widget-footer">
            <a class="btn btn-default" href="<?php esc_url(home_url()); ?>/ebooki" title="">
                <i class="fa fa-book"></i><span>Inne książki i ebooki</span>
            </a>
        </div>
    </div>
</div>