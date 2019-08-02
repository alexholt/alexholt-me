<?php

get_header();

while (have_posts()):
  the_post();
  ?>

  <h1><?php the_title() ?></h1>

  <?php if (is_singular('attachment') && get_post_mime_type(get_the_id()) == 'text/plain'): ?>

    <section>
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
    </section>

  <?php else: ?>
    <section><?php the_content() ?></section>
  <?php endif; ?>

  <span><?php the_author_meta('nickname') ?> — </span>
  <span><?php the_date() ?></span>

<?php endwhile;

get_footer();
