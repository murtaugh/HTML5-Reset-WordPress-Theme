<?php

  // Translations can be filed in the /languages/ directory
  load_theme_textdomain('html5reset', get_template_directory().'/languages');


  $locale = get_locale();
  $locale_file = get_template_directory()."/languages/$locale.php";
  if (is_readable($locale_file)) { require_once($locale_file); }


  // Clean up the <head>
  function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
  }
  add_action('init', 'removeHeadLinks');
  remove_action('wp_head', 'wp_generator');


  // Add 3.1 post format theme support.
  // add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video'));
  //

  require_once('_/inc/colorjar/functions.php');
  require_once('_/inc/colorjar/functions.sidebars.php');
  // require_once('_/inc/colorjar/functions.shortcodes.php');
  // require_once('_/inc/colorjar/functions.twitter.php');
  // require_once('_/inc/colorjar/functions.geolocation.php');
?>
