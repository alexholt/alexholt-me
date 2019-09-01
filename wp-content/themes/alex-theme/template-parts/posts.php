<div class="container--sub container__wrap container__spaced container--sub__padded-large container--sub__stretched">
  <?php 
  $sticky = get_option( 'sticky_posts' )[0] ?? '';
  while ( have_posts() ):
    the_post();
    if (get_the_ID() == $sticky) continue;
    ?>

    <a href="<?php the_permalink() ?>" class="container container__column container__left container__column--start">
      <div class="img-container">
        <div class="img-container--mask">
          <?php get_thumbnail_white() ?> 
        </div>
      </div>

      <div class="listing-container">
        <h3 class="h4 h__left h white"><?= get_the_title() ?></h3>
        <h4 class="h5 h__left h white"><?= get_the_date() ?></h4>
        <p class="white"><?= get_the_excerpt() ?></p>
      </div>
    </a>

  <?php endwhile; ?>

</div>
