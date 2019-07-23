<?php
get_header();
the_post();
?>

<main>

  <h1><?php the_title(); ?></h1>
  <h2>Musings about Wordpress, JavaScript, and PHP</h2>

  <aside>
    <?php if ( is_active_sidebar( 'rtfm' ) ) : ?>
      <aside id="secondary" class="sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'rtfm' ); ?>
      </aside><!-- .sidebar .widget-area -->
    <?php endif; ?>:
  </aside>

</main>

<?php get_footer() ?>
