<?php
/**
 * Plugin Name:       minify html - jesus
 * Plugin URI:        https://wordpress.org/plugins/minify-html-jesus
 * Description:       Minify your HTML.
 * Version:           1.0
 * Requires PHP:      7.2
 * Author:            emanuel
 * Author URI:        https://profiles.wordpress.org/xtrair/
 * Text Domain: minify-html
 * License: GPLv3 or later
 */
if ( !defined( 'ABSPATH' ) ) exit;

add_action('wp_loaded', 'Minified');
function Minified(){
    function MinifiedHTML($buffer)
    {
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
            );
        $replace = array(
            '>',
            '<',
            '\\1'
            );
        $buffer = preg_replace($search, $replace, $buffer);
       $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer );
        return $buffer;
    }
    ob_start("MinifiedHTML");
}
?>
