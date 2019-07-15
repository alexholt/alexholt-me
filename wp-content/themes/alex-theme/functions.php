<?php

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
  	'alex-theme-bundle',
    get_theme_file_uri('/bundle.js'),
    [],
    filemtime(get_theme_file_path('/bundle.js')),
    true
  );
});
