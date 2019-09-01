<?php

if ( !is_user_logged_in() ) {
  send_to_404();
}

get_header();
?>

<?php
global $wp_query;

if ($wp_query->query_vars['day']) {
  include(get_query_template('single-journal'));
  die;
}

$year = $wp_query->query_vars['year'] ?: date('Y');
$month = $wp_query->query_vars['monthnum'] ?: date('m');
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
  $entries[(int)get_the_date('d')] = '<h4>' . '<a href="' . get_the_permalink() . '">' .
                                     get_the_date('d') . ' ' .
                                     get_the_title() . '</a></h4>' .
                                     '<div>' . get_the_content() . '</div>';
}

$date_obj = DateTime::createFromFormat('!Y-m-d', $year . '-' . $month . '-1');
$month_name = $date_obj->format('F');
$next_month_num = (int)(new DateTime($date_obj->format('Y-m-d')))->add(new DateInterval('P1M'))->format('m');

$next_month = (new DateTime($date_obj->format('Y-m-d')))->add(new DateInterval('P1M'));
$last_month = (new DateTime($date_obj->format('Y-m-d')))->sub(new DateInterval('P1M'));

$next_month_url = "/journal/" . $next_month->format('Y') . "/" . $next_month->format('m') . "/";
$last_month_url = "/journal/" . $last_month->format('Y') . "/" . $last_month->format('m') . "/";
?>

<main class="container">

  <section class="container--sub container__white container__column">
    <h1>Journal</h1>

    <h2><a href="<?= $last_month_url ?>"><?php left_arrow() ?></a> <?php echo $month_name . ' ' . $year ?> <a href="<?= $next_month_url ?>"><?php right_arrow() ?></a></h2>

    <section class="cal">
      <?php
      // Add the days of the week column headers
      for ($i = 0; $i < 7; $i++) {
        echo '<div class="cal__entry"><p class="cal__day">' . jddayofweek($i, 2) . '</p></div>';
      }

      $one_day = new DateInterval('P1D');
      while ((int)$date_obj->format('w') > 0) {
        $date_obj->sub($one_day);
      }

      while ((int)$date_obj->format('m') != $next_month_num) {
        if ((int)$date_obj->format('m') != $month) {
          echo '<div class="cal__entry cal__entry--empty"></div>';
        } elseif (isset($entries[(int)$date_obj->format('d')])) {
          echo '<div class="cal__entry">' . array_pop($entries) . '</div>';

        } else {
          echo '<div class="cal__entry"><h4><a href="/wp-admin/post-new.php?post_type=journal">' .
               $date_obj->format('d') .
               '</a></h4></div>';
        }
        $date_obj->add($one_day);
      }

      ?>
    </section>
  </section>
</main>
<?php
get_footer();
