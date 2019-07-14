<?php get_header() ?>
<section id="primary" class="content-area">
  <main id="main" class="site-main">

  <?php
  if ( have_posts() ) {

    while ( have_posts() ) {
      the_post();
    }

  } else {
    echo "<h2>Nothing here</h2>";
  }
  ?>

  </main>
</section>

