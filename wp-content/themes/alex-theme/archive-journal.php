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

  h4 {
    padding: 0;
    margin: 8px;
  }

  ul {
    padding-left: 8px;
    padding-right: 8px;
  }

  .cal {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
    grid-template-rows: 30px 1fr 1fr 1fr 1fr 1fr 1fr;
    grid-template-areas:
      ". . . . . . ."
      ". . . . . . ."
      ". . . . . . ."
      ". . . . . . ."
      ". . . . . . ."
      ". . . . . . ."
      ". . . . . . .";
  }

  .cal > .cal__entry {
    position: relative;
    border-top: 2px solid black;
    border-right: 2px solid black;
    padding-left: 0.6em;
    font-size: 15px;
    overflow: hidden;
  }

  .cal > .cal__entry:nth-of-type(7n + 1) {
    border-left: 2px solid black;
  }

  .cal__entry--empty {
   background-color: grey; 
  }
  
  .cal__entry--bottom {
    border-bottom: 2px solid black;
  }

</style>

<?php
global $wp_query;
$year = $wp_query->query_vars['year'] ? $wp_query->query_vars['year'] : date('Y');
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
  $entries[get_the_date('d')] = '<h4>' . '<a href="' . get_the_permalink() . '">' .
                                get_the_date('d') . ' ' .
                                get_the_title() . '</a></h4>' .
                                '<div>' . get_the_content() . '</div>';
}

$date_obj = DateTime::createFromFormat('!Y-m-d', $year . '-' . $month . '-1');
$month_name = $date_obj->format('F');
$starting_day = $date_obj->format('w');
?>

<h2><?php echo $month_name . ' ' . $year ?></h2>
<section class="cal">
  <?php
  for ($i = 0; $i < 7; $i++) {
    echo '<div class="cal__entry"><h4>' . jddayofweek($i, 2) . '</h4></div>';
  }

  for ($i = 1; $i <= $days_in_month + (int)$starting_day - 1; $i++) {
    $offset = ($i - (int)$starting_day + 1);
    
    if ($i < (int)$starting_day) {
      echo '<div class="cal__entry cal__entry--empty"></div>';

    } elseif (isset($entries[$offset])) {
      echo '<div class="cal__entry">' . $entries[$offset] . '</div>';

    } else {
      echo '<div class="cal__entry"><h4>' . (string)$offset . '</h4></div>';
    }
  }
  
  $max_days = 42;

  for ($i = $days_in_month + (int)$starting_day + 1; $i <= $max_days + 1; $i++) {
    echo '<div class="cal__entry cal__entry--empty"></div>';
  }
  ?>
</section>

<?php
get_footer();