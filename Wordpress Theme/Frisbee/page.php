<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<article id="main" role="main">
  <?php if (have_posts()) : the_post(); ?>
  <header id="grey-bg" class="fullscreen">
    <div class="container">
      <div class="row">
        <div class="twelvecol">
          <h1 ><?php the_title(); ?></h1>
        </div>
      </div>
    </div>
  </header>
  <section id="main" class="container">
    <div class="row">
      <article class="post <?php echo (is_front_page()?"sixcol":"eightcol"); ?>" id="post-<?php the_ID(); ?>">
        <div <?php $sidebar = get_post_meta($post->ID,"side_roster",true); 
                  if($sidebar == "none") unset($sidebar);
                  /*if($sidebar) echo 'class="eightcol"'; 
                  else echo 'class="twelvecol"';*/ ?>>
        <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
        </div>
        <?php /* <img src="<?php the_field('image'); ?>" class="hero-image" /> */ ?>
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
      </article>
      <aside class="<?php echo (is_front_page()?"sixcol":"fourcol"); ?>">
        <?php
          if ($sidebar) {
            echo "<div>";
            $curr_date = getdate();
            $current_year = (integer) $curr_date['year'] + (integer) ($curr_date['mon'] >= 8);
            if ($sidebar == "alumni"){
              echo "<h2>Alumni Roster</h2>";
              echo player_list(array(
                      "class" => (string) 2002 . "-" . (string) ($current_year - 1),
                      "inc_team" => true,
                      "inc_captain" => true,
                      "sort" => true
                   ));
            } else if ($sidebar == "mens") {
              echo "<h2>Current Roster</h2>";
              echo player_list(array(
                      "range" => (string) $current_year,
                      "class" => (string) $current_year . "-" . (string) ($current_year + 3),
                      "team" => "mens",
                      "sort" => true
                   ));
            } else if ($sidebar == "womens") {          
              echo "<h2>Current Roster</h2>";
              echo player_list(array(
                      "range" => (string) $current_year,
                      "class" => (string) $current_year . "-" . (string) ($current_year + 3),
                      "team" => "womens",
                      "sort" => true
                   ));
            }
            echo "</div></aside>";
          } else {
            get_sidebar();
          }
        ?>
      </aside>
    </div>
  </section>
  <?php endif; ?>
</article>
<?php get_footer(); ?>
