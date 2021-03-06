<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="box">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="footer-widget %1$s %2$s col-xs-12 col-md-4">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    //is_404(),
    //is_front_page(),
    //is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

// fb like buttons
function display_like_btns() {
  static $display;

  isset($display) || $display = !in_array(true, [
    is_404(),
    is_search(),
    //is_archive('faq'),
    is_page('polityka-prywatnosci'),
    is_page('nota-prawna')
  ]);

  return apply_filters('sage/display_like_btns', $display);
}

// fb like buttons
function display_bottom_ads() {
  static $display;

  isset($display) || $display = !in_array(true, [
    is_404(),
    is_search(),
    //is_archive('faq'),
    is_page('polityka-prywatnosci'),
    is_page('nota-prawna')
  ]);

  return apply_filters('sage/display_bottom_ads', $display);
}


// Async script loader

add_filter('script_loader_tag', __NAMESPACE__ . '\\add_async_attribute', 10, 3);

function add_async_attribute($tag, $handle) {
  $scripts_to_async = array('google-plus', 'google-ads');

  foreach ($scripts_to_async as $async_script) {
    if ($async_script === $handle) {
      return str_replace(' src', ' async="async" src', $tag);
    }
  }
  return $tag;
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  // Load plugin css only if needed
  if (!is_singular('tabele')) {
    wp_deregister_style('tablepress-default');
  }

  // Load jQuery in footer
  wp_deregister_script('jquery');
  wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, null, true);
  wp_enqueue_script('jquery');

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
  wp_enqueue_script('google-plus', '//apis.google.com/js/platform.js', null, null, true);
  //wp_enqueue_script('webfont-loader', '//ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js', null, null, true);

  // Czcionki
  wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Dosis:300,400,600|Inconsolata&amp;subset=latin-ext');

  // Pusty arkusz css
  //wp_enqueue_style('style-override', get_template_directory_uri () . '/style.css');
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function load_google_fonts_footer() {
?>
  <script type="text/javascript">
    WebFont.load({
      google: {
        families: ['Dosis:300,400,600:latin,latin-ext', 'Inconsolata:400:latin,latin-ext']
      }
    });
  </script>
<?php
}

//add_action('wp_footer', __NAMESPACE__ . '\\load_google_fonts_footer', 101);
