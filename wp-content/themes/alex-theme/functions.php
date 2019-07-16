<?php

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'alex-theme-bundle',
    get_theme_file_uri('/bundle.js'),
    [],
    filemtime(get_theme_file_path('/bundle.js')),
    true
  );

  wp_enqueue_style(
    'alex-theme-style',
    get_theme_file_uri('/style.css'),
    [],
    filemtime(get_theme_file_path('/style.css'))
  );
});

add_action('init', function () {
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
    'supports'            => ['title', 'editor', 'thumbnail'],
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => true,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => ['slug' => 'journal'],
    'menu_icon'           => 'dashicons-welcome-write-blog',
    'capability_type'     => 'post',
    'show_in_rest'        => true,
  ]);
});

add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
});

function send_to_404() {
  nocache_headers();
  status_header(404);
  include(get_query_template('404'));
  die;
}
