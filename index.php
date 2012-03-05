<?php get_header();
if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<?php require(TEMPLATEPATH . '/_/inc/meta.php' ); ?>
<div class="entry">
<?php the_content(); ?>
</div>
<footer class="postmetadata">
<?php the_tags('<p>Tags: ', ', ', '</p>'); ?>
<p>Posted in <?php the_category(', ') ?></p>
<?php comments_popup_link('<p>No Comments &#187;</p>', '<p>1 Comment &#187;</p>', '<p>% Comments &#187;</p>', 'comments-link'); ?>
</footer>
    </article>
<?php endwhile;

require(TEMPLATEPATH . '/_/inc/nav.php' );
else : ?>
<article class="warning">
<h2>Not Found</h2>
</article>
<?php endif;

get_sidebar();
get_footer(); ?>