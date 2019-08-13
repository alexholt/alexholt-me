<div class="container--sub container__wrap container__spaced container--sub__padded-large container--sub__stretched">

  <?php while ( have_posts() ):
    the_post();

    ?>
    <a href="<?php the_permalink() ?>" class="container container__column container__left container__column--start">
      <div class="img-container">
        <div class="img-container--mask">
          <?php get_thumbnail() ?> 
        </div>
      </div>

      <div class="listing-container">
        <h3 class="h4 h__left h"><?= get_the_title() ?></h3>
        <h4 class="h5 h__left h h__shift-up"><?= get_the_date() ?></h4>
        <p><?= get_the_excerpt() ?></p>
      </div>
    </a>

  <?php endwhile; ?>

</div>
