<?php
/*
Template Name: Home
*/
?>

<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?> <!-- end header -->

<section id="grey-bg">
  <div class="container">
    <div class="row">
      <div class="sixcol">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="intro-text">
        <?php the_content(); ?>
        </div>
        <?php endwhile; endif; ?>
      </div>
      <div class="sixcol last">
        <div class="intro-text">
        <?php the_field('right_col'); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="main" class="container">
  <div class="row">
    <div class="sixcol blog">
      <h1>Latest on the Blog</h1>
      <?php
$args = array( 'numberposts' => 3, 'order'=> 'DESC', 'orderby' => 'date' );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?> 
      <div>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <p class="meta-top">Posted <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
        at <time><?php the_time() ?></time> by <?php the_author() ?>. Posted in <?php the_category(', ') ?>.
        </p> 
        <?php the_excerpt(); ?>
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

      </div>
      <?php endforeach; ?>
    </div>
    <div class="sixcol last">
      <h1>Recent Pictures</h1>
<?php
echo do_shortcode( '[AFG_gallery id=2]' );
?>

          
          <a href="<?php echo get_site_url(); ?>/media">See more pictures and videos</a>
    </div>
  </div>
  <div class="row">
    <div class="twelvecol">
    	<h1>Latest on Twitter</h1>
    	<p><strong>From the women's team:</strong></p>
    
  
  <div class="row twitter">
  
    <?php
echo do_shortcode( '[twitter-widget username="GCStickies" items="4" showintents="false" hidefrom="true" title="h" showfollow="false" dateFormat="h:i A F d, Y" targetBlank="true"]' );
?>
  </div>
      </div>
      </div>
</section>

<?php get_footer(); ?>