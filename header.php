<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow">
<?php } ?>
<title><?php if (function_exists('is_tag') && is_tag()) {
single_tag_title("Tag Archive for &quot;"); echo '&quot; '; }
elseif (is_archive()) {
wp_title(''); echo ' Archive '; }
elseif (is_search()) {
echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
elseif (!(is_404()) && (is_single()) || (is_page())) {
wp_title(''); echo ' - '; }
elseif (is_404()) {
echo 'Not Found '; }
if (is_home()) {
bloginfo('name'); echo '  '; bloginfo('description'); }
else {
 bloginfo('name'); }
if ($paged>1) {
echo ' page '. $paged; } ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico">
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/_/img/apple-touch-icon.png">
<!-- The is the icon for iOS's Web Clip.
 - size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4's retina display (IMHO, just go ahead and use the biggest one)
 - To prevent iOS from applying its styles to the icon name it thusly: apple-touch-icon-precomposed.png
 - Transparency is not recommended (iOS will put a black BG behind the icon) -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="container">
<header id="header">
<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
<h2 class="description"><?php bloginfo('description'); ?></h2>
<ul class="nav">
<li><a href="#" title="foobar">foobar bar</a></li>
<li><a href="#" title="foobar">foobar bar</a></li>
<li><a href="#" title="foobar">foobar bar</a></li>
<li><a href="#" title="foobar">foobar bar</a></li>
<li><a href="#" title="foobar">foobar bar</a></li>
</ul>
</header>