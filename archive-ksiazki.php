<?php get_template_part('templates/page', 'header'); ?>
<div class="book-list">
<?php

$bookargs = ( array(
    'post_type' =>'ksiazki',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy'  => 'books',
            'field'     => 'slug',
            'terms'     => array( 'ebook', 'niedostepne' ),
            'operator'  => 'NOT IN',
        ),
    )
) );

$bookloop = new WP_Query( $bookargs );

while ( $bookloop->have_posts() ) : $bookloop->the_post();

?>
  <article <?php post_class('item-book'); ?>>
    <div class="row entry-content lightbox">
        <div class="col-xs-4 col-sm-4 col-md-3 book-image">
            <a class="book-thumb thumb" href="<?php post_img_url($post->ID, 'large'); ?>" title="">
                <?php the_post_thumbnail( 'ebook' , array('class' => 'lazyload')); ?>
            </a>
        </div>

    	<div class="col-xs-8 col-sm-8 col-md-9 description">
    		<h2 class="entry-title">
                <?php if (bookstore_url($post->ID)): ?>
                <a class="external-link hvr-icon-pulse" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                    <?php the_title(); ?>
                </a>
                <?php else: ?>
                    <?php the_title(); ?>
                <?php endif; ?>

                <?php if (books_cat($post->ID, 'Nowość')): ?>
                    <span class="badge badge-accent-light">Nowość</span>
                <?php endif; ?>
            </h2>

    		<h3 class="author">
                <?php if (get_post_meta( $post->ID, 'author_url', 1 )): ?>
                    <a href="<?php echo get_post_meta( $post->ID, 'author_url', 1 ) ?>" title="<?php bookstore_post_author($post->ID) ?>" target="_blank">
                        <?php bookstore_post_author($post->ID) ?>
                    </a>
                <?php else: ?>
                    <?php bookstore_post_author($post->ID) ?>
                <?php endif; ?>
            </h3>

    		<?php the_content(); ?>

            <?php if (bookstore_url($post->ID)): ?>
    		  <a class="more-link btn btn-default hvr-icon-pulse external-link" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                <?php _e('see in store', 'sage'); ?>
            </a>
            <?php endif; ?>
    	</div>
    </div>
  </article>

<?php
endwhile;
wp_reset_query();
?>

</div>
<div class="ebook-list">

<div class="page-header">
  <h1>Ebooki</h1>
</div>

<?php

$ebookargs = ( array(
    'post_type' =>'ksiazki',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy'  => 'books',
            'field'     => 'slug',
            'terms'     => array( 'ebook' ),
            'operator'  => 'IN',
        ),
    )
) );

$ebookloop = new WP_Query( $ebookargs ); ?>
<?php while ( $ebookloop->have_posts() ) : $ebookloop->the_post(); ?>

<article <?php post_class('item-book'); ?>>
    <div class="row entry-content lightbox">
        <div class="col-xs-4 col-sm-4 col-md-3 book-image">
            <a class="book-thumb thumb" href="<?php post_img_url($post->ID, 'large'); ?>" title="">
                <?php the_post_thumbnail( 'ebook' , array('class' => 'lazyload')); ?>
            </a>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-9 description">

            <h2 class="entry-title">
                <?php if (bookstore_url($post->ID)): ?>
                <a class="external-link hvr-icon-pulse" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                    <?php the_title(); ?>
                </a>
                <?php else: ?>
                    <?php the_title(); ?>
                <?php endif; ?>
                <?php if (books_cat($post->ID, 'Nowość')): ?>
                    <span class="badge badge-accent-light">Nowość</span>
                <?php endif; ?>
                <?php if (books_cat($post->ID, 'Gratis')): ?>
                    <span class="badge badge-accent-dark">Gratis!</span>
                <?php endif; ?>
            </h2>

            <h3 class="author">
                <?php bookstore_post_author($post->ID) ?>
            </h3>

            <?php the_content(); ?>

            <?php if (get_post_meta( $post->ID, 'ebook_pdf', 1 )): ?>
                <a class="btn btn-accent-light hvr-icon-pulse download" target="_blank" href="<?php echo get_post_meta( $post->ID, 'ebook_pdf', 1 ) ?>" title="">
                    <?php if (books_cat($post->ID, 'Gratis')): ?>
                        Darmowy ebook
                    <?php else: ?>
                        Darmowy fragment
                    <?php endif; ?>
                </a>
            <?php endif; ?>

            <?php if (bookstore_url($post->ID)): ?>
              <a class="more-link btn btn-default hvr-icon-pulse external-link" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                <?php _e('see in store', 'sage'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
  </article>

<?php endwhile; ?>

</div>
