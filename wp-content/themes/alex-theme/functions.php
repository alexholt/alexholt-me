<?php

include('inc/enqueue.php');
include('inc/template-utility.php');

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
});

add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
});

add_filter('redirect_canonical', function ($redirect) {
  if (get_query_var('post_type') == 'journal') return false;
  return $redirect;
});

function send_to_404() {
  nocache_headers();
  status_header(404);
  include(get_query_template('404'));
  die;
}
