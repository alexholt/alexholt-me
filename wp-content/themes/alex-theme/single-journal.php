<?php

the_post();

if (get_the_author_meta('ID') != get_current_user_id()) {
  send_to_404();
}

get_header();

$month_url = get_the_date('Y') . '/' . get_the_date('m');
?>

<main class="container">
  <section class="container container__white container__column">
    <div class="container--sub container--sub__padded container--sub__stretched container__column">
      <?php
      echo '<h3 class="h3">' . get_the_title() . "</h3>";
      the_content();
      ?>
    </div>

    <div class="container--sub">
      <span><?php the_author_meta('nickname') ?> — </span>
      <a href="/journal/<?php echo $month_url; ?>"><?php the_date() ?></a>
    </div>

  </section>
</main>

<?php

get_footer();
