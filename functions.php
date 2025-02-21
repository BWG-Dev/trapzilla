<?php
/**
 * Enqueue child styles.
 */
include get_stylesheet_directory(). '/inc/utils.php';
include get_stylesheet_directory(). '/inc/sizing_matrix.php';
include get_stylesheet_directory(). '/inc/index.php';
require_once get_stylesheet_directory() . '/inc/tcpdf/tcpdf.php';



function child_enqueue_styles() {
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/style.css', array(), time() );

	wp_enqueue_style(
		'sizing-tool-styles', // Handle
		get_stylesheet_directory_uri() . '/inc/sizing_tool.css', // Path to the CSS file
		array(), // Dependencies
		null // Version
	);

	wp_enqueue_script(
		'sizing-tool-js', // Handle
		get_stylesheet_directory_uri() . '/inc/sizing_tool.js', // Path to the script
		array('jquery'), // Dependencies
		null, // Version
		true // Load in footer
	);

    wp_localize_script('sizing-tool-js', 'params', [
        'ajax_url' => admin_url('admin-ajax.php'), // URL for AJAX requests
    ]);

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' ); // Remove the // from the beginning of this line if you want the child theme style.css file to load on the front end of your site.


