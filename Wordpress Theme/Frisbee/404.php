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
        <h1>Not Found</h1>
      </div>
    </div>
  </div>
</div>
  <div id="main" role="main">
    <div class="container">
      <div class="row">
        <div class="twelvecol">
          <h2>You hucked it deep but no one was running!</h2>
          <p>Maybe try a search to find what you were looking for.</p>
           <section>
            <?php get_search_form(); ?>
          </section>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
