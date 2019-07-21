<?php
get_header();
the_post();
?>

<main>

  <h1><?php the_title(); ?></h1>
  <h2>Musings about Wordpress, JavaScript, and PHP</h2>

  <aside>
    <?php the_content(); ?>
  </aside>

</main>

<?php get_footer() ?>
