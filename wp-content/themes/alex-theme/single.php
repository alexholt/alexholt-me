<?php

get_header();

while (have_posts()):
  the_post();

  if (is_singular('attachment') && get_post_mime_type(get_the_id()) == 'text/plain'): ?>

    <main class="container">
      <h1><?php the_title() ?></h1>
      <pre>
        <?php
          $filename = get_attached_file(get_the_id());
          $content = file_get_contents($filename);
          $matches = [];
          preg_match('/\.(.+)$/', $filename, $matches);

          if (isset($matches[1]) && $matches[1] == 'json') {
            echo "\n" . json_encode(json_decode($content), JSON_PRETTY_PRINT);
          } else {
            echo $content;
          }
        ?>
      </pre>
    </main>

  <?php else: ?>
    <main class="container container__column">
      <section class="container container__white container__narrow">
        <div class="container--sub container--sub__padded container--sub__stretched container__column">

          <h2><?= get_the_date('Y.m.d') ?></h2>
          <h1><?= get_the_title() ?></h1>
          <h3><?= get_the_category_list(' | ') ?></h3>

          <?php the_content() ?>
        </div>
      </section>

      <section class="container container__narrow container__column">
        <h4>Read next...</h4>
        <div>
          <?php
          $next_posts = new WP_Query([
            'date_query' => [[
              'after' => get_the_date(),
            ]]
          ]);

          $i = 0;
          while ($next_posts->have_posts() && $i < 3):
            $next_posts->the_post();
            $i++;
            ?>

            <h5><?= get_the_title() ?></h5>
            <h5><?= get_thumbnail_white() ?></h5>

          <?php endwhile; ?>

        </div>
      </section>
    </main>
  <?php endif; ?>

<?php endwhile;

get_footer();
