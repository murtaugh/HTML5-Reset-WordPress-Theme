<?php get_header();
if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h2><?php the_title(); ?></h2>
<?php require(TEMPLATEPATH . '/_/inc/meta.php' ); ?>
<div class="entry">
<?php the_content();
wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
</div>
<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</article>
<?php comments_template();
endwhile; endif;
get_sidebar();
get_footer(); ?>