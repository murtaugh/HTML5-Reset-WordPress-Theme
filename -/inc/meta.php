<footer class="meta">
	<i>Posted on:</i> <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F jS, Y') ?></time>
	<span class="byline author vcard">
		<i>by</i> <span class="fn"><?php the_author() ?></span>
	</span>
	<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
</footer>