<?php while (have_posts()) : the_post(); ?>
<article <?php post_class('item-ebook'); ?>>
    <div class="row entry-content lightbox">
        <div class="col-xs-4 col-sm-3">
            <a class="book-thumb thumb" href="<?php post_img_url($post->ID, 'large'); ?>" title="" class="">
                <?php the_post_thumbnail( 'ebook' ); ?>
            </a>
        </div>

    	<div class="col-xs-8 col-sm-9 description">
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

            <?php if (bookstore_url($post->ID)): ?>
    		  <a class="more-link btn btn-default hvr-icon-pulse external-link" target="_blank" href="<?php echo bookstore_url($post->ID) ?>" title="">
                więcej
            </a>
            <?php endif; ?>
    	</div>
    </div>
</article>
<?php endwhile; ?>
