		<footer id="footer">
			<small>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></small>
		</footer>

	</div>

	<?php wp_footer(); ?>


<!-- here comes the javascript -->

<!-- jQuery is called via the Wordpress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<script src="_/js/functions.js"></script>

<!-- asynchronous google analytics
	 NOTE: this is a variation of the official snippet: mathiasbynens.be/notes/async-analytics-snippet 
	 change UA-XXXXX-X to your site's ID and uncomment
<script>
 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-XXXXX-X']);
 _gaq.push(['_trackPageview']);
 (function() {
  var ga = document.createElement('script');
  ga.type = 'text/javascript';
  ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(ga, s);
 })();
</script>
</script> -->
	
</body>

</html>
