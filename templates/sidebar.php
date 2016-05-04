<?php dynamic_sidebar('sidebar-primary'); ?>

<?php

if ($post) {
	$widgets = get_post_meta( $post->ID, 'widgets', false);
	getCustomWidget($widgets);
}

?>