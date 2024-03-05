<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

// Add thumbnail support for Work post type.
add_action( 'after_setup_theme', 'add_thumbnail_support' );
function add_thumbnail_support() {
  add_theme_support('post-thumbnails', array('slide-items','post','gallery-items','audio-items','video-items','page','event-items','work'));
}

?>
