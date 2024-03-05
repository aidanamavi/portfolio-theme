<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

add_filter( 'private_title_format', 'custom_private_title_format' );
add_filter( 'protected_title_format', 'custom_private_title_format' );
function custom_private_title_format( $format ) {
    return '%s';
}

add_filter('the_password_form', 'custom_private_page_message');
function custom_private_page_message ($output) {
    $default_text = 'This content is password protected. To view it please enter your password below:';
    $new_text = 'This content is password protected.';
    $output = str_replace($default_text, $new_text, $output);
    return $output;
}

?>
