<?php
  /*
   *
   * Custom Functions and Addons
   * Author: Tim Novinger
   * Email: tim@colorjar.com
   * #colorjar
   */


  // Add thumbnail support for specific post types
  $post_types = array('page', 'post');
  add_theme_support('post-thumbnails', $post_types);


  // Add custom image sizes
  add_image_size('CUSTOM_NAME', 100, 100);


  // ------------------------------------------------------------------------
  // Add the ability to include a secondary featured post-thumbnail.
  //
  // REQUIRES: http://wordpress.org/extend/plugins/multiple-post-thumbnails/
  // ------------------------------------------------------------------------
  if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(array(
      'label'     => 'Secondary Featured Image',
      'id'        => 'secondary-featured-image',
      'post_type' => 'post'
    ));
  }


  // Add RSS links to <head> section
  add_theme_support('automatic-feed-links');


  // Load jQuery
  if (!function_exists('core_mods')) {
    function core_mods() {
      if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-ui');
        wp_enqueue_script('jquery', "http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js");
        wp_enqueue_script('jquery-ui', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js", array('jquery'), false, true);
      }
    }
    add_action('wp_enqueue_scripts', 'core_mods');
  }


  // -----------------------------------------------------------
  // WP ADMIN CUSTOMIZATIONS
  // -----------------------------------------------------------

  // Add WP-Admin editor styles - CSS to mimic frontend
  add_editor_style('/style-editor.css');


  add_action('login_head', 'modify_admin_custom_login_logo');
  function modify_admin_custom_login_logo() {
    $image = '/_/images/login_logo.png';
    list($width, $height) = getimagesize(get_template_directory().$image);

    if (file_exists(get_template_directory().$image)) {
      echo '<style type="text/css">';
      echo   '.login form, .login .message { margin-left:0 !important; }';
      echo   '.login h1 a {';
      echo     "width: {$width}px !important;";
      echo     "height: {$height}px !important;";
      echo     'background-image: url('.get_template_directory_uri().$image.') !important;';
      echo     "background-size: {$width}px {$height}px;";
      echo     "margin: 0 auto;";
      echo   '}';
      echo '</style>';
    }
  }


  add_filter('login_headerurl', 'modify_admin_custom_login_url', 10,4);
  function modify_admin_custom_login_url() { return site_url(); }


  add_filter('login_headertitle','modify_admin_custom_login_header_title');
  function modify_admin_custom_login_header_title() { return get_bloginfo('name'); }


  // Customize admin footer
  add_filter('admin_footer_text', 'modify_footer_admin');
  function modify_footer_admin () {
    echo 'Built by <a href="http://www.colorjar.com" target="_blank">ColorJar</a> &mdash; <em>The Venture Accelerator</em>.';
  }


  // Customize admin menu
  add_action('admin_menu', 'modify_admin_menu');
  function modify_admin_menu() {
    //remove_menu_page('edit.php');
    //
    // WP Link Manager will be going away once WP3.5 is released
    remove_menu_page('link-manager.php');
    //
    //remove_menu_page('themes.php');
    //remove_menu_page('tools.php');
    //remove_menu_page('upload.php');
    //remove_menu_page('edit-comments.php');
    //remove_menu_page('plugins.php');
    //remove_submenu_page('index.php', 'update-core.php');
    //remove_submenu_page('options-general.php', 'options-media.php');
  }


  function admin_remove_widgets(){
    // unregister_widget('WP_Widget_Calendar');
    // unregister_widget('WP_Widget_Search');
    // unregister_widget('WP_Widget_Archives');
    // unregister_widget('WP_Widget_Categories');
    // unregister_widget('WP_Widget_Pages');
    // unregister_widget('WP_Widget_RSS');
    // unregister_widget('WP_Widget_Links');
    // unregister_widget('WP_Widget_Meta');
    // unregister_widget('WP_Nav_Menu_Widget');
    // unregister_widget('WP_Widget_Recent_Posts');
    // unregister_widget('WP_Widget_Tag_Cloud');
    // unregister_widget('WP_Widget_Recent_Comments');
  }
  add_action('widgets_init', 'admin_remove_widgets', 1);


  // add_filter('disable_captions', 'admin_disable_captions');
  // function admin_disable_captions() { return true; }


  // -----------------------------------------------------------
  // HELPERS
  // -----------------------------------------------------------

  // Update the body class to include post type and post name
  add_filter('body_class', 'add_body_class');
  function add_body_class( $classes ) {
    global $post;
    if (isset($post)) {
      $classes[] = $post->post_type.'-'.$post->post_name;
    }
    return $classes;
  }


  // Page ID/Slug Helper
  function get_page_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    return $page ? $page->ID : null;
  }


  // Page ID/Name Helper
  function get_page_id_by_name($page_name) {
    global $wpdb;
    $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
    return $page_name_id;
  }


  // Add ability to easily get or echo out custom fields
  function custom_field($key) { get_custom_field($key, true); }
  function get_custom_field($key, $echo = FALSE) {
    global $post;
    $custom_field = get_post_meta($post->ID, $key, true);
    if ($echo == FALSE) { return $custom_field; }
    echo $custom_field;
  }


  // Trim strings by words
  function neat_trim($str, $n, $delim='...' {
    $len = strlen($str);
    if ($len > $n) {
      preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
      return rtrim($matches[1]) . $delim;
    } else {
      return $str;
    }
  }


  add_filter('excerpt_length', 'custom_excerpt_length', 999);
  function custom_excerpt_length($length) { return 55; }


  add_filter('excerpt_more', 'new_excerpt_more');
  function new_excerpt_more($more) {
    global $post;
    return '<a href="'. get_permalink($post->ID) . '"><em> more &raquo;</em></a>';
  }


  // Ability to handle empty searches without redirection to index.php
  add_filter('request', 'search_request_filter');
  function search_request_filter($query_vars) {
    if(isset($_GET['s']) && empty($_GET['s'])) {
      $query_vars['s'] = " ";
    }
    return $query_vars;
  }


  // -----------------------------------------
  // Filter search results based on the
  // post_type passed in from the search form
  // -----------------------------------------
  add_filter('pre_get_posts', 'search_results_filter');
  function search_results_filter($query) {
    if ($query->is_search && isset($_POST['post_type'])) {
      $query->set('post_type', $_POST['post_type']);
    }
    return $query;
  }


  // ----------------------------------------------------------------------------------------------------
  // Correct ancestor menu items for custom post types using WP Nav Menu Link XFN attributes
  // -- Author: Tim Novinger - tim.novinger@gmail.com
  // ----------------------------------------------------------------------------------------------------
  // As of WP 3.1.1 addition of classes for css styling to parents of custom post types doesn't exist.
  // This will add a classe to the correct custom post type parent in the wp-nav-menu as designated by
  // the XFN attribute, while preventing the blog menu item from being the current_page_parent
  // ----------------------------------------------------------------------------------------------------
  add_filter('nav_menu_css_class', 'add_custom_post_type_nav_class', 10, 2);

  function add_custom_post_type_nav_class($classes, $item) {
    $post_type = get_query_var('post_type');

    // Find the custom post type parent as designated by the XFN attribute
    // manually set on the menu item in WP-Admin/Appearence/Menus
    if ($item->xfn != '' && $item->xfn == $post_type) {
      array_push($classes, 'current_custom_post_parent');
    }

    // Remove all other menu parent designations if dealing with custom post type.
    // This prevents the blog from being a parent to a custom post item.
    if (!empty($post_type)) {
      $classes = array_filter($classes, "remove_parent_classes");
    };

    return $classes;
  }

  // Check for current page classes, return false if they exist.
  function remove_parent_classes($class) {
    return ($class == 'current_page_item'
              || $class == 'current_page_parent'
              || $class == 'current_page_ancestor'
              || $class == 'current-menu-item') ? FALSE : TRUE;
  }
  // ---------------------------------------------------------------------------------------------------


  // SHORTCODES
  add_shortcode('callout', 'scCallout');
  function scCallout($atts, $content = null) {
    return '<p class="callout">'.do_shortcode($content).'</p>';
  }

  add_shortcode('button', 'button');
  function button($atts, $content = null) {
    extract(shortcode_atts(array('link' => '#'), $atts));
    return '<a class="button" href="'.$link.'">'.$content.'</a>';
  }

?>
