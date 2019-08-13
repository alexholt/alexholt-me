<?php

add_action('wp_enqueue_scripts', function () {
  $bundle = '/bundle.js';
  $style = '/style.css';

  wp_enqueue_script(
    'alex-theme-bundle',
    get_theme_file_uri($bundle),
    [],
    filemtime(get_theme_file_path($bundle)),
    true
  );

  wp_enqueue_style( 'alex-theme-style', get_stylesheet_uri(), array(), filemtime(get_theme_file_path($style)) );
});

