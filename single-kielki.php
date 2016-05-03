<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
    	<div class="page-header">
    		<h1><?php echo the_title(); ?></h1>
    	</div>
    	<div class="img-compare twentytwenty-container">
    		<?php echo wp_get_attachment_image( get_post_meta( $post->ID, 'seed_id', 1 ), 'img-compare' ); ?>
    		<?php echo wp_get_attachment_image( get_post_meta( $post->ID, 'sprout_id', 1 ), 'img-compare' ); ?>
      </div>
      <?php the_content(); ?>

      <h2>Wskazówki dotyczące hodowli</h2>
      <div class="kielki-wskazowki">
        <div class="row">
          <strong class="col-xs-6">Czas kiełkowania:</strong>
          <span class="col-xs-6"><?php echo get_post_meta( $post->ID, 'Czas kiełkowania:', 1 ); ?></span>
        </div>
        <div class="row">
         <strong class="col-xs-6">Czas namaczania nasion:</strong>
         <span class="col-xs-6"><?php echo get_post_meta( $post->ID, 'Czas namaczania nasion:', 1 ); ?></span>
       </div>
       <div class="row">
         <strong class="col-xs-6">Zalecana metoda hodowli:</strong>
         <span class="col-xs-6"><?php echo get_post_meta( $post->ID, 'Zalecana metoda hodowli:', 1 ); ?></span>
       </div>
       <div class="row">
         <strong class="col-xs-6">Jak jeść:</strong>
         <span class="col-xs-6"><?php echo get_post_meta( $post->ID, 'Jak jeść:', 1 ); ?></span>
       </div>
     </div>

     <h2>Wartości odżywcze kiełków</h2>
       <div class="kielki-wartosci">
        <strong>Witaminy</strong>
        <span><?php echo get_post_meta( $post->ID, 'Witaminy', 1 ); ?></span>
        <strong>Składniki mineralne</strong>
        <span><?php echo get_post_meta( $post->ID, 'Składniki mineralne', 1 ); ?></span>
        <strong>Inne</strong>
        <span><?php echo get_post_meta( $post->ID, 'Inne', 1 ); ?></span>
      </div>
  </div>
  <?php get_template_part('templates/ads/ads_0831177546'); ?>
</article>
<?php endwhile; ?>