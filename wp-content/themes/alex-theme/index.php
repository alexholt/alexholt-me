<?php get_header() ?>

<main class="container container__column">

  <section class="container container__white container__column">
    <?php get_template_part( 'template-parts/featured' ); ?>
  </section>

  <section class="container container__black container__column container__full">
    <?php
    query_posts('post_type=post');

    if (have_posts()) {
      get_template_part( 'template-parts/posts' );
    } else {
      get_template_part( 'template-parts/empty' );
    }
    ?>
  </section>

</main>

<?php get_footer() ?>
