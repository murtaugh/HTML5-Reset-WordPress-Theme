<?php

  /*
  *
  * Custom Wordpress Shortcodes
  * Author: Tim Novinger
  * Email: tim@colorjar.com
  * #colorjar
  *
  */


  // -----------------------------------------------------------------------------------------------------
  // GENERIC SHORTCODES
  // -----------------------------------------------------------------------------------------------------
  add_shortcode('callout', 'scCallout');
  function scCallout($atts, $content = null) {
    return '<p class="callout">'.do_shortcode($content).'</p>';
  }

  add_shortcode('button', 'button');
  function button($atts, $content = null) {
    extract(shortcode_atts(array('link' => '#'), $atts));
    return '<a class="button" href="'.$link.'">'.$content.'</a>';
  }


  // -----------------------------------------------------------------------------------------------------
  // COLLAPSIBLE AREA
  // -----------------------------------------------------------------------------------------------------
  add_shortcode('collapsible', 'collapsible');
  function collapsible($atts, $content = null) {
    extract(shortcode_atts(array('title' => ''), $atts));
    $html =  '<div class="collapsible collapsed">';
    $html .=   '<a href="#" class="button-collapsible-trigger">';
    $html .=     '<span class="collapsible-title">'.$title.'</span>';
    $html .=     '<span class="state">';
    $html .=       '<span class="text-state-expanded">- close</span>';
    $html .=       '<span class="text-state-collapsed">+ expand</span>';
    $html .=     '</span>';
    $html .=   '</a>';
    $html .=   '<div class="collapsible-content">'.apply_filters('the_content', trim($content)).'</div>';
    $html .= '</div>';
    return $html;
  }

  // Add Button to WP-Admin TinyMCE Editor
  add_action('init', 'add_collapsible_button');
  function add_collapsible_button() {
    if (current_user_can('edit_posts') &&  current_user_can('edit_pages')) {
      add_filter('mce_external_plugins', 'add_plugin');
      add_filter('mce_buttons', 'register_collapsible_button');
    }
  }

  function register_collapsible_button($buttons){
    array_push($buttons, 'collapsible');
    return $buttons;
  }

  function add_plugin($plugin_array) {
    $plugin_array['collapsible'] = get_template_directory_uri().'/_/js/colorjar.shortcodes.js';
    return $plugin_array;
  }







  // ================================================================================
  // ACCOMPANYING JAVASCRIPT FOR ADDING TINYMCE BUTTON
  // ================================================================================
  /*
  (function() {
    tinymce.create('tinymce.plugins.collapsible', {
      init : function(ed, url) {
        ed.addButton('collapsible', {
          title : 'Add a collapsible area',
          image : url.replace('js', '')+'images/icon-shortcode-collapsible.png',
          onclick : function() {
            ed.selection.setContent('[collapsible title=""]' + ed.selection.getContent() + '[/collapsible]');
          }
        });
      },
      createControl : function(n, cm) {
        return null;
      },
    });
    tinymce.PluginManager.add('collapsible', tinymce.plugins.collapsible);
  })();
  */

  // ================================================================================
  // ACCOMPANYING CSS FOR COLLAPSIBLE AREAS
  // ================================================================================
  /*
  .collapsible { position:relative; height:auto; margin:30px 0; }

  .button-collapsible-trigger {
    display: block;
    text-transform: uppercase;
    line-height: 22px;
    font-size: 12px;
    text-align: right;
  }
  .button-collapsible-trigger:hover {
    text-decoration: none;
  }
  .button-collapsible-trigger .collapsible-title {
    text-align: left;
    float: left;
    padding-right: 5px;
    line-height: 20px;
    font-size: 14px;
    font-weight: bold;
    color: #7a371f;
    width: 85%;
    padding-right: 15%;
  }
  .button-collapsible-trigger .state {
    background: #f2f2f2;
    position: absolute;
    bottom: 0;
    right: 0;
    width: 70px;
  }

  .expanded  { margin-bottom:50px; padding-bottom:5px; border-bottom:2px solid #fff; }
  .expanded  .button-collapsible-trigger .state { bottom:-12px; }
  .expanded  .button-collapsible-trigger .text-state-collapsed { display:none; }

  .collapsed { overflow:hidden; }
  .collapsed .collapsible-content { display:none; }
  .collapsed .button-collapsible-trigger .text-state-expanded  { display:none; }
  */

?>
