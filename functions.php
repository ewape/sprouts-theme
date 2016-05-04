<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/wp_bootstrap_navwalker.php', // Bootstrap nav
  'lib/wp_bootstrap_pagination.php' // Bootstrap pagination
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


function bookstore_post_author( $post_id ) {
    echo get_post_meta($post_id, 'author', true);
}

function bookstore_url( $post_id ) {
    if (get_post_meta($post_id, 'url', true)) {
     return get_post_meta($post_id, 'url', true);
    }
    else {
      return false;
    }
}

function bookstore_free_url( $post_id ) {
  if (get_post_meta($post_id, 'url_free', true)) {
     return get_post_meta($post_id, 'url_free', true);
  }
  else {
    return false;
  }

}

function post_img_url($post_id, $size) {
  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size );
  echo $thumb['0'];
}

function get_cmb2_box($post_id, $field, $single) {
  if ($single) {
    echo get_post_meta ( $post_id, $field, $single );
  }
  else {
    return get_post_meta ( $post_id, $field, $single );
  }
}

function books_cat($post_id, $cat_to_check) {
  $cats = get_the_terms($post_id, 'books' );
  if ($cats) {
    foreach ($cats as $cat) {
      if ($cat->name === $cat_to_check) {
        return true;
      }
    }
  }
  return false;
}

function getCustomWidget($widgets) {
  if (count($widgets > 0)) {
  foreach ($widgets as $widget) {
    get_template_part('templates/widget-'. $widget);
  }
}
}

