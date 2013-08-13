<?php
/**
 * @package WordPress
 * @subpackage Frisbee
 */

get_header(); ?>
<?php if (have_posts()) : the_post(); ?>
<div id="grey-bg">
	<div class="container">
		<div class="row">
			<div class="twelvecol">
        <h1><?php the_title(); ?></h1>
  		</div>
		</div>
	</div>
</div>
<div class="container">
  <div class="row">
    <div class="eightcol blog">
      <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <p class="meta-top">Posted <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
        at <time><?php the_time() ?></time> by <?php the_author() ?>. Posted in <?php the_category(', ') ?>.
        </p>
        <?php the_content('Read the rest of this entry &raquo;'); ?>
        <p class="meta-bottom">
          This post currently has
          <a href="<?php comments_link(); ?>"><?php comments_number( 'no comments', 'one comment', '% comments' ); ?></a>. <?php if ( comments_open() && pings_open() ) {
                // Both Comments and Pings are open ?>
                You can <a href="#respond">leave a comment</a>.

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
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
         <?php comments_template(); ?>
      </article>
     </div>
      <aside class="fourcol last sidebar">
        <?php get_sidebar(); ?>
      </aside>

</div>
<?php else: ?>
  <p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>
<?php get_footer(); ?>
