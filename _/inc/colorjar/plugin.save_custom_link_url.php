<?php

  /*
  *  Plugin Name: Save Custom Link URL
  *  Version: 0.1
  *  Plugin URI: http://core.trac.wordpress.org/ticket/13429
  *  Description: Allows to specify a custom Link URL for any attachment.
  *  Author: Sergey Biryukov
  *  Author URI: http://profiles.wordpress.org/sergeybiryukov/
  */


  function _save_attachment_url($post, $attachment) {
    if ( isset($attachment['url']) )
      update_post_meta( $post['ID'], '_wp_attachment_url', esc_url_raw($attachment['url']) );

    return $post;
  }
  add_filter('attachment_fields_to_save', '_save_attachment_url', 10, 2);


  function _replace_attachment_url($form_fields, $post) {
    if ( isset($form_fields['url']['html']) ) {
      $url = get_post_meta( $post->ID, '_wp_attachment_url', true );
      if ( ! empty($url) )
        $form_fields['url']['html'] = preg_replace( "/value='.*?'/", "value='$url'", $form_fields['url']['html'] );
    }

    return $form_fields;
  }
  add_filter('attachment_fields_to_edit', '_replace_attachment_url', 10, 2);

?>
