<div class="custom-widget widget-books">

	<h2 class="widget-title">Polecane książki</h2>

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
            'terms'     => array( 'wyroznione' ),
            'operator'  => 'IN',
        ),
    )
) );

$bookloop = new WP_Query( $bookargs );

while ( $bookloop->have_posts() ) : $bookloop->the_post();

?>

<div>

    <a class="widget-img-link" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
		<?php the_post_thumbnail( 'ebook' ); ?>
		<span class="btn btn-accent-dark hvr-icon-pulse arrow">
			więcej
		</span>
	</a>
</div>

<?php endwhile; ?>

	<div class="widget-footer">
		<a href="/ebooki" title="">Inne książki i ebooki <i class="fa fa-angle-right"></i></a>
	</div>
</div>
</div>