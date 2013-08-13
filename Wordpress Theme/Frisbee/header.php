<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    
    <meta name="description" content="">
    <meta name="Hanna Liebl and Cyrus Smith" content="">
    
    <meta name="viewport" content="width=device-width">
    
     <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" type="image/x-icon" />
     <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" type="image/x-icon" />

    
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

   
    <?php if (is_front_page() || (get_post_type() == 'page' && has_post_thumbnail())) {
            wp_enqueue_script('jQuerySlider');
          } ?>
    
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."css/normalize.css") ?>
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."css/1140.css") ?>
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."css/ie.css") ?>
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."css/main.css") ?>
    
    <!-- Wordpress Templates require a style.css in theme root directory -->
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."style.css") ?>
    
    <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->

    <!-- Wordpress Head Items -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


    <?php wp_head(); ?>

</head>
<body>
  <!--[if lt IE 7]>
    <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
  <![endif]-->
  
  <header>
    <div class="title-container">
      <div class="container">
        <div class="row">
          <div class="twelvecol">
            <a class="no-underline" href="<?php bloginfo('siteurl'); ?>"><h1>Grinnell College Ultimate</h1></a>
          </div>
        </div>
      </div>
    </div>
    <div id="header-container">
      <div id="header-image"></div>
      <div class="container">
        <?php 
          wp_nav_menu(
            array(
              'theme_location'	=> 'nav-main',
              'container'       => 'nav',
              'container_class' => 'row',
              'menu_class'			=> 'menu',
              'depth'						=> '1'
            )
          );
        ?>
      </div>
    </div>
    <?php
    if (is_front_page()) {
      $term = \get_term_by('name', 'frontpage', 'category');
      $attachments = get_posts(array(
              'category' => $term->term_id,
              'post_type' => 'attachment',
            ));
      $bgimages = array();
      foreach ($attachments as $bgimage) {
        $img_url = wp_get_attachment_image_src($bgimage->ID,'full');
        array_push($bgimages, $img_url[0]);
      }
      echo "<script>(function ($) {
              $('#header-image').jQuerySlider({images:Array('" . implode("','",$bgimages) . "'),".
                                               "interval:5000,".
                                               "duration:1200});".
                    "})(jQuery);".
          "</script>";
    } 
    else if (get_post_type() == 'page' && has_post_thumbnail()) {
      $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
      echo "<script>(function ($) {".
                      "$('#header-image').jQuerySlider({images:Array('" . $img_url[0] . "'),".
                                               "interval:5000,".
                                               "duration:700});".
                    "})(jQuery);".
          "</script>";
    }
    else if (get_post_type() == 'player' && ($team = get_post_meta($post->ID,'player_team',true)) == 'womens')
    {
      $term = \get_term_by('name', 'playerheader-women', 'category');
      $attachments = get_posts(array(
              'category' => $term->term_id,
              'post_type' => 'attachment',
            ));
      $bgimages = array();
      foreach ($attachments as $bgimage) {
        $img_url = wp_get_attachment_image_src($bgimage->ID,'full');
        array_push($bgimages, $img_url[0]);
      }
      echo "<style> #header-image {background-image: url('" . $img_url[0] . "')}</style>";
     }
     else if (get_post_type() == 'player' && ($team = get_post_meta($post->ID,'player_team',true)) == 'mens')
    {
      $term = \get_term_by('name', 'playerheader-men', 'category');
      $attachments = get_posts(array(
              'category' => $term->term_id,
              'post_type' => 'attachment',
            ));
      $bgimages = array();
      foreach ($attachments as $bgimage) {
        $img_url = wp_get_attachment_image_src($bgimage->ID,'full');
        array_push($bgimages, $img_url[0]);
      }
      echo "<style> #header-image {background-image: url('" . $img_url[0] . "')}</style>";
     } else {
      echo "<style> #header-image {background-image: url('http://www.grinnellultimate.com/wp-content/uploads/2013/01/headerbg-medium.jpg')}</style>";
    }
    
    ?>
  </header>

  

  <!-- end of header -->