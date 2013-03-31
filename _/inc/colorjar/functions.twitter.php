<?php
  /*
   *
   * Twitter Functions and Addons
   * Author: Tim Novinger
   * Email: tim@colorjar.com
   * #colorjar
   */

  // -------------------------------------------
  // Grab the latest tweet for the username
  //
  // @params [String]
  // @returns [SimplePie Object]
  // -------------------------------------------
  if (!function_exists('latestTweet'))
  {
    function latestTweet ($username) {
      $feed = twitterFeed($username);
      $tweet = $feed ? $feed->get_item() : '';
      return $tweet;
    }
  }

  // -------------------------------------------
  // Grab the latest tweets for the username
  // — Default amount is 5 tweets
  //
  // @params [String, Integer]
  // @returns [Array of SimplePie Objects]
  // -------------------------------------------
  if (!function_exists('latestTweets'))
  {
    function latestTweets ($username, $amount=5) {
      $feed   = twitterFeed($username);
      $tweets = '';

      if ($feed) {
        $maxitems = $feed->get_item_quantity($amount);
        $tweets   = $feed->get_items(0, $amount);
      }

      return $tweets;
    }
  }

  // -------------------------------------------
  // Grab the latest tweets via RSS for the
  // given username and cache it for 12 hours
  //
  // @params [String]
  // @returns [SimplePie Object]
  // -------------------------------------------
  if (!function_exists('twitterFeed'))
  {
    function twitterFeed ($username) {
      include_once(ABSPATH.WPINC.'/feed.php');
      $feed = fetch_feed("http://api.twitter.com/1/statuses/user_timeline/{$username}.rss");
      return !is_wp_error($feed) ? $feed : false;
    }
  }

  // -------------------------------------------
  // Turn all HTTP URLs, Twitter @usernames
  // and #tags into links
  //
  // @params [String]
  // @returns [String]
  // -------------------------------------------
  if (!function_exists('linkifyTwitterStatus'))
  {
    function linkifyTwitterStatus ($status_text) {
      // linkify URLs
      $status_text = preg_replace(
        '/(https?:\/\/\S+)/',
        '<a href="\1" target="_blank">\1</a>',
        $status_text
      );

      // linkify twitter users
      $status_text = preg_replace(
        '/(^|\s)@(\w+)/',
        '\1@<a href="http://twitter.com/\2" target="_blank">\2</a>',
        $status_text
      );

      // linkify tags
      $status_text = preg_replace(
        '/(^|\s)#(\w+)/',
        '\1<a href="http://search.twitter.com/search?q=%23\2" target="_blank">#\2</a>',
        $status_text
      );

      return $status_text;
    }
  }

?>


<?php /*
   -------------------------------------------
   EXAMPLE USAGE
   -------------------------------------------

  <?php
    $i = 1;
    $account = getcustomfield('twitter_account');
    $amount  = getcustomfield('recent_tweets_amount');
    $amount  = (!empty($amount) || $amount !== 'DISABLED') ? $amount : 5;
    $tweets  = (!empty($account) || $account !== 'DISABLED') ? latestTweets($account) : false;
    if ($tweets) :
  ?>

    <div id="tweets" class="loopable">
      <a href="http://twitter.com/<?php echo $account ?>" target="_blank">
        <h2><?php echo $account ?> on Twitter</h2>
      </a>

      <?php foreach ($tweets as $tweet) : ?>
        <div class="tweet<?php if ($i===1) { echo ' current'; } ?>">
          <?php echo linkifyTwitterStatus($tweet->get_content()) ?>
        </div>
      <?php $i++; endforeach; ?>
    </div>

  <?php endif ?>

*/ ?>
