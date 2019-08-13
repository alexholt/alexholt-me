<?php get_header() ?>

<main class="container">
  <section class="container container__white">
    <div class="container--sub container--sub__padded container--sub__stretched container__column">

      <?php
      if ( have_posts() ) {
        the_post();

        echo '<h3 class="h3">' . get_the_title() . "</h3>";
        the_content();

      } else {
        echo "<h2>Nothing here</h2>";
      }
      ?>

    </div>
  </section>
</main>

<?php get_footer()?>
