<?php

if (!is_user_logged_in()) {
  send_to_404();
}

get_header();
?>

<h1>Journal</h1>
<style>

  html, body {
    height: 100%;
  }

  .grid-container {
    height: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
    grid-template-rows: 1fr 1fr 1fr 1fr 1fr 1fr;
    grid-template-areas:
      ". . . . . . ." ". . . . . . ." ". . . . . . ." ". . . . . . ." ". . . . . . ." ". . . . . . .";
  }

  .grid-container > .entry {
    position: relative;
    border-top: 2px solid black;
    border-right: 2px solid black;
    padding-left: 0.6em;
    font-size: 15px;
  }

  .grid-container > .entry:nth-of-type(7n + 1) {
    border-left: 2px solid black;
  }

</style>

<?php
global $wp_query;
$year = date('Y');
$month = $wp_query->query_vars['monthnum'] ? $wp_query->query_vars['monthnum'] : date('m');
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

$query = new WP_Query([
  'post_type' => 'journal',
  'author' => get_current_user_id(),
  'date_query' => [[
    'after'     => [
      'year'  => $year,
      'month' => $month,
      'day'   => 1,
    ],
    'before'    => [
      'year'  => $year,
      'month' => $month,
      'day'   => $days_in_month,
    ],
    'inclusive' => true,
  ]],
]);

$entries = [];
while ($query->have_posts()) {
  $query->the_post();
  $entries[get_the_date('d')] = '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>' .
                                '<div>' . get_the_content() . '</div>';
}
?>

<section class="grid-container">
  <?php
    for ($i = 1; $i <= $days_in_month; $i++) {
      if (isset($entries[$i])) {
        echo '<div class="entry"><h4>' . $i . '</h4>' . $entries[$i] . '</div>';
      } else {
        echo '<div class="entry"><h4>' . $i . '</h4></div>';
      }
    }
  ?>
</section>

<?php
get_footer();
