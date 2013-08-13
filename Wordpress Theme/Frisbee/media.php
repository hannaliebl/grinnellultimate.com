<?php
/*
Template Name: Media
*/
?>

<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>
<article id="main" role="main">
  <?php if (have_posts()) : the_post(); ?>
  <header id="grey-bg">
    <a class="no-underline" href="<?php echo $_SERVER['REDIRECT_URL']; ?>">
      <div class="container">
        <div class="row">
          <div class="twelvecol">
            <h1><?php the_title(); ?></h1>
          </div>
        </div>
      </div>
    </a>
  </header>
  <section class="container post" id="post-<?php the_ID(); ?>">
    <div class="row">
      <?php if(isset($_GET['id'])) { ?> 
      <div class="tencol">
        <?php 
        $photoset_title = $pf->photosets_getInfo($_GET['id']);
        $galleries = get_option('afg_galleries');
        $galleries[1]['photo_source'] = 'photoset';
        $galleries[1]['photoset_id'] = $_GET['id'];
        update_option('afg_galleries',$galleries);
        echo "<h2>" . $photoset_title['title']['_content'] . "</h2>";
        echo afg_display_gallery(array('id'=>'1')); ?>
      </div>
      <aside class="twocol last">
        <h2>Albums</h2>
        <?php
        echo "<ul>";
        $pf_retrieval_obj = $pf->photosets_getList(get_option('afg_user_id'));
        $all_photosets = $pf_retrieval_obj['photoset'];
        usort($all_photosets,getFn('date_create'));
        foreach ($all_photosets as $photoset){
            echo "<li" . ($_GET['id'] == $photoset['id']?' class="current"':'') 
                  . "><a href='" . get_bloginfo('url') . '/media/?id=' . $photoset['id']
                  . "'>" . $photoset['title']['_content'] . "</a></li>";
        }
        echo "</ul>";
        unset($pf_retrieval_obj,$photoset_title,$all_photosets);
        ?>
      </aside>
      
      
      <?php } else { ?>
      <div class="sixcol">
        <h2>Albums</h2>
        <?php
        //echo "<ul>";
        $pf_retrieval_obj = $pf->photosets_getList(get_option('afg_user_id'));
        $all_photosets = $pf_retrieval_obj['photoset'];
        usort($all_photosets,getFn('date_create'));
        foreach ($all_photosets as $photoset){
            $photos = $pf->photosets_getPhotos($photoset['id'], NULL, NULL, 1, 1, "photos");
            $cover_url = afg_get_photo_url($photos['photoset']['photo'][0]['farm'], 
                                           $photos['photoset']['photo'][0]['server'],
                                           $photos['photoset']['photo'][0]['id'], 
                                           $photos['photoset']['photo'][0]['secret'], '_q');
            echo "<div class='media-album'>" .
                    "<a href='" . get_bloginfo('url') . '/media/?id=' . $photoset['id']
                  . "'><img src='" . $cover_url . "'/><div>" . $photoset['title']['_content'] . "</div></a></div>";
        }
        //echo "</ul>";
        unset($pf_retrieval_obj,$all_photosets);
        ?>       
       </div>
      <div class="sixcol last">
        <h2>Videos</h2>
        <article>
          <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>	
        </article>
      </div>
      <?php } ?>
    </div>
  </section>
  <?php endif; ?>
</article>
<?php get_footer(); ?>
