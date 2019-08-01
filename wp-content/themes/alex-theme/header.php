<!doctype html>
<html <?php language_attributes() ?>>

<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <?php wp_head() ?>
  <title>alexholt.me</title>
</head>

<body>

<header>
  <div class="shield">
    <div class="shield--image">
      <a href="/"><?php readfile(get_template_directory() . '/assets/shield.svg') ?></a>
    </div>
  </div>

  <div class="site-title">
    <h1><?php the_title(); ?></h1>
    <h2>Musings</h2>
    <?php if ( is_user_logged_in() ): ?>
      <a href="/journal">Journal</a>
    <?php endif; ?>
  </div>

  <?php if ( has_nav_menu( 'main' ) ) : ?>
    <nav class="main-nav-menu" aria-label="Navigation Menu">
      <?php
        wp_nav_menu([
          'theme_location' => 'main',
          'menu_class'     => 'main-nav-menu__list',
          'depth'          => 1,
        ]);
      ?>
    </nav>
  <?php endif; ?>
</header>
