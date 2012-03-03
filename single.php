<?php get_header();
if (have_posts()) : while (have_posts()) : the_post(); ?>
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="entry-content">
<?php the_content();
wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number'));
the_tags( 'Tags: ', ', ', '');
require(TEMPLATEPATH . '/_/inc/meta.php' ); ?>
</div>
<?php edit_post_link('Edit this entry','','.'); ?>
</article>
<?php comments_template();
endwhile; endif;
get_sidebar();
get_footer(); ?>