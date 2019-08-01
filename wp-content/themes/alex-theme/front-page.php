<?php
get_header();
the_post();
?>

<main>

  <h1><?php the_title(); ?></h1>
  <h2>Musings</h2>
  <?php if ( is_user_logged_in() )   ?>
  <aside>
    <?php if ( is_active_sidebar( 'rtfm' ) ) : ?>
      <aside class="sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'rtfm' ); ?>
      </aside>
    <?php endif; ?>:
  </aside>

</main>

<?php get_footer() ?>
