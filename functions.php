<?php
function divi__child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'divi__child_theme_enqueue_styles' );

// Possibly not needed -- deprecate
wp_localize_script( 'ajax-search', 'ajaxurl', admin_url( 'admin-ajax.php' ) );