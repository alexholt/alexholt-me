<?php

get_header();

while (have_posts()):
  the_post();
  ?>

  <h1><?php the_title() ?></h1>
  <section><?php the_content() ?></section>

  <span><?php the_author_meta('nickname') ?> — </span>
  <span><?php the_date() ?></span>

<?php endwhile;

get_footer();
