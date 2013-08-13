<?php
/*
Template Name: Prospective
*/
?>

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
		 		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 		<h1><?php the_title(); ?></h1>
		 	</div>
		 </div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="sixcol">
		 	<article class="post" id="post-<?php the_ID(); ?>">
    			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>	
		 </div>
		 <div class="sixcol last">
		 	<h2>Email the Captains</h2>
		 	<?php echo do_shortcode( '[contact-form-7 id="297" title="Prospective Player"]' ); ?>
    	</div>
    
    

    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
  
  </article>
  <?php endwhile; endif; ?>
  <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

</div>



<?php get_footer(); ?>
