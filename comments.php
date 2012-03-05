<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
<p class="warning">This post is password protected. Enter the password to view comments.</p>
<?php return; } 
if ( have_comments() ) : ?>
<article>
<h2 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?></h2>
<ul class="navigation">
<li class="next-posts"><?php previous_comments_link() ?></li>
<li class="prev-posts"><?php next_comments_link() ?></li>
</ul>
<ol class="commentlist">
<?php wp_list_comments(); ?>
</ol>
<ul class="navigation">
<li class="next-posts"><?php previous_comments_link() ?></li>
<li class="prev-posts"><?php next_comments_link() ?></li>
</ul>
<?php else : 
    if ( comments_open() ) : ?>
    
        else : ?>
            <p>Comments are closed.</p>
<?php endif;
endif;
if ( comments_open() ) : ?>

<div id="respond">
    <h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>
        <div class="cancel-comment-reply">
            <?php cancel_comment_reply_link(); ?>
        </div>
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
    <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <fieldset>
<?php if ( is_user_logged_in() ) : ?>
    <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
<?php else : ?>
    <div>
        <label for="author">Name <?php if ($req) echo "(required)"; ?></label>
        <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>
    </div>
    <div>
        <label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
        <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
    </div>
    <div>
        <label for="url">Website</label>
        <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3">
    </div>
<?php endif; ?>
    <div>
        <textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
    </div>
    <div>
        <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment">
<?php comment_id_fields(); ?>
    </div>
<?php do_action('comment_form', $post->ID); ?>
        </fieldset>
        </form>
<?php endif; ?>
</div>
</article>
<?php endif; ?>