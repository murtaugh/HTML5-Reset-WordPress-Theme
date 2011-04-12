<footer class="meta">
	<i>Posted on:</i> <time datetie="<?php echo date(DATE_W3C); ?>"><?php the_time('F jS, Y') ?></time>
	<i>by</i> <?php the_author() ?>
	<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
</footer>