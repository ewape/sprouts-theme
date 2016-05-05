<?php use Roots\Sage\Titles; ?>
<div class="page-header">
	<?php if (is_post_type_archive()): ?>
	<h1><?= Titles\title(); ?></h1>
	<?php else: ?>
	<h1 class="tag-header"><?php single_tag_title(); ?></h1>
<?php endif; ?>
</div>
