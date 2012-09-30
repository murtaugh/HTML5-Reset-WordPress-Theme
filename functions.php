<?php
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );
 
        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);
	
	// Add RSS links to <head> section
        add_theme_support('automatic_feed_links');

    // Load Scripts Modernizr & jQuery
    function register_basic_scripts() {
        wp_deregister_script( 'jquery' );
        wp_register_script(
            'modernizr',
            ("http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.0.6-development-only.js"),
            '2.0.6',
            false
        );
        wp_register_script(
            'jquery',
            ("//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"),
            '1.8.2',
            false
        );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'modernizr' );
    }
    add_action('wp_enqueue_scripts', 'register_basic_scripts');

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __('Sidebar Widgets','html5reset' ),
    		'id'   => 'sidebar-widgets',
    		'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.

?>