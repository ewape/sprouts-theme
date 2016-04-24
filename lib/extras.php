<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function create_posttype_kielki() {

  register_post_type( 'kielki',

    array(
      'labels' => array(
        'name' => 'Kiełki',
        'singular_name' => 'Kiełki' ,
        'add_new' => 'Dodaj kiełki',
        'add_new_item' => 'Dodaj kiełki',
        'edit_item' => 'Edytuj kiełki',
        'view_item'          => 'Zobacz kiełki',
        'all_items'          => 'Wszystkie kiełki' ,
        'search_items'       => 'Szukaj kiełków',
        'parent_item_colon'  => '',
        'not_found'          => 'Nie znaleziono kiełków',
        'not_found_in_trash' => 'Nie znaleziono kiełków w koszu',
        'menu_name' => 'Kiełki'
      ),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui'  => true,
      'query_var' => true,
      'menu_position' => 5,
      'has_archive' => true,
      'capability_type' => 'post',
      'menu_icon'   => 'dashicons-carrot',
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),
      'taxonomies' => array('post_tag')
    )
  );

}

add_action( 'init',  __NAMESPACE__ . '\\create_posttype_kielki' );

function create_posttype_ksiazki() {

  register_post_type( 'ksiazki',

    array(
      'labels' => array(
        'name' => 'Książki',
        'singular_name' => 'Książka' ,
        'add_new' => 'Dodaj książkę',
        'add_new_item' => 'Dodaj książkę',
        'edit_item' => 'Edytuj książkę',
        'view_item'          => 'Zobacz książki',
        'all_items'          => 'Wszystkie książki',
        'search_items'       => 'Szukaj książek',
        'parent_item_colon'  => '',
        'not_found'          => 'Nie znaleziono książek',
        'not_found_in_trash' => 'Nie znaleziono książek w koszu',
        'menu_name' => 'Księgarnia'
      ),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui'  => true,
      'query_var' => true,
      'menu_position' => 5,
      'has_archive' => true,
      'capability_type' => 'post',
      'rewrite' => array('slug' => 'ebooki'),
      'menu_icon'   => 'dashicons-book',
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),
    )
  );

}

add_action( 'init',  __NAMESPACE__ . '\\create_posttype_ksiazki' );

function create_posttype_faq() {

  register_post_type( 'faq',

    array(
      'labels' => array(
        'name' => 'FAQ',
        'singular_name' => 'FAQ' ,
        'add_new' => 'Dodaj FAQ',
        'add_new_item' => 'Dodaj FAQ',
        'edit_item' => 'Edytuj FAQ',
        'view_item'          => 'Zobacz FAQ',
        'all_items'          => 'Wszystkie FAQ',
        'search_items'       => 'Szukaj FAQ',
        'parent_item_colon'  => '',
        'not_found'          => 'Nie znaleziono FAQ',
        'not_found_in_trash' => 'Nie znaleziono FAQ w koszu',
        'menu_name' => 'FAQ'
      ),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui'  => true,
      'query_var' => true,
      'menu_position' => 5,
      'has_archive' => true,
      'capability_type' => 'post',
      'menu_icon'   => 'dashicons-testimonial',
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' )
    )
  );

}

add_action( 'init',  __NAMESPACE__ . '\\create_posttype_faq' );

add_filter( 'get_the_archive_title',  __NAMESPACE__ . '\\filter_archive_title');

function filter_archive_title( $title ) {

    if( is_archive() ) {
         $post_type = get_queried_object();
         $title = $post_type->label;
    }

    return $title;

}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\custom_size_thumbs' );

function custom_size_thumbs() {
    add_image_size( 'ebook', 220); // 220 pixels wide (and unlimited height)
    add_image_size( 'img-compare', 740, 220, true); // 220 pixels wide (and unlimited height)
}

add_action( 'cmb2_admin_init',  __NAMESPACE__ . '\\cmb2_img_compare_metaboxes' );

function cmb2_img_compare_metaboxes() {

    $prefix = '_img_compare_';

    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '_metabox',
        'title'         => __( 'Zdjęcia', 'cmb2' ),
        'object_types'  => array( 'kielki'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'fields'        => array(
          array(
            'name' => __( 'Nasiona', 'cmb2' ),
            'id'   => 'seed',
            'type' => 'file',
            'options' => array(
              'url' => false, // Hide the text input for the url
              'add_upload_file_text' => 'Dodaj plik' // Change upload button text. Default: "Add or Upload File"
          ),
        ),
        array(
          'name' => __( 'Kiełki', 'cmb2' ),
          'id'   => 'sprout',
          'type' => 'file',
          'options' => array(
            'url' => false, // Hide the text input for the url
            'add_upload_file_text' => 'Dodaj plik' // Change upload button text. Default: "Add or Upload File"
          ),
        )
      ),
    ) );
}

function ebooks_register_taxonomy() {
  $labels = array(
    'name'              => 'Kategorie książek',
    'singular_name'     => 'Kategoria książek',
    'search_items'      => 'Szukaj kategorii',
    'all_items'         => 'Wszystkie kategorie',
    'edit_item'         => 'Edytuj kategorię',
    'update_item'       => 'Aktualizuj kategorię',
    'add_new_item'      => 'Dodaj kategorię',
    'new_item_name'     => 'Nowa kategoria',
    'menu_name'         => 'Kategorie książek'
  );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        //'rewrite'           => array( 'slug' => 'genre' ),
      );
  register_taxonomy( 'books', array( 'ksiazki' ), $args );
}
add_action( 'init', __NAMESPACE__ . '\\ebooks_register_taxonomy' );