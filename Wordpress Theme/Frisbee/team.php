<?php
/*
Template Name: Team
*/
?>

<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
 
 

get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   <header id="grey-bg">
     <div class="container">
       <div class="row">
         <div class="twelvecol">
           <h1 ><?php the_title(); ?>!!!</h1>
         </div>
       </div>
     </div>
  </header>
  <article class="post" id="post-<?php the_ID(); ?>">
    <div class="container">
    	<div class="row">
    	<div <?php $sidebar = get_post_meta($post->ID,"side_roster",true); 
              if($sidebar == "none") unset($sidebar);
              if($sidebar) echo 'class="eightcol"'; 
              else echo 'class="twelvecol"'; ?>>
    <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
    </div>
    <?php
      if ($sidebar) {
        echo "<div class='fourcol'>";
        $current_year = function () {
          $curr_date = getdate();
          return (integer) $curr_date['year'] + (integer) ($curr_date['mon'] >= 8);
        };
        if ($sidebar == "alumni"){
          echo "<h2>Alumni Roster</h2>";
          echo player_list(array(
                  "class" => (string) 2002 . "-" . (string) ($current_year() - 1),
                  "inc_team" => true,
                  "sort" => true
               ));
        } else if ($sidebar == "mens") {
          echo "<h2>Current Roster</h2>";
          echo player_list(array(
                  "class" => (string) $current_year() . "-" . (string) ($current_year() + 3),
                  "team" => "mens",
                  "sort" => true
               ));
        } else if ($sidebar == "womens") {          
          echo "<h2>Current Roster</h2>";
          echo player_list(array(
                  "class" => (string) $current_year() . "-" . (string) ($current_year() + 3),
                  "team" => "womens",
                  "sort" => true
               ));
        }
        echo "</div";
      }
    ?>
    <img src="<?php the_field('image'); ?>" class="hero-image" />
    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    </div>
    </div>
  </article>
  <?php endwhile; endif; ?>
  <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
