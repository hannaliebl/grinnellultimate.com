<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="grey-bg">
  <div class="container">
    <div class="row">
      <div class="twelvecol">
        <?php if (have_posts()) : ?>
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <?php /* If this is a category archive */ if (is_category()) { ?>
    <h1 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    <h1 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    <h1 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h1>
    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    <h1 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h1>
    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
    <h1 class="pagetitle">Author Archive</h1>
    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <h1 class="pagetitle">Blog Archives</h1>
    <?php } ?>
      </div>
    </div>
  </div>
</div>
  <div id="main" role="main">
    <div class="container">
      <div class="row">
        <div class="eightcol blog">

    <nav>
      <div><?php next_posts_link('&laquo; Older Entries') ?></div>
      <div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </nav>

<?php while (have_posts()) : the_post(); ?>
              <article id="post-<?php the_ID(); ?>">
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <p class="meta-top">Posted <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
        at <time><?php the_time() ?></time> by <?php the_author() ?>. Posted in <?php the_category(', ') ?>.
        </p>
            <?php the_content('Read the rest of this entry &raquo;'); ?>
            <p class="meta-bottom">
          This post currently has
          <a href="<?php comments_link(); ?>"><?php comments_number( 'no comments', 'one comment', '% comments' ); ?></a>. <?php if ( comments_open() && pings_open() ) {
                // Both Comments and Pings are open ?>
                You can <a href="<?php the_permalink() ?>#respond">leave a comment</a>.

              <?php } elseif ( !comments_open() && pings_open() ) {
                // Only Pings are Open ?>
                Responses are currently closed.

              <?php } elseif ( comments_open() && !pings_open() ) {
                // Comments are open, Pings are not ?>
                You can skip to the end and leave a response. Pinging is currently not allowed.

              <?php } elseif ( !comments_open() && !pings_open() ) {
                // Neither Comments, nor Pings are open ?>
                Both comments and pings are currently closed.

              <?php } edit_post_link('Edit this entry','','.'); ?>
        </p>

              
              

          <?php endwhile; ?>

    <nav>
      <div><?php next_posts_link('&laquo; Older Entries') ?></div>
      <div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </nav>


  <?php else :

  if ( is_category() ) { // If this is a category archive
    printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
  } else if ( is_date() ) { // If this is a date archive
    echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
  } else if ( is_author() ) { // If this is a category archive
    $userdata = get_userdatabylogin(get_query_var('author_name'));
    printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
  } else {
    echo("<h2>No posts found.</h2>");
  }
  get_search_form();

  endif;
  ?>

</div>

<aside class="fourcol last sidebar">
        


    <?php get_sidebar(); ?>



  </aside>

</div>


<?php get_footer(); ?>
