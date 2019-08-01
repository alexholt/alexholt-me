<?php

the_post();

if (get_the_author_meta('ID') != get_current_user_id()) {
  send_to_404();
}

get_header();

$month_url = get_the_date('Y') . '/' . get_the_date('m');
?>

<h1>Single Journal</h1>

<h2><?php the_title() ?></h2>
<section><?php the_content() ?></section>

<span><?php the_author_meta('nickname') ?> — </span>
<a href="/journal/<?php echo $month_url; ?>"><?php the_date() ?></a>

<?php

get_footer();
