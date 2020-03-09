<?php
/*
Plugin Name: Wellbeing Liverpool Shortlist (beta)
Plugin URI: https://www.jnragency.co.uk/
Description: Beta version of the shortlist plugin
Version: 0.1
Author: GM
Author URI: https://www.jnragency.co.uk/
*/

add_action( 'the_content', 'my_thank_you_text' );

function my_thank_you_text ( $content ) {
    return $content .= '<p>Thank you for reading!</p>';
}


add_action ( 'the_content', 'action_buttons' );

function action_buttons ( $content ) {
	return $content .= ' <a href="?add="' . get_the_ID() . '" title="Add to shortlist"> Add to shortlist </a> '; 
}

if ( ! function_exists('custom_functions') ) {
    function custom_functions() {
    include(get_template_directory() . '/includes/shortlist-functions.php');
    }
}
// runs before 'init' hook
add_action( 'after_setup_theme', 'custom_functions' );

?>