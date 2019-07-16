<?php get_header() ?>

<main id="main" class="site-main">

  <?php if ( have_posts() ) : ?>

    <header>
      <?php
      the_archive_title( '<h1>', '</h1>' );
      ?>
    </header>

    <?php
    while (have_posts()) :
      the_post();
    endwhile;

  else :
    ?><h2>No posts found</h2><?php

  endif;
  ?>
</main>

<?php get_footer() ?>
