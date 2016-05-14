<?php dynamic_sidebar('sidebar-primary'); ?>

<div class="widget">
	<?php get_template_part('templates/visitors'); ?>
</div>

<div class="widget">
	<?php get_template_part('templates/social', 'buttons'); ?>
</div>

<?php
if ($post) {
	$widgets = get_post_meta( $post->ID, 'widgets', false);
	getCustomWidget($widgets);
}

if (is_archive('books')) {
	get_template_part('templates/widget', 'partners');
}

?>

<div class="sidebar-links">
	<a href="<?php echo home_url('/'); ?>nota-prawna" title="">Nota prawna</a>
	<a href="<?php echo home_url('/'); ?>polityka-prywatnosci" title="">Polityka prywatności</a>
</div>

<?php

if (is_page('hodowla-kielkow')) {
	echo '<div class="ads">';
	get_template_part('templates/ads/ads', '3072990572');
	echo '</div>';
}

?>