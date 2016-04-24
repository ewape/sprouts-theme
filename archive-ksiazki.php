<?php get_template_part('templates/page', 'header'); ?>
<?php
$args = array( 'post_type' => 'ksiazki', 'posts_per_page' => -1);
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
if (!books_cat($post->ID, 'Ebook')):
?>
  <article <?php post_class(); ?>>
    <div class="entry-content lightbox">
    	<a href="<?php post_img_url($post->ID, 'large'); ?>" title="" class="book_thumb thumb">
    		<?php the_post_thumbnail( 'ebook' ); ?>
    	</a>
    	<div class="description">
    		<h2 class="entry-title">
                <a target="_blank" href="<?php bookstore_post_url($post->ID) ?>" title="">
                    <?php the_title(); ?>
                </a>
            </h2>
    		<h3 class="author">
                <?php bookstore_post_author($post->ID) ?>
            </h3>
    		<?php the_content(); ?>
    		<a class="more-link btn btn-default" target="_blank" href="<?php bookstore_post_url($post->ID) ?>" title="">więcej</a>
    	</div>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endif; endwhile; ?>
<?php wp_reset_query(); ?>
<div class="page-header">
  <h1>Ebooki</h1>
</div>

<?php $loop2 = new WP_Query( $args ); ?>
<?php while ( $loop2->have_posts() ) : $loop2->the_post();

if (books_cat($post->ID, 'Ebook')): ?>

<article <?php post_class(); ?>>
    <div class="entry-content lightbox">
        <a href="<?php post_img_url($post->ID, 'large'); ?>" title="" class="book_thumb thumb">
            <?php the_post_thumbnail( 'ebook' ); ?>
        </a>
        <div class="description">
            <h2 class="entry-title">
                <a target="_blank" href="<?php bookstore_post_url($post->ID) ?>" title="">
                    <?php the_title(); ?>
                </a>
            </h2>
            <h3 class="author">
                <?php bookstore_post_author($post->ID) ?>
            </h3>
            <?php the_content(); ?>
            <a class="more-link btn btn-default" target="_blank" href="<?php bookstore_post_url($post->ID) ?>" title="">więcej</a>
        </div>
    </div>
  </article>

<?php endif; endwhile; ?>