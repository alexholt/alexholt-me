<?php get_header() ?>
<section id="index" class="content-area">
  <main id="main" class="site-main">

<?php
if ( have_posts() ) {

  while ( have_posts() ) {
    the_post();
    echo "<h2>" . the_title() . "</h2>";
  }

} else {
  echo "<h2>Nothing here</h2>";
}
?>

  </main>
</section>
<?php get_footer()?>
