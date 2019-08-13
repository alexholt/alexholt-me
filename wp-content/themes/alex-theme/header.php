<!doctype html>
<html <?php language_attributes() ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ) ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" >

  <meta name="theme-color" content="#87FF00"/>
  <link rel="manifest" href="/manifest.json">

  <link href="https://fonts.googleapis.com/css?family=Audiowide:400|Oswald:200,400&display=swap" rel="stylesheet">
  <link rel="icon" href="/wp-content/themes/alex-theme/assets/favicon.png">

  <title><?php bloginfo( 'name' ) ?></title>
  <?php wp_head() ?>
</head>

<body>

<header class="container container__full container__black">
  <div class="container--sub">

    <div class="header">
      <div class="header__spacer">
        <div class="shield">
          <div class="shield__image">
            <a href="/"><?php readfile(get_template_directory() . '/assets/shield.svg') ?></a>
          </div>
        </div>
      </div>
    </div>

    <div class="site-title">
      <h1 class="site-title--main h1"><?php bloginfo( 'name' ) ?></h1>
      <h2 class="site-title--sub h2"><?php bloginfo( 'description' ) ?></h2>
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

  </div>
</header>
