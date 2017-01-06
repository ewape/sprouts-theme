<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;


/* Clear head */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
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
  return ' &hellip; <a class="more-link btn btn-default" href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}

add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function my_remove_rel_attr($content) {
    return preg_replace('/\s+rel="attachment wp-att-[0-9]+"/i', '', $content);
}

add_filter('the_content', __NAMESPACE__ . '\\my_remove_rel_attr');

add_action( 'init', __NAMESPACE__ . '\\kielki_tags', 5 );

register_taxonomy_for_object_type( 'kielki-tags', 'kielki' );
register_taxonomy_for_object_type( 'kielki-tags', 'ksiazki' );

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

add_action( 'cmb2_admin_init',  __NAMESPACE__ . '\\cmb2_ebook_download' );

function cmb2_ebook_download() {

    $prefix = '_ebook_download_';

    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '_metabox',
        'title'         => __( 'Plik do pobrania', 'cmb2' ),
        'object_types'  => array( 'ksiazki'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'fields'        => array(
            array(
              //'name' => 'Plik do pobrania',
              'id'   => 'ebook_pdf',
              'type' => 'file',
              'options' => array(
                'url' => false, // Hide the text input for the url
                'add_upload_file_text' => 'Dodaj plik' // Change upload button text. Default: "Add or Upload File"
                ),
            )
        )
    ) );
}

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

    if (is_tag()) {
      return single_tag_title();
    }

    elseif( is_archive() ) {
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
        'title'         => __( 'Photos', 'cmb2' ),
        'object_types'  => array( 'kielki'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'fields'        => array(
          // nasiona
            array(
              'name' => 'Nasiona',
              'id'   => 'seed',
              'type' => 'file',
              'options' => array(
                'url' => false, // Hide the text input for the url
                'add_upload_file_text' => 'Dodaj plik' // Change upload button text. Default: "Add or Upload File"
                ),
            ),

            array(
              'name' => 'Przypis',
              'id'   => 'info-seeds',
              'type' => 'text',
            ),

            // kiełki
            array(
              'name' => __( 'Sprouts', 'cmb2' ),
              'id'   => 'sprout',
              'type' => 'file',
              'options' => array(
                'url' => false, // Hide the text input for the url
                'add_upload_file_text' => 'Dodaj plik' // Change upload button text. Default: "Add or Upload File"
              ),
            ),
            array(
              'name' => 'Przypis',
              'id'   => 'info-sprouts',
              'type' => 'text',
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


// Register Custom Taxonomy
function kielki_tags() {

 $labels = array(
    'name'              => 'Tagi kiełków',
    'singular_name'     => 'Tag kiełków',
    'search_items'      => 'Szukaj tagów',
    'all_items'         => 'Wszystkie tagi',
    'edit_item'         => 'Edytuj tag',
    'update_item'       => 'Aktualizuj tag',
    'add_new_item'      => 'Dodaj tag',
    'new_item_name'     => 'Nowy tag',
    'menu_name'         => 'Tagi kiełków'
  );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
      );
  register_taxonomy( 'kielki-tags', array( 'kielki', 'ksiazki' ), $args );
}

// Register Custom Post Type
function create_post_type_tables() {

  $labels = array(
    'name'                  => 'tabele',
    'singular_name'         => 'tabela',
    'menu_name'             => 'Tabele',
    'name_admin_bar'        => 'Tabele',
    'archives'              => 'Archiwa tabel',
    'parent_item_colon'     => 'Parent Item:',
    'all_items'             => 'Wszystkie tabele',
    'add_new_item'          => 'Dodaj tabelę',
    'add_new'               => 'Dodaj tabelę',
    'new_item'              => 'Nowa tabela',
    'edit_item'             => 'Edytuj tabelę',
    'update_item'           => 'Aktualizuj tabelę',
    'view_item'             => 'Zobacz tabelę',
    'search_items'          => 'Szukaj tabeli',
    'not_found'             => 'Nie znaleziono tabeli',
    'not_found_in_trash'    => 'Nie znaleziono tabeli w koszu',
    'featured_image'        => 'Featured Image',
    'set_featured_image'    => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image'    => 'Use as featured image',
    'insert_into_item'      => 'Wstaw do tabeli',
    'uploaded_to_this_item' => 'Uploaded to this item',
    'items_list'            => 'Items list',
    'items_list_navigation' => 'Items list navigation',
    'filter_items_list'     => 'Filter items list',
  );

  $args = array(
    'label'                 => 'tabela',
    'description'           => 'Tabele wartości',
    'labels'                => $labels,
    'supports'              => array( ),
    'taxonomies'            => array( 'category', 'post_tag' ),
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'   => 'dashicons-editor-table',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );

  register_post_type( 'tabele', $args );

}

add_action('init', __NAMESPACE__ . '\\create_post_type_tables');

add_filter('script_loader_tag', __NAMESPACE__ . '\\add_async_attribute', 10, 2);

function add_async_attribute($tag, $handle) {
    if ( 'google-ads' !== $handle ) {
       return $tag;
    }
    return str_replace( ' src', ' async="async" src', $tag );
}
