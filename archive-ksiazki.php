<?php get_template_part('templates/page', 'header'); ?>
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
  <article <?php post_class(); ?>>
    <div class="entry-content lightbox">
    	<a href="<?php post_img_url($post->ID, 'large'); ?>" title="" class="book-thumb thumb">
    		<?php the_post_thumbnail( 'ebook' ); ?>
    	</a>
    	<div class="description">
    		<h2 class="entry-title">
                <a target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                    <?php the_title(); ?>
                </a>
                <?php if (books_cat($post->ID, 'Nowość')): ?>
                    <span class="badge badge-accent-light">Nowość</span>
                <?php endif; ?>
            </h2>

    		<h3 class="author">
                <?php bookstore_post_author($post->ID) ?>
            </h3>

    		<?php the_content(); ?>

            <?php if (bookstore_url($post->ID)): ?>
    		  <a class="more-link btn btn-default hvr-icon-pulse arrow" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                więcej &nbsp;
            </a>
            <?php endif; ?>
    	</div>
    </div>
  </article>

<?php
endwhile;
wp_reset_query();
?>

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

<article <?php post_class(); ?>>
    <div class="entry-content lightbox">
        <a href="<?php post_img_url($post->ID, 'large'); ?>" title="" class="book-thumb thumb">
            <?php the_post_thumbnail( 'ebook' ); ?>
        </a>
        <div class="description">
            <h2 class="entry-title">
                <a target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                    <?php the_title(); ?>
                </a>
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

            <?php if (bookstore_free_url($post->ID)): ?>

                <a class="btn btn-accent-light hvr-icon-pulse download" target="_blank" href="<?php echo bookstore_free_url($post->ID) ?>" title="">

                    <?php if (books_cat($post->ID, 'Gratis')): ?>
                        Pobierz darmowy ebook
                    <?php else: ?>
                        Pobierz darmowy fragment
                    <?php endif; ?>
                </a>

            <?php endif; ?>

            <?php if (bookstore_url($post->ID)): ?>
              <a class="more-link btn btn-default hvr-icon-pulse arrow" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                więcej &nbsp;
            </a>
            <?php endif; ?>
        </div>
    </div>
  </article>

<?php endwhile; ?>
<?php echo do_shortcode('[ads id=0831177546]'); ?>