<?php dynamic_sidebar('sidebar-primary'); ?>
<!--
<div class="widget">
	<?php get_template_part('templates/visitors'); ?>
</div>
 -->

<div class="widget widget-ceneo">
	<?php get_template_part('templates/widget-ceneo'); ?>
</div>

<?php

// widgety określone w custom fields posta
if ($post) {
	$widgets = get_post_meta( $post->ID, 'widgets', false);
	getCustomWidget($widgets);
}

// widgety na stronie księgarni
if (is_post_type_archive('ksiazki')) {
	get_template_part('templates/widget', 'books-recommended');
	get_template_part('templates/widget', 'partners');
	echo '<div class="ads">';
	get_template_part('templates/ads/ads', '3072990572');
	echo '</div>';
}

// reklama na stronie hodowla
if (is_page('hodowla-kielkow')) {
	echo '<div class="ads">';
	get_template_part('templates/ads/ads', '3072990572');
	echo '</div>';
}

?>