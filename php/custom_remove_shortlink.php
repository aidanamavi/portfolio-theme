<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

add_filter('after_setup_theme', 'custom_remove_shortlink');
function custom_remove_shortlink() {
  remove_action('wp_head', 'wp_shortlink_wp_head', 10);
  remove_action( 'template_redirect', 'wp_shortlink_header', 11);
}

?>