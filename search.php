<?php get_header();
if (have_posts()) : ?>
<h2>Search Results</h2>
<?php include (TEMPLATEPATH . '/_/inc/nav.php' );
while (have_posts()) : the_post(); ?>
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
<h2><?php the_title(); ?></h2>
<?php require(TEMPLATEPATH . '/_/inc/meta.php' ); ?>
<div class="entry">
<?php the_excerpt(); ?>
</div>
</article>
<?php endwhile;
require(TEMPLATEPATH . '/_/inc/nav.php' );
else : ?>
<h2>No posts found.</h2>
<?php endif;
get_sidebar();
get_footer(); ?>