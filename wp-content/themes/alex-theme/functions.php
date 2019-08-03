<?php

include('inc/enqueue.php');

add_action( 'init', function () {
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
    'can_export'          => is_user_logged_in(),
    'menu_icon'           => 'dashicons-welcome-write-blog',
    'capability_type'     => 'post',
    'show_in_rest'        => is_user_logged_in(),
    'with_front'          => false,
    'has_feed'            => false,
    'rewrite'             => [ 'feeds' => false ],
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

  add_feed('trivia', function () {
    header('content-type: text/xml; charset=UTF-8'); // The rss content type confuses the browser when displaying it
    $data = get_trivia_data();
    $i = rand(0, count($data));

    $rss = str_replace(
      '$question',
      substr($data[$i]->question, 1, -1) . ' <br/> <a href="/trivia-answer?q=' . $i . '">Answer</a>',
      file_get_contents(get_theme_file_path('template-parts/trivia-rss.php'))
    );


    echo $rss;
  });

  add_action( 'rest_api_init', function () {
    register_rest_route( 'trivia/v1', '/answer/(?P<id>\d+)', [
      'methods' => 'GET',
      'callback' => function ($data) {
        return  get_trivia_data()[$data['id']];
      },
    ]);
  });

  add_filter('feed_content_type', function ($content_type, $type) {
    if ('trivia' == $type) {
      return feed_content_type('rss2');
    }
    return $content_type;
  }, 10, 2);
});

function send_to_404() {
  nocache_headers();
  status_header(404);
  include(get_query_template('404'));
  die;
}

function get_trivia_data() {
  return json_decode(file_get_contents(wp_get_upload_dir()['basedir'] . '/2019/08/data.json'));
}
