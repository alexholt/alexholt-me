<?php

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'alex-theme-bundle',
    get_theme_file_uri('/build/bundle.js'),
    [],
    filemtime(get_theme_file_path('/build/bundle.js')),
    true
  );

  wp_enqueue_style(
    'alex-theme-style',
    get_theme_file_uri('/build/style.css'),
    [],
    filemtime(get_theme_file_path('/build/style.css'))
  );
});

