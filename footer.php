    <footer id="footer" class="source-org vcard copyright">
      <small>&copy;<?php echo date('Y'); echo ' '; bloginfo('name'); ?></small>
    </footer>

  </div>

  <?php wp_footer() ?>


<script src="<?php echo get_template_directory_uri() ?>/_/js/functions.js"></script>

<!-- Asynchronous google analytics; this is the official snippet.
   Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.

<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->

</body>
</html>
