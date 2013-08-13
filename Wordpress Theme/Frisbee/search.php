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

    <h1>Search Results</h1>
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

      <article <?php post_class() ?>>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <p class="meta-top">Posted <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
        at <time><?php the_time() ?></time> by <?php the_author() ?>. Posted in <?php the_category(', ') ?>.
        </p>
        <?php the_excerpt(); ?>
        <footer>
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
        </footer>
      </article>

    <?php endwhile; ?>

    <nav>
      <div><?php next_posts_link('&laquo; Older Entries') ?></div>
      <div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </nav>

  <?php else : ?>

    <h2>No posts found. Try a different search?</h2>
    <?php get_search_form(); ?>

  <?php endif; ?>

  </div>

<aside class="fourcol last sidebar">
        


    <?php get_sidebar(); ?>



  </aside>

</div>


<?php get_footer(); ?>

