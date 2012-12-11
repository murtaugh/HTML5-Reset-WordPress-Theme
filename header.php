<!DOCTYPE html>

<!--[if (lt IE 9) & (!IEMobile)]><html class="ie no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head id="www-sitename-com" profile="http://gmpg.org/xfn/11">

<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php if (is_search()) { ?> <meta name="robots" content="noindex, nofollow" /> <?php } ?>

<title><?php if (function_exists('is_tag') && is_tag()){ single_tag_title("Tag Archive for &quot;"); echo '&quot; ~ ';}
elseif (is_archive()) {echo 'o', wp_title(''); echo ' do '; bloginfo('name');}
elseif (is_search()) {echo 'Search for &quot;'.wp_specialchars($s).'&quot; ~ ';}
elseif (!(is_404()) && (is_single()) || (is_page())) {wp_title(''); echo ', no '; bloginfo('name');}
elseif (is_404()) {echo '404: p&aacute;gina n&atilde;o encontrada no '; bloginfo('name');}
if (is_home()) {bloginfo('name');}
if ($paged>1) {echo ' - page '. $paged; }?></title>

<!-- METADATA -->
<meta name="title" content="<?php if (function_exists('is_tag') && is_tag()){ single_tag_title("Tag Archive for &quot;"); echo '&quot; ~ ';}
elseif (is_archive()) {echo 'o', wp_title(''); echo ' do '; bloginfo('name');}
elseif (is_search()) {echo 'Search for &quot;'.wp_specialchars($s).'&quot; ~ ';}
elseif (!(is_404()) && (is_single()) || (is_page())) {wp_title(''); echo ', no '; bloginfo('name');}
elseif (is_404()) {echo '404: p&aacute;gina n&atilde;o encontrada no '; bloginfo('name');}
if (is_home()) {bloginfo('name');}
if ($paged>1) {echo ' - page '. $paged; }?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="author" content="fr3aky" />

<!-- DUBLIN CORE METADATA: http://dublincore.org/ -->
<meta name="DC.title" content="" />
<meta name="DC.subject" content="" />
<meta name="DC.creator" content="" />

<!-- VIEWPORT -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- APPLE MOBILE WEB APP -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- ICONS -->
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/-/img/favicon.ico">
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory'); ?>/-/img/apple-touch-icon-precomposed.png">

<!-- MODERNIZR -->
<script src="<?php bloginfo('template_directory'); ?>/-/js/modernizr-1.7.min.js"></script>

<!-- WORDPRESS HEADER DEFAULTS -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<header id="header">
<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
<div class="description"><?php bloginfo('description'); ?></div>
</header>

