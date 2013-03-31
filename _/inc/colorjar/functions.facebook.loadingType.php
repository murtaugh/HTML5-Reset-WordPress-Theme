<?php

  /*
   * Determine if the site is being loaded via a Facebook Page Tab
   * Author: Tim Novinger - tim@colorjar.com
   * NOTE - JS necessary to make this work is in header.php
   */

  // Initial setup
  $fbdebug = false;
  if (session_id() == '') { session_start(); }
  if (!isset($_SESSION['timeout'])) { $_SESSION['timeout'] = time(); }

  if ($fbdebug) { echo 'line 14: '.($_SESSION['is_facebook_active'] ? 'true' : 'false').'<br />'; }

  // Minute(s)
  $timeout = 3;

  // Are we accessing the site via Facebook?
  $is_facebook_active = isset($_SESSION['is_facebook_active']) && $_SESSION['is_facebook_active'] === true
                        || isset($_POST['signed_request'])
                        || isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],"facebook.com")
                        ? true : false;

  if ($fbdebug) { echo 'line 25: '.($is_facebook_active ? 'true' : 'false').'<br />'; }

  // Ensure that the session variable is set
  // if this is the first time accessing the site via Facebook
  if ($is_facebook_active === true) { $_SESSION['is_facebook_active'] = true; }

  // DEBUGGING OUTPUT
  if ($fbdebug) {
      echo 'line 32: '.(
        //isset($_POST['signed_request'])
        //strpos($_SERVER['HTTP_REFERER'],"facebook.com")
        //$_SESSION['is_facebook_active'] === false
        //$_SESSION['timeout']+$timeout*60 < time()
        $is_facebook_active
        //$_GET['cfb']
        ? 'true' : 'false');

    echo '<br />';
    echo ($_SESSION['timeout']+$timeout*60).' &mdash; session timeout';
    echo '<br />';
    echo time().' &mdash; current time';
  }

  // Turn off Facebook styles if accessing normally
  if (isset($_GET['cfb']) || $is_facebook_active === false ) {
    $_SESSION['is_facebook_active'] = false;
    $is_facebook_active = false;
  }

  // Timeout the session if it has gone on for too long
  if ($_SESSION['timeout']+$timeout*60 < time()) {
    $is_facebook_active = false;
    session_destroy();
  }

  // Set a constant so that we can access it on other included pages
  define('IS_FACEBOOK_ACTIVE', $is_facebook_active);



  /*
   * INCLUDE THE FOLLOWING CODE WITHIN THE PAGE'S <head></head> TAGS
   *
   *
  <?php if ($is_facebook_active) : ?>
    <script type="text/javascript">
      // Clear Facebook styles if we are actually NOT looking at this using Facebook
      if (window.top==window) { window.location='<?php echo get_permalink($post->ID) ?>?cfb=1'; }

      // Eliminate Unwanted Scrollbars Using Javascript
      window.fbAsyncInit = function() { FB.Canvas.setSize(); }

      // Do things that will sometimes call sizeChangeCallback()
      function sizeChangeCallback() { FB.Canvas.setSize(); }
    </script>
  <?php endif ?>
 */

?>
