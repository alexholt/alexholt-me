<?php

$sticky = get_option( 'sticky_posts' )[0] ?? false;
if (!$sticky) return;
  
$posts = new WP_Query('p=' . $sticky);


if ($posts->have_posts()):
  $posts->the_post(); ?>

  <div class="container--sub container__wrap container__spaced container--sub__padded-large container--sub__stretched">
    <a href="<?php the_permalink() ?>" class="container container__left container__column--start">
      <div class="img-container">
        <div class="img-container--mask img--featured">
          <?php get_thumbnail() ?>
        </div>
      </div>

      <div class="listing-container">
        <h3><?= get_the_title() ?></h3>
        <h4><?= get_the_date() ?></h4>
        <h5><?= get_the_excerpt() ?></h5>
      </div>
    </a>
  </div>

<?php endif; ?>
