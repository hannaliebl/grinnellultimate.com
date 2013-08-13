<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="main" role="main">
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
      <article class="post eightcol" id="post-<?php the_ID(); ?>">
        <?php if (has_post_thumbnail($post->ID)) {
          $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
          echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
          echo the_post_thumbnail('large', array('class' => 'player-image'));
          echo '</a>';
 }
?>

        <div>
        <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
        </div>
        <?php /* <img src="<?php the_field('image'); ?>" class="hero-image" /> */ ?>
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
      </article>
      <aside class="fourcol last">
        <?php
            $player_class_year = get_post_meta($post->ID,'class_year',true);
            $player_team = get_post_meta($post->ID,'player_team',true);
            echo "<div>";
            $current_date = getdate();
            $current_year = (integer) $current_date['year'] + (integer) ($current_date['mon'] >= 8);
            if ($player_class_year < $current_year){
              echo "<h2>Alumni Roster</h2>";
              echo player_list(array(
                      "class" => (string) 2002 . "-" . (string) ($current_year - 1),
                      "inc_team" => true,
                      "inc_captain" => true,
                      "sort" => true
                   ));
            } else if ($player_team == "mens") {
              echo "<h2>Current Roster</h2>";
              echo player_list(array(
                      "range" => (string) $current_year,
                      "class" => (string) $current_year . "-" . (string) ($current_year + 3),
                      "team" => "mens",
                      "sort" => true
                   ));
            } else if ($player_team == "womens") {          
              echo "<h2>Current Roster</h2>";
              echo player_list(array(
                      "range" => (string) $current_year,
                      "class" => (string) $current_year . "-" . (string) ($current_year + 3),
                      "team" => "womens",
                      "sort" => true
                   ));
            }
            echo "</div>";
        ?>
      </aside>
    </div>
  </section>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
