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

?>