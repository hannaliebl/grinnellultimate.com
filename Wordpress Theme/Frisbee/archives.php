<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="grey-bg">
  <div class="container">
    <div class="row">
      <div class="twelvecol">
        <h1>Archives</h1>
      </div>
    </div>
  </div>
</div>
  <div id="main" role="main">
    <div class="container">
      <div class="row">
        <div class="eightcol blog">

  <section>
    <h2>Archives by Month:</h2>
    <ul>
      <?php wp_get_archives('type=monthly'); ?>
    </ul>
  </section>

  <section>
    <h2>Archives by Subject:</h2>
    <ul>
      <?php wp_list_categories(); ?>
    </ul>
  </section>

      </div>
      <aside class="fourcol last sidebar">
        


    <?php get_sidebar(); ?>



  </aside>

</div>


<?php get_footer(); ?>
