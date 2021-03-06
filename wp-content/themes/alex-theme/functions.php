<?php

require_once('inc/enqueue.php');

function setup_journal() {

  register_post_type( 'journal', [

    'labels'              => [
      'name'               => 'Journal Entries',
      'singular_name'      => 'Journal Entry',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Journal Entry',
      'edit_item'          => 'Edit Journal Entry',
      'new_item'           => 'New Journal Entry',
      'view_item'          => 'View Journal Entry',
      'search_items'       => 'Search Journal Entries',
      'not_found'          => 'No journal entries found',
      'not_found_in_trash' => 'No journals found in trash',
      'menu_name'          => 'Journal',
    ],

    'hierarchical'        => true,
    'supports'            => ['title', 'editor', 'thumbnail', 'custom-fields'],
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'publicly_queryable'  => true,
    'exclude_from_search' => true,
    'has_archive'         => true,
    'query_var'           => true,
    'can_export'          => is_user_logged_in(),
    'menu_icon'           => 'dashicons-welcome-write-blog',
    'capability_type'     => 'post',
    'show_in_rest'        => is_user_logged_in(),
    'with_front'          => true,
    'has_feed'            => false,
    'rewrite'             => [ 'feeds' => false ],
  ]);
}

function send_to_404() {
  nocache_headers();
  status_header(404);
  include(get_query_template('404'));
  die;
}

function get_thumbnail_white() {
  get_thumbnail('-white');
}

function get_thumbnail($alt = '') {
  if ( has_post_thumbnail() ) {
    the_post_thumbnail( 'medium-large' );
  } else {
    ?><img src="<?= get_template_directory_uri() . "/assets/image-placeholder$alt.svg" ?>"><?php
  }
}

function right_arrow() {
  echo <<<EOD
  <svg
    class="link-arrow"
    viewBox="0 0 10 10"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
  >
    <polygon points="0 0 10 5 0 10"></polygon>
  </svg>
EOD;
}

function left_arrow() {
  echo <<<EOD
  <svg
    class="link-arrow"
    viewBox="0 0 10 10"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
  >
    <polygon points="10 0 0 5 10 10"></polygon>
  </svg>
EOD;
}

add_action( 'init', function () {
  setup_journal();

  add_theme_support( 'post-thumbnails' );

  register_sidebar(
    array(
      'name'          => 'RTFM',
      'id'            => 'rtfm',
      'description'   => 'Add widgets here to appear in your sidebar.',
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
  });

  register_nav_menus([
    'main' => 'Main',
  ]);

  add_filter('upload_mimes', function ($mime_types) {
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['json'] = 'text/plain';
    return $mime_types;
  });

  $role = get_role('administrator');
  $role->add_cap('unfiltered_upload');

  add_action('template_include', function ($template) {
    global $wp_query;
    if ($wp_query->query_vars['post_type'] != 'journal') return $template;
    if (!$wp_query->query_vars['day']) return locate_template('archive-journal.php');
    return locate_template('single-journal.php');
  });
});

