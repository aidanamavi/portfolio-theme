<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

// Add shortcodes.
function blod_text_shortcode( $atts , $content = null ) {
	return '<strong>' . $content . '</strong>';
}
add_shortcode( 'b', 'blod_text_shortcode' );
function unordered_list_shortcode( $atts , $content = null ) {
	return '<ul>' . do_shortcode($content) . '</ul>';
}
add_shortcode( 'ul', 'unordered_list_shortcode' );
function list_item_shortcode( $atts , $content = null ) {
	return '<li>' . do_shortcode($content) . '</li>';
}
add_shortcode( 'li', 'list_item_shortcode' );

?>
