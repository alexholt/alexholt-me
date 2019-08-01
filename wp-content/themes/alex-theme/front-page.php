<?php
get_header();
the_post();
?>

<main class="post-listing">

  <aside class="sidebar sidebar--left">
    Blah
  </aside>

  <section class="latest-posts">

  </section>

    <?php if ( is_active_sidebar( 'rtfm' ) ) : ?>
      <aside class="sidebar sidebar--right">
        <?php dynamic_sidebar( 'rtfm' ); ?>
      </aside>
    <?php endif; ?>
  </aside>

</main>

<?php get_footer() ?>
